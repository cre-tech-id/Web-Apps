<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserVerify;
use Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function doLogin(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            session()->flash('message', 'Email belum terdaftar!!!');
            return back();
        }

        $attributes = request()->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($attributes)) {
            $user = Auth::User();
            Session::put('role', $user->role_id);
            Session::put('id', $user->id);
            Session::put('nama', $user->nama);
            Session::put('gambar', $user->foto);
            Session::put('isLoggedin', true);
            session()->regenerate();
            if ($user->role_id == 3) {
                return redirect('/home');
            } else {
                return redirect('/dashboard');
            }
        } else {
            session()->flash('message', 'Email atau password salah!!!');
            return back();
        }
    }

    public function doRegister(Request $request)
    {
        $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/profile/', $name);
        $data = $request->all();
        $validator = Validator::make($data, [
            'nama' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'tempat' => ['required'],
            'tanggal' => ['required'],
            'agama' => ['required'],
            'alamat' => ['required'],
            'no_hp' => ['required'],
            'role_id' => ['required'],
            'password' => ['required', 'max:20'],
            'foto' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2048'],
        ]);

        // if (!$request['foto'] !== $validator) {
        //     session()->flash('message', 'Pastikan Kirim Foto Bukan File!');
        //     return redirect()->back();
        // }

        if ($request['password'] !== $request['confirmpassword']) {
            session()->flash('message', 'Password tidak sama!!!');
            return redirect()->back();
        }

        if ($validator->fails()) {
            session()->flash('message', 'Email sudah terdaftar!!!');
            return redirect()->back();
        } else {
            session()->flash('success', 'Akun sukses dibuat, konfirmasi akun anda!!!');
            $data['ttl'] = $data['tempat'] . ", " . $data['tanggal'];
            $data['password'] = bcrypt($data['password']);
            $data['foto'] = $name;
            $user = User::create($data);
            $token = Str::random(64);
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
            ]);
            Mail::send('emailverification', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Email Verification Mail');
            });
            return redirect('/login');
        }
    }

    public function logout()
    {
        Session::forget('role');
        Session::forget('id');
        Session::forget('isLoggedin');
        Auth::logout();
        return redirect('/')->with(['success' => 'You\'ve been logged out.']);
    }

    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();

        $info = 'Sorry your email cannot be identified.';

        if (!is_null($verifyUser)) {
            $user = $verifyUser->user;

            if (!$user->is_email_verified) {
                $verifyUser->user->emailverification = 1;
                $verifyUser->user->save();
                $info = "Akun anda telah diverifikasi, silakan login.";
            } else {
                $info = "Akun anda sudah diverifikasi";
            }
        }

        return redirect()->route('login')->with('info', $info);
    }

}
