<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
use User;

class SessionsController extends Controller
{
    public function create()
    {
        
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'email'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            $user = Auth::User();
            Session::put('role', $user->role_id);
            Session::put('id', $user->id);
            session()->regenerate();
            print_r(session()->all()) ;
            return redirect('dashboard');
        }
        else{

            return back()->withErrors(['email'=>'Email or password invalid.']);
        }
    }
    
    public function destroy()
    {
        Session::forget('role');
        Session::forget('id');
        Auth::logout();
        return redirect('/login')->with(['success'=>'You\'ve been logged out.']);
    }
}
