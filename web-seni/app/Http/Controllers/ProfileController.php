<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProfileCOntroller extends Controller
{
    public function profile()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        return view('dashboard.profile.profile', ['users' => $users]);
    }

    public function editProfile($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('dashboard.profile.edit_profile', ['users' => $users]);
    }

    public function doEditProfile(Request $request)
    {
        if ($request->hasFile('foto')) {
            $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $path = $request->file('foto')->storeAs('public/upload/profile/', $name);
            User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'agama' => $request->agama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'role_id' => $request->role,
                'foto' => $name
            ]);
        } else {
            User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'agama' => $request->agama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                // 'password' => bcrypt($request->password),
                'role_id' => $request->role
            ]);
        }
        return redirect('profile');
    }

    public function userProfile()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        return view('dashboard.pengguna.profile', ['users' => $users]);
    }

    public function editUserProfile($id)
    {
        $users = DB::table('users')->where('id', $id)->get();
        return view('dashboard.pengguna.edit_profile', ['users' => $users]);
    }

    public function doEditUserProfile(Request $request)
    {
        if ($request->hasFile('foto')) {
            $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $path = $request->file('foto')->storeAs('public/upload/profile/', $name);
            User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'agama' => $request->agama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'role_id' => $request->role,
                'foto' => $name
            ]);
        } else {
            User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'agama' => $request->agama,
                'ttl' => $request->ttl,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                // 'password' => bcrypt($request->password),
                'role_id' => $request->role
            ]);
        }
        return redirect('userprofile');
    }
}