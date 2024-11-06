<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserHelpers
{

    public static function myId()
    {
        return Auth::id();
    }

    public static function myProfile()
    {
        return Auth::user()->profile;
    }

    public static function myRoleId()
    {
        $get_info = User::with('roles', 'communities')->where('id', self::myId())->first();
        return $get_info->roles->first()->pivot->role_id;
    }

    public static function myCommunityId()
    {
        $get_info = User::with('roles', 'communities')->where('id', self::myId())->first();
        return $get_info->communities->first()->pivot->community_id;
    }
}
