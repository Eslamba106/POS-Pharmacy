<?php

namespace App\Http\Controllers\system;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('branches');
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $branches = Branch::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%");
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $branches = Branch::with('branches')
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'branches' => $branches,
            'search' => $search,
        ];

        // $ids = $request->bulk_ids;
        // $now = Carbon::now()->toDateTimeString();
        // if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
        //     $data = ['status' => $request->status];
        //     $this->authorize('change_branches_status');

        //     Branch::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        //  if ($request->bulk_action_btn === 'update_status' && $request->role && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role];
        //     $this->authorize('change_branches_role');

        //     ($request->role == 1) ? $data['role_name'] = "branch" : $data['role_name'] = 'admin' ;
        //     $is_update = Branch::whereIn('id', $ids)->update($data);

        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'update_role' && $request->role_id && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role_id];
        //     Branch::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


        //     Branch::whereIn('id', $ids)->delete();
        //     return back()->with('success', __('تم الحذف بنجاح'));
        // }
        // $branches = Branch::orderBy("created_at","desc")->paginate(10);
        return view("admin.branches.all_branches", $data);
    }

    public function view($id)
    {
        $this->authorize('edit_branch');
        // $roles = Role::all();
        $branch = Branch::findOrFail($id);
        $data = [
            'branch'      => $branch,
        ];
        return view("admin.branches.show", $data);
    }

    public function edit($id)
    {
        $this->authorize('edit_branch');
        // $roles = Role::all();
        $branch = Branch::findOrFail($id);
        $data = [
            'branch'      => $branch,
        ];
        return view("admin.branches.show", $data);
    }

    public function create()
    {
        $this->authorize('create_branch');

        $branch = Branch::get();
        $data = [
            'branch'      => $branch,
        ];
        return view("admin.branches.create", $data);
    }
    public function store(Request $request)
    {
        $this->authorize('create_branch');

        $request->validate([
            'branch_name_ar'              => "required",
            'branch_name_en'              => "required",
        ], [
            'branch_name_ar.required'             => __('general.name_required'),
            'branch_name_en.required'             => __('general.name_required'),
        ]);
        try {


            $branch = Branch::create([
                'branch_name_ar'  => $request->branch_name_ar,
                'branch_name_en'  => $request->branch_name_en,
                'branch_id'       => $request->branch_id ?? 0,
                'description_ar'    => $request->description_ar ?? null,
                'description_en'    => $request->description_en ?? null,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
        return redirect()->route('branches')->with("success", __("general.added_successfully"));
    }
    public function update(Request $request, $id)
    {
        $this->authorize('edit_branch');
        $branch = Branch::findOrFail($id);
        $request->validate([
            'branch_name_ar'              => "required",
            'branch_name_en'              => "required",
        ], [
            'branch_name_ar.required'             => __('general.name_required'),
            'branch_name_en.required'             => __('general.name_required'),
        ]);
        try {


            $branch->update([
                'branch_name_ar'  => $request->branch_name_ar,
                'branch_name_en'  =>  $request->branch_name_en,
                'branch_id'       => $request->branch_id ?? 0,
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
        $this->authorize('delete_branch');

        $branch = Branch::findOrFail($id);
        $branch->delete();
        return redirect()->route("branches")->with("success", __('general.deleted_successfully'));
    }


    public function bulk_branch_delete(Request $request)
    {
        $this->authorize('delete_branch');

        $items = bulk_delete($request, 'App\Models\Branch');
        return $items;
    }
}
