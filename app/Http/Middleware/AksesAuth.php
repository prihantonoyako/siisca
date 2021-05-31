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
            $id_group_menu = MenuGroupModel::where('nama_group',$group_menu)->firstOrFail()->value('id_group');
            $id_menu = MenuModel::where('id_group',$id_group_menu)->where('nama_menu',$menu)->firstOrFail()->value('id_menu');
            $akses = AksesModel::where('id_menu',$id_menu)->exists();
            if ($akses) {
               return $next($request);
            }
            return abort(403);
        }
        return abort(403);
    }
}
