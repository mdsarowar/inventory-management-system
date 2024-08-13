<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create','store']]);
        $this->middleware('permission:update user', ['only' => ['update','edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
//        return auth()->user()->hasRole('super admin');
//        if (auth()->user()->hasRole('super admin')){
            $users = User::get();

//        }else{
//            $users = User::latest()->take(2)->get();
//        }


        return view('admin.user.index', ['users' => $users]);
    }

    public function create()
    {
//        return session()->get('success');
        $roles = Role::pluck('name','name')->all();
        return view('admin.user.create', ['roles' => $roles]);
//        return view('role-permission.user.create', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required'
        ]);

        $user = User::createOrUpdateUser($request);
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
        return $user;

        $user->syncRoles($request->roles);

        return redirect()->route('admins.index')->with('success','User created successfully with roles');
    }

    public function edit(string $id)
    {
//        return $id;
        $user=User::find($id);
        $roles = Role::pluck('name','name')->all();

        $userRoles = $user->roles->pluck('name','name')->all();
        return view('admin.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required'
        ]);

//        $data = [
//            'name' => $request->name,
//            'email' => $request->email,
//        ];
//
//        if(!empty($request->password)){
//            $data += [
//                'password' => Hash::make($request->password),
//            ];
//        }
        $user = User::createOrUpdateUser($request,$id);
//return $user;
//        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('admins.index')->with('success','User Updated Successfully with roles');
    }

    public function destroy(string $id)
    {
//        return 'sarowar';
//        return $id;
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admins.index')->with('error','User Delete Successfully');
    }
}
