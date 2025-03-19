<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\general\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {

        $this->authorize('categories');
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $categories = Category::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('category_name_ar', 'like', "%{$value}%")
                    ->orWhere('category_name_en','like', "%{$value}%");
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $categories = Category::with('categories')
                ->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'categories' => $categories,
            'search' => $search,
        ];

        // $ids = $request->bulk_ids;
        // $now = Carbon::now()->toDateTimeString();
        // if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
        //     $data = ['status' => $request->status];
        //     $this->authorize('change_categories_status');

        //     Category::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        //  if ($request->bulk_action_btn === 'update_status' && $request->role && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role];
        //     $this->authorize('change_categories_role');

        //     ($request->role == 1) ? $data['role_name'] = "category" : $data['role_name'] = 'admin' ;
        //     $is_update = Category::whereIn('id', $ids)->update($data);

        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'update_role' && $request->role_id && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role_id];
        //     Category::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


        //     Category::whereIn('id', $ids)->delete();
        //     return back()->with('success', __('تم الحذف بنجاح'));
        // }
        // $categories = Category::orderBy("created_at","desc")->paginate(10);
        return view("admin.categories.all_categories", $data);
    }

    public function view($id)
    {
        $this->authorize('edit_category');
        // $roles = Role::all();
        $category = Category::findOrFail($id);
        $data = [
            'category'      => $category,
        ];
        return view("admin.categories.show", $data);
    }

    public function edit($id)
    {
        $this->authorize('edit_category');
        // $roles = Role::all();
        $category = Category::findOrFail($id);
        $data = [
            'category'      => $category,
        ];
        return view("admin.categories.show", $data);
    }

    public function create()
    {
        $this->authorize('create_category');

        $category = Category::get();
        $data = [
            'category'      => $category,
        ];
        return view("admin.categories.create", $data);
    }
    public function store(Request $request)
    {
        $this->authorize('create_category');

        $request->validate([
            'category_name_ar'              => "required",
            'category_name_en'              => "required",
        ], [
            'category_name_ar.required'             => __('general.name_required'),
            'category_name_en.required'             => __('general.name_required'),
        ]); 
        try {


            $category = Category::create([
                'category_name_ar'  => $request->category_name_ar,
                'category_name_en'  => $request->category_name_en,
                'category_id'       => $request->category_id ?? 0,
                'description_ar'    => $request->description_ar ?? null,
                'description_en'    => $request->description_en ?? null,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
        return redirect()->route('categories')->with("success", __("general.added_successfully"));
    }
    public function update(Request $request, $id)
    {
        $this->authorize('edit_category');
        $category = Category::findOrFail($id);
        $request->validate([
            'category_name_ar'              => "required",
            'category_name_en'              => "required",
        ], [
            'category_name_ar.required'             => __('general.name_required'),
            'category_name_en.required'             => __('general.name_required'),
        ]);
        try {


            $category->update([
                'category_name_ar'  => $request->category_name_ar,
                'category_name_en'  =>  $request->category_name_en,
                'category_id'       => $request->category_id ?? 0,
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
        $this->authorize('delete_category');

        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route("categories")->with("success", __('general.deleted_successfully'));
    }


    public function bulk_category_delete(Request $request)
    {
        $this->authorize('delete_category');

        $items = bulk_delete($request, 'App\Models\general\Category');
        return $items;
    }
}
