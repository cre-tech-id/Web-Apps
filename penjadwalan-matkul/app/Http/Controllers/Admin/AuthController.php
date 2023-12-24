<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function homepage(Request $request)
    {
        return view('admin.site.homepage');
    }
    public function index(Request $request)
    {
        return view('admin.site.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);

        $attempts = [
            'email'    => $request->input('email'),
            'password' => $request->input('password'),
        ];
        // dd($attempts);
        if (Auth::attempt($attempts))
        {
            $role = auth()->user()->role;
            if($role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else if($role == 'dosen'){
                return redirect()->route('admin.jadwal.result',['id' => 1]);
            }else{
                return back();
            }                        
        }

        $error = 'Invalid email or password';

        $request->session()->flash('danger', $error);

        return back();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
