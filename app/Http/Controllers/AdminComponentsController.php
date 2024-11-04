<?php

namespace App\Http\Controllers;

use App\Models\ModuleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminComponentsController extends Controller
{
    public function getModules()
    {
        $modules = ModuleModel::all();
        $data['modules_data'] = $modules;
        foreach ($modules as $module) {
            $module->router = route($module->route);
        }
        return response()->json($data);
    }
}
