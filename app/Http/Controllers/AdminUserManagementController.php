<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserManagementController extends Controller
{
    public function getIndex()
    {
        $data['community'] = Community::all();
        $data['roles'] = Roles::all();
        $data['users'] = User::with(['roles', 'communities'])->get();

        // dd($data['users']);
        return view('pages.admin_users_management', $data);
    }

    public function postSave(Request $request)
    {
        try {
            $request->validate([
                'community' => 'required',
                'role' => 'required',
                'firstname' => 'required|string|max:255',
                'middlename' => 'nullable|string|max:255',
                'lastname' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'profileImg' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => true, 'messages' => $e->validator->errors()], 422);
        }

        $profilePath = null;
        if ($request->hasFile('profileImg')) {
            $profilePath = $request->file('profileImg')->store('profiles', 'public');
        }

        $user = User::firstOrCreate([
            'lastname' => $request->input('lastname'),
            'firstname' => $request->input('firstname'),
            'middlename' => $request->input('middlename'),
            'profile' => $profilePath,
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);

        if ($user) {
            $user->roles()->attach($request->input('role'), [
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now()
            ]);

            $user->communities()->attach($request->input('community'), [
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now()
            ]);

            $users = User::with(['roles', 'communities'])->get();

            foreach ($users as $row) {
                $row->created_date = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                $row->updated_date = Carbon::parse($row->updated_at)->format('Y-m-d H:i:s');
            }

            return response()->json(['success' => true, 'data' => $users, 'message' => 'User saved successfully']);
        } else {
            return response()->json(['error' => true, 'message' => 'User failed to add']);
        }
    }
}
