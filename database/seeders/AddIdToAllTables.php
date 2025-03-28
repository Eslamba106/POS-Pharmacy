<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddIdToAllTables extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $columnName = 'branch_id';

        // الحصول على جميع الجداول في قاعدة البيانات
        $tables = DB::select('SHOW TABLES');
 
        foreach ($tables as $table) {
            $tableName = reset($table);  

            // التحقق مما إذا كان العمود موجودًا بالفعل
            if (!Schema::hasColumn($tableName, $columnName)) {
                Schema::table($tableName, function (Blueprint $table) use ($columnName) {
                    $table->string($columnName)->nullable()->default(1);  
                });

                echo "تمت إضافة العمود إلى الجدول: $tableName \n";
            } else {
                echo "الجدول $tableName يحتوي بالفعل على العمود.\n";
            }
        }
    }
}
