<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()

    {
//        $this->middleware('permission:view role', ['only' => ['index']]);
//        $this->middleware('permission:create role', ['only' => ['create','store','addPermissionToRole','givePermissionToRole']]);
//        $this->middleware('permission:update role', ['only' => ['update','edit']]);
//        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    public function index()
    {
        abort_if(!auth()->user()->can('view role'),403,__('User does not have the right permissions.'));
        $roles = Role::get();

        return view('admin.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        $role_permission = Permission::select('name','id')->get();
//        return $role_permission;

        $custom_permission = array();

        foreach($role_permission as $per){
//            $this->after('@', 'biohazard@online.ge');
            $module= strstr($per->name, " ");
//            $key = substr($per->name, 0, strstr($per->name, " "));
            $key = str_replace(' ','_',$module);
//            $key=
//return $key;
            if(str_ends_with($per->name, $module)){
                $custom_permission[$key][] = $per;
            }

        }
//        return $custom_permission;

//        $permissions = Permission::get();
////        $role = Role::findOrFail($roleId);
//        $rolePermissions = DB::table('role_has_permissions')
////            ->where('role_has_permissions.role_id', $role->id)
//            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
//            ->all();
////return $permissions;
////        return view('role-permission.role.add-permissions', [
//        return view('role-permission.role.create', [
////            'role' => $role,
//            'permissions' => $permissions,
//            'rolePermissions' => $rolePermissions
//        ]);

        return view('role-permission.role.create',[
            'custom_permission'=>$custom_permission
        ]);
    }

    public function store(Request $request)
    {
//        return $request;

        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);



        $role= Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->permissions);

        return redirect('roles')->with('status','Role Created Successfully');
    }

    public function edit(Role $role)
    {
        return view('role-permission.role.edit',[
            'role' => $role
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);

        return redirect('roles')->with('status','Role Updated Successfully');
    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status','Role Deleted Successfully');
    }

    public function addPermissionToRole($roleId)
    {
//        return 'sarowar';
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);

        $role_permission = Permission::select('name','id')->get();

        $custom_permission = array();

        foreach($role_permission as $per){
            $module= strstr($per->name, " ");
            $key = str_replace(' ','_',$module);
            if(str_ends_with($per->name, $module)){
                $custom_permission[$key][] = $per;
            }
        }

//        $rolePermissions = DB::table('role_has_permissions')
//            ->where('role_has_permissions.role_id', $role->id)
//            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
//            ->all();

        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'custom_permission'=>$custom_permission,
//            'permissions' => $permissions,
//            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
//        return $request;
        $request->validate([
            'permissions' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permissions);

        return redirect()->back()->with('status','Permissions added to role');
    }


}
