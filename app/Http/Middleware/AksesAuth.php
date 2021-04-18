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
            $role = RolePenggunaModel::findOrFail(
                Auth::guard('pengguna')->id()
            );
            $routeController = $request->route()->getName();

            $menu = MenuModel::where(
                'url','LIKE',$routeController
            );
            $akses = AksesModel::where(
                'id_role',$role
            )->where('id_menu',$menu);
            if($akses != null){
                return $next($request);
            }
        }
        return abort(403);
    }
}
