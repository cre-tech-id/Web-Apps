<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rating;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Session;

class RegisterController extends Controller
{
    public function create()
    {
        $kota = \Indonesia::findProvince(13, ['cities'])->cities->sortBy('name')->pluck('name', 'id');
        $route_get_kecamatan = route('get.kecamatan');
        $route_get_desa = route('get.desa');
        return view('session.register', compact('kota', 'route_get_kecamatan', 'route_get_desa'));
    }

    public function getKecamatan()
    {
        $kota_id = request('kota_id');
        $kecamatan = \Indonesia::findCity($kota_id, ['districts'])->districts->sortBy('name')->pluck('name', 'id');
        return view('session.list_kecamatan', compact('kecamatan'));
    }

    public function getDesa()
    {
        $kecamatan_id = request('kecamatan_id');
        $desa = \Indonesia::findDistrict($kecamatan_id, ['villages'])->villages->sortBy('name')->pluck('name', 'id');
        return view('session.list_desa', compact('desa'));
    }


    public function store(Request $request)
    {
        $attributes = request()->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'no_hp' => ['required', 'min:5', 'max:20'],
            'desc' => ['required'],
            'role_id' => ['required'],
        ]);

        $desa = $request->input('desa_id');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan_id');
        $detail = $request->input('jl');
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['desa'] = $desa;
        $attributes['kecamatan'] = $kecamatan;
        $attributes['kota'] = $kota;
        $attributes['detail_alamat'] = $detail;
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
        $kota = \Indonesia::findProvince(13, ['cities'])->cities->sortBy('name')->pluck('name', 'id');
        $route_get_kecamatan = route('get.kecamatan');
        $route_get_desa = route('get.desa');
        return view('session.register_user', compact('kota', 'route_get_kecamatan', 'route_get_desa'));
    }

    public function doUserRegister(Request $request)
    {
        $attributes = request()->validate([
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'no_hp' => ['required', 'min:5', 'max:20'],
            'role_id' => ['required'],
        ]);

        $desa = $request->input('desa_id');
        $kota = $request->input('kota');
        $kecamatan = $request->input('kecamatan_id');
        $detail = $request->input('jl');
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['desa'] = $desa;
        $attributes['desc'] = '-';
        $attributes['kecamatan'] = $kecamatan;
        $attributes['kota'] = $kota;
        $attributes['detail_alamat'] = $detail;
        if ($request->hasFile('gambar')) {
            $name = 'image' . '-' . time() . '.' . $request->file('gambar')->getClientOriginalExtension();
            $path = $request->file('gambar')->storeAs('public/upload/profile/', $name);
            $attributes['gambar'] = $name;
        } else {
            $attributes['gambar'] = 'default_profile.png';
        }
        $user = User::create($attributes);

        return redirect('register-succes');
    }

    public function registeredUser()
    {
        return view('session.help_success_regist');
    }
}
