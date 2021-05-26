<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Table\ArahAnginController;
use App\Http\Traits\MenuTrait;
use App\Http\Traits\PenggunaTrait;
use App\Http\Middleware\RoleAuth;
use App\Models\Table\ArahAnginModel;
use App\Models\Table\CuacaModel;
use App\Models\Table\KecepatanAnginModel;
use App\Models\Table\KelembapanModel;
use App\Models\Table\SuhuModel;

class TestingController extends Controller
{
    use MenuTrait, PenggunaTrait;

    public function index() {

        
    }
}
