<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Pengguna\MenuModel;
use Illuminate\Support\Facades\Auth;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (Auth::guard('pengguna')->check()) {
            $routeActiveRole = $request
                ->route()
                ->parameter('is_role_aktif');
            if(!is_null($routeActiveRole)){
                $role = RolePenggunaModel::find(
                    Auth::guard('pengguna')->id()
                )
                ->where('id_role',$routeActiveRole)->exists();
            }else{
                $role = RolePenggunaModel::findOrFail(
                    Auth::guard('pengguna')->id()
                );
            }
            if ($role) {
                return $next($request);
            }
            else{
                return abort(403);
            }
        }
        return abort(403);
    }
}
