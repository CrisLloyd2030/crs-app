<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;

class AdminUserRolesController extends Controller
{
    public function getIndex(){

        $data['roles'] = Roles::with(['createdBy','updatedBy'])->get();
        return view('pages.admin_roles', $data);
    }
}
