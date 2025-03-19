<?php

namespace App\Http\Controllers\RolesAndUsersManagement;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserManagementController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){

        $this->authorize('user_management');
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $users = User::when($request['search'], function ($q) use($request){
                $key = explode(' ', $request['search']);
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
                }
            })
            ->latest()->paginate()->appends($query_param);

        if(isset($search) && empty($search)) {
            $users = User::with('users')
            ->orderBy('created_at', 'asc')
            ->paginate(10);
        } 
        
        $data = [
            'users' => $users,
            'search' => $search,
        ];
        
        // $ids = $request->bulk_ids;
        // $now = Carbon::now()->toDateTimeString();
        // if ($request->bulk_action_btn === 'update_status' && $request->status && is_array($ids) && count($ids)) {
        //     $data = ['status' => $request->status];
        //     $this->authorize('change_users_status');
          
        //     User::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        //  if ($request->bulk_action_btn === 'update_status' && $request->role && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role];
        //     $this->authorize('change_users_role');

        //     ($request->role == 1) ? $data['role_name'] = "user" : $data['role_name'] = 'admin' ;
        //     $is_update = User::whereIn('id', $ids)->update($data);
            
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'update_role' && $request->role_id && is_array($ids) && count($ids)) {
        //     $data = ['role_id' => $request->role_id];
        //     User::whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('تم التحديث بنجاح'));
        // }
        // if ($request->bulk_action_btn === 'delete' &&  is_array($ids) && count($ids)) {


        //     User::whereIn('id', $ids)->delete();
        //     return back()->with('success', __('تم الحذف بنجاح'));
        // }
        // $users = User::orderBy("created_at","desc")->paginate(10);
        return view("admin.users.all_users", $data);
    }

    public function view($id){
        $this->authorize('edit_user');
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view("admin.users.show", compact("user" , 'roles'));
    }

    public function edit($id){
        $this->authorize('edit_user');
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view("admin.users.show", compact("user" , 'roles'));
    }

    public function create(){
        $this->authorize('create_user');

        $roles = Role::all();
        return view("admin.users.create" , compact("roles"));
    }
    public function store(Request $request){
        $this->authorize('create_user');
        $request->validate([
            'name'              => "required",
            'user_name'         => "required|unique:users",
            'password'          => "required",
        ],[
            'name.required'             => __('general.name_required'),
            'user_name.required'        =>  __('general.username_required'),
            'user_name.unique'          =>  __('general.username_is_already_token'),
            'password.required'         => __('general.password_required'),
        ]);
        $role = Role::where("id", $request->role_id)->first();
        $user = User::create([
            'name' => $request->name,
            'user_name' =>  $request->user_name,
            'role_name' => $role->role_name ?? 'casher',
            'role_id' => $role->role_id ?? 1,
            'email' => $request->email ?? null,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('user_management')->with("success", __("general.added_successfully"));

    }
    public function update(Request $request , $id){
        $this->authorize('edit_user');
        $user = User::findOrFail($id);
        $role = Role::where("id", $request->role)->first();
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
           
        ],[
            'user_name.unique'=>  __('general.username_is_already_token'),
        ]);
        $user->update([
            "name"=> $request->name,
            "user_name"=> $request->user_name,
            "email"=> $request->email,
            "role_id"   => $role->id ?? $user->role_id,
            "role_name"   => $role->name ?? $user->role_name,
        ]);
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }
        return redirect()->back()->with("success", __('general.updated_successfully'));
    }

    public function destroy($id){
        $this->authorize('delete_user');

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route("user_management")->with("success", __('general.deleted_successfully') );
    }

    public function update_status(Request $request)
    {
        $this->authorize('change_users_status');

        $user = User::findOrFail($request->id);
        $user->status = $request->status;
        $user->save();
        // Cache::forget('todays_deal_products');
        return  1;
    }
    public function bulk_user_delete(Request $request){
        $this->authorize('delete_user');

        $items = bulk_delete($request ,'App\Models\User' );
        return $items;
    }
}
