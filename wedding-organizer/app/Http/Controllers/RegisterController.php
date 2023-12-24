<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('session.register');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'jl' => ['required', 'min:5', 'max:20'],
            'desa' => ['required', 'min:5', 'max:20'],
            'kec' => ['required', 'min:5', 'max:20'],
            'kota' => ['required', 'min:5', 'max:20'],
            'no_hp' => ['required', 'min:5', 'max:20'],
            'desc' => ['required'],
            'role_id' => ['required'],
        ]);

        $alamat = "{$attributes['jl']}, {$attributes['desa']}, {$attributes['kec']}, {$attributes['kota']}";
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['alamat'] = $alamat;
        if ($request->hasFile('gambar')) {
            $name = 'image' . '-' . time() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('public/upload/profile/', $name);
            $attributes['gambar'] = $name;
        } else {
            $attributes['gambar'] = 'default_profile.png';
        }
        $user = User::create($attributes);

        $rating = new Rating();
        $rating->users_id = '1';
        $rating->penyedia_id = $user->id;
        $rating->rating = '5';
        $rating->save();
        session()->flash('success', 'Akun sukses dibuat, tunggu admin mengkonfirmasi akun anda untuk bisa login!!!');
        return redirect('login');
    }

    public function userRegister()
    {
        return view('session.register_user');
    }

    public function doUserRegister(Request $request)
    {
        $attributes = request()->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'jl' => ['required', 'min:5', 'max:20'],
            'desa' => ['required', 'min:5', 'max:20'],
            'kec' => ['required', 'min:5', 'max:20'],
            'kota' => ['required', 'min:5', 'max:20'],
            'no_hp' => ['required', 'min:5', 'max:20'],
            'role_id' => ['required'],
        ]);
        $alamat = "{$attributes['jl']}, {$attributes['desa']}, {$attributes['kec']}, {$attributes['kota']}";
        $attributes['alamat'] = $alamat;
        if ($request->hasFile('gambar')) {
            $name = 'image' . '-' . time() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('public/upload/profile/', $name);
            $attributes['gambar'] = $name;
        } else {
            $attributes['gambar'] = 'default_profile.png';
        }
        $attributes['password'] = bcrypt($attributes['password']);
        $user = User::create($attributes);

        return redirect('register-succes');
    }

    public function registeredUser()
    {
        return view('session.help_success_regist');
    }
}
