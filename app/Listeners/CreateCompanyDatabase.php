<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use DirectoryIterator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class CreateCompanyDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        $company = $event->company;
        $db = "pos_{$company->id}";
        $company->database_options = [
            'dbname'        => $db,
        ];
        $company->save();

        DB::statement("CREATE DATABASE `{$db}`");

        Config::set('database.connections.tenant.database', $db);
        $dir = new DirectoryIterator(database_path('migrations/tenants'));
        foreach ($dir as $file) {
            if ($file->isFile()) {
                Artisan::call('migrate', [
                    '--database'        => 'tenant',
                    '--path'  =>  'database/migrations/tenants/' . $file->getFilename(),
                    '--force'   => true,
                ]);
            };
        }

        $this->copyDataToTenantDB($db, $company);
    }


    private function copyDataToTenantDB(string $db, $company)
    {
        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $db);
        DB::reconnect('tenant');
        $tablesToCopy = ['roles', 'sections', 'permissions'];
        foreach ($tablesToCopy as $table) {
            $data = DB::table($table)->get();
            if ($data->isNotEmpty()) {
                DB::connection('tenant')->table($table)->insert($data->map(function ($row) {
                    return (array) $row;
                })->toArray());
            }
        }
        $latestUser = DB::table('users')->orderBy('id', 'desc')->first();

        if ($latestUser) {
            DB::connection("tenant")->table('users')->insert((array) $latestUser);
        }

        $latestCompany = DB::table('companies')->orderBy('id', 'desc')->first();
        if ($latestCompany) {
            DB::connection("tenant")->table('companies')->insert((array) $latestCompany);
        }
        $branch = [
            'name'              => 'الفرع الرئيسي',
            'logo'              => $company->logo,
            'domain'            => $company->domain,
            'address'           => $company->address1,
            'database_options'  => $company->database_options1,
        ];
        DB::connection("tenant")->table('branches')->insert((array) $branch);
        DB::purge('tenant');
    }
}
