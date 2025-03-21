<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\general\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        // $user = auth('staffs')->check() ? auth('staffs')->user() : auth('web')->user();
        // dd($user->hasPermission('departments')); 
        $this->authorize('departments' );
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $departments = Department::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('department_name_ar', 'like', "%{$value}%")
                    ->orWhere('department_name_en','like', "%{$value}%");
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $departments = Department::with('departments')
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'departments' => $departments,
            'search' => $search,
        ];

        // $ids = $request->bulk_ids;
        // $now = Carbon::now()->toDateTimeString();
        // if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
        //     $data = ['status' => $request->status];
        //     $this->authorize('change_departments_status');

        //     Department::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        //  if ($request->bulk_action_btn === 'update_status' && $request->role && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role];
        //     $this->authorize('change_departments_role');

        //     ($request->role == 1) ? $data['role_name'] = "department" : $data['role_name'] = 'admin' ;
        //     $is_update = Department::whereIn('id', $ids)->update($data);

        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'update_role' && $request->role_id && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role_id];
        //     Department::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


        //     Department::whereIn('id', $ids)->delete();
        //     return back()->with('success', __('تم الحذف بنجاح'));
        // }
        // $departments = Department::orderBy("created_at","desc")->paginate(10);
        return view("admin.departments.all_departments", $data);
    }

    public function view($id)
    {
        $this->authorize('edit_department'); 
        $department = Department::findOrFail($id);
        $data = [
            'department'      => $department,
        ];
        return view("admin.departments.show", $data);
    }

    public function edit($id)
    {
        $this->authorize('edit_department');
        // $roles = Role::all();
        $department = Department::findOrFail($id);
        $data = [
            'department'      => $department,
        ];
        return view("admin.departments.show", $data);
    }

    public function create()
    {
        $this->authorize('create_department');

        $department = Department::get();
        $data = [
            'department'      => $department,
        ];
        return view("admin.departments.create", $data);
    }
    public function store(Request $request)
    {
        $this->authorize('create_department');

        $request->validate([
            'name_ar'              => "required",
            'name_en'              => "required",
        ], [
            'name_ar.required'             => __('general.name_required'),
            'name_en.required'             => __('general.name_required'),
        ]);
        try {


            $department = Department::create([
                'name_ar'  => $request->name_ar,
                'name_en'  =>  $request->name_en,
                'department_id'       => $request->department_id ?? 0,
                'description_ar'    => $request->description_ar ?? null,
                'description_en'    => $request->description_en ?? null,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
        return redirect()->route('departments')->with("success", __("general.added_successfully"));
    }
    public function update(Request $request, $id)
    {
        $this->authorize('edit_department');
        $department = Department::findOrFail($id);
        $request->validate([
            'name_ar'              => "required",
            'name_en'              => "required",
        ], [
            'name_ar.required'             => __('general.name_required'),
            'name_en.required'             => __('general.name_required'),
        ]);
        try {


            $department->update([
                'name_ar'  => $request->name_ar,
                'name_en'  =>  $request->name_en,
                'department_id'       => $request->department_id ?? 0,
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
        $this->authorize('delete_department');

        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route("departments")->with("success", __('general.deleted_successfully'));
    }


    public function bulk_department_delete(Request $request)
    {
        $this->authorize('delete_department');

        $items = bulk_delete($request, 'App\Models\general\Department');
        return $items;
    }
}
