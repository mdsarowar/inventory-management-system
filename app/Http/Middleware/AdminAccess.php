<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
//        $user = Auth::user();
//
//        if ($user) {
//            $roles            = \Spatie\Permission\Models\Role::with('permissions')->get();
//            echo $roles;
//            $permissionsArray = [];
//
//            foreach ($roles as $role) {
//                foreach ($role->permissions as $permissions) {
////                    $permissionsArray[$permissions->title][] = $role->id;
//                    $permissionsArray[$permissions->slug][] = $role->id;
//                }
//            }
//
////            foreach ($permissionsArray as $title => $roles) {
//            foreach ($permissionsArray as $slug => $roles) {
////                Gate::define($title, function ($user) use ($roles) {
//                Gate::define($slug, function ($user) use ($roles) {
//                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
//                });
//            }
//        }
//
//        return $next($request);
//    }
//    }
        if (Auth::check()){
                return $next($request);
        }else{
            return redirect()->route('login');
        }

    }
}
