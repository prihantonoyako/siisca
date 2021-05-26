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

        if (Auth::check()) {
            $routeActiveRole = $request
                ->route()
                ->parameter('id_role');
            if(!is_null($routeActiveRole)){
                $role = RolePenggunaModel::find(
                    Auth::id()
                )
                ->where('id_role',$routeActiveRole)->exists();
            }else{
                $role = RolePenggunaModel::findOrFail(
                    Auth::id()
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
