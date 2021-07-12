<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Pengguna\RolePenggunaModel;
use App\Models\Pengguna\AksesModel;
use App\Models\Pengguna\MenuGroupModel;
use App\Models\Pengguna\MenuModel;
use Illuminate\Support\Facades\Auth;

class AksesAuth
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
            $group_menu = $request->segment(1);
            $menu = $request->segment(2);
            $id_group_menu = MenuGroupModel::where('url_group',$group_menu)->where('is_aktif','1')->value('id_group');
            if(is_null($id_group_menu)){
                return abort(404);
            }
            $id_menu = MenuModel::where('id_group',$id_group_menu)->where('url_menu',$menu)->where('is_aktif','1')->value('id_menu');
            if(is_null($id_menu)){
                return abort(404);
            }
            $akses = AksesModel::where('id_menu',$id_menu)->where('is_aktif','1')->exists();
            if ($akses) {
               return $next($request);
            }
            return abort(403);
        }
        return abort(403);
    }
}
