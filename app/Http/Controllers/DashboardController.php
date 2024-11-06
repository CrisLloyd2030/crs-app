<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $get_info = User::with('roles', 'communities')->where('id', $user_id)->first();
        return view('pages.Dashboard');
    }
}
