<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Events\CompanyCreated;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    public function index(Request $request)
    {

        $this->authorize('companies');
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $companies = Company::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $companies = Company::orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'companies' => $companies,
            'search' => $search,
        ];


        return view("super_admin.companies.all_companies", $data);
    }

    public function view($id)
    {
        $this->authorize('edit_company');
        $company = Company::findOrFail($id);
        $data = [
            'company'      => $company,
        ];
        return view("super_admin.companies.show", $data);
    }

    public function edit($id)
    {
        $this->authorize('edit_company');
        // $roles = Role::all();
        $company = Company::findOrFail($id);
        $data = [
            'company'      => $company,
        ];
        return view("super_admin.companies.show", $data);
    }

    public function create()
    {
        $this->authorize('create_company');

        $company = Company::get();
        $data = [
            'company'      => $company,
        ];
        return view("super_admin.companies.create", $data);
    }
    public function store(Request $request)
    {
        // $this->authorize('create_company');

        $request->validate([
            'name'                      => "required",
            'user_name'                 => "required",
            'password'                  => "required",
            'phone'                     => "required",
            'company_id'                => "required",
            'branches_count'            => "required",
        ], [
            'name.required'             => __('general.name_required'),
        ]);
        // DB::beginTransaction();
        // try {

            $company = Company::create([
                'name'                          => $request->name,
                'user_name'                     => $request->user_name,
                'email'                         => $request->email ?? null,
                'company_id'                    => $request->company_id ?? 0,
                'domain'                        => $request->company_id . '.' . config('url'),
                'password'                      => Hash::make($request->password),
                'user_count'                    => $request->user_count ?? 10,
                'branches_count'                => $request->branches_count ?? 10,
                'my_name'                       => $request->password,
                'phone'                         => $request->phone,

            ]);
            User::create([
                'name'                          => $request->name,
                'email'                         => $request->email ?? null,
                'user_name'                     => $request->user_name,
                'password'                      => Hash::make($request->password),
                'role_id' => 2,
                'role_name' => 'admin',
            ]);
            event(new CompanyCreated($company));
            // DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return redirect()->back()->with("error", $th->getMessage());
        // }
        return redirect()->route('admin.companies')->with("success", __("general.added_successfully"));
    }
    public function update(Request $request, $id)
    {
        $this->authorize('edit_company');
        $company = Company::findOrFail($id);
        $request->validate([
            'name_ar'              => "required",
            'name_en'              => "required",
        ], [
            'name_ar.required'             => __('general.name_required'),
            'name_en.required'             => __('general.name_required'),
        ]);
        try {


            $company->update([
                'name_ar'  => $request->name_ar,
                'name_en'  =>  $request->name_en,
                'company_id'       => $request->company_id ?? 0,
                'description_ar'    => $request->description_ar ?? null,
                'description_en'    => $request->description_en ?? null,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }

        return redirect()->back()->with("success", __('general.updated_successfully'));
    }

    public function destroy($id)
    {
        $this->authorize('delete_company');

        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route("companies")->with("success", __('general.deleted_successfully'));
    }


    public function bulk_company_delete(Request $request)
    {
        $this->authorize('delete_company');

        $items = bulk_delete($request, 'App\Models\Company');
        return $items;
    }
}
