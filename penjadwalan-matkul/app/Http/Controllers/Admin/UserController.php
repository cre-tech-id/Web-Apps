<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Libs\Checking;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $users = User::orderBy('id', 'Asc');

        if (!empty($request->searchname))
        {
            $users = $users->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        if (!empty($request->searchemail))
        {
            $users = $users->where('email', 'LIKE', '%' . $request->searchemail . '%');
        }

        $users = $users->paginate(10);

        return view('admin.user.index', compact('users'));
    }

    public function create(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'emailuser' => 'unique:users,email|required',
            'password'  => 'required|confirmed',
            'name'      => 'required',
            'role'      => 'required',
        ]);

        $params = [
            'email'    => $request->input('emailuser'),
            'password' => Hash::make($request->input('password')),
            'name'     => $request->input('name'),
            'role'     => $request->input('role'),
        ];
// dd($params);/
        $users = User::create($params);

        return redirect()->route('admin.user');
    }

    public function edit($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $users = User::find($id);

        if ($users == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.user.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $role = Auth::user()->role;
        Checking::check($role);

        $this->validate($request, [
            'emailuser' => 'unique:users,email,' . $id . '|required',
            'password'  => '',
            'name'      => 'required',
            'role'      => 'required',
        ]);

        $users = User::find($id);

        if (!empty($request->input('password')))
        {
            $users->password = Hash::make($request->input('password'));
        }

        $users->email = $request->input('emailuser');
        $users->name  = $request->input('name');
        $users->role  = $request->input('role');
        $users->save();

        return redirect()->route('admin.user');
    }

    public function destroy($id)
    {
        $role = Auth::user()->role;
        Checking::check($role);
        
        User::find($id)->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus');
    }
}
