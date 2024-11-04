<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminUserRolesController extends Controller
{
    public function getIndex(){
        return view('pages.admin_roles');
    }
}
