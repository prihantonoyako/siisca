<?php

namespace App\Http\Middleware;

use App\Models\Pengguna\RoleModel;
use Closure;
use Illuminate\Http\Request;
use App\Models\Pengguna\RolePenggunaModel;
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
            if (!is_null($routeActiveRole)) {
                $role = RolePenggunaModel::where('id_role', $routeActiveRole)->where('id_pengguna', Auth::id())->exists();
                $roleIsAktif = RoleModel::where('id_role',$routeActiveRole)->where('is_aktif','1')->exists();
                if ($role&&$roleIsAktif) {
                    return $next($request);
                }
                return abort(403);
            }
            return abort(404);
        }
        return abort(403);
    }
}
