<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
    public function dashboard()
    {

            $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
            $active= "active";
            $seniman = User::where('role_id','2')->count();
            $user= User::where('role_id','3')->count();
            $kesenian= DB::table('kesenian')->count();
            $karya= DB::table('karya')->count();
            return view('dashboard.dashboard', compact('seniman', 'karya', 'kesenian', 'user', 'active'),['users' => $users]);

    }

    public function DataAdmin()
    {
        $users = DB::table('users')
        ->select('*')
        ->where('id', Session::get('id'))
        ->get();
        $admin = DB::table('users')->where('role_id','1')->get();
        return view('dashboard.admin.data_admin',['admin' => $admin],['users' => $users]);
    }

    public function TambahAdmin()
    {
        $users = DB::table('users')
        ->select('*')
        ->where('id', Session::get('id'))
        ->get();
        return view('dashboard.admin.tambah_admin',['users' => $users]);
    }

    public function doTambahAdmin(Request $request)
    {
        $name = 'image'.'-'.time().'.'.$request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/profile/',$name);

        $admin = new User();
        $admin->nama = $request->input('nama');
        $admin->email = $request->input('email');
        $admin->ttl = $request->input('ttl');
        $admin->agama = $request->input('agama');
        $admin->password = bcrypt($request->input('password'));
        $admin->alamat = $request->input('alamat');
        $admin->no_hp = $request->input('no_hp');
        $admin->role_id = $request->input('role');
        $admin->foto = $name;
        $admin->save();
        return redirect('dashboard/dataadmin');
    }

    public function EditAdmin($id){
        $users = DB::table('users')
        ->select('*')
        ->where('id', Session::get('id'))
        ->get();
        $role = DB::table('role')->get();
        $admin = DB::table('users')
            ->select('users.*', 'role.id as idRole' , 'role.role')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', $id)
            ->get();
        return view('dashboard.admin.edit_admin', ['admin' => $admin], ['role' => $role],['users' => $users]);
    }

    public function doEditAdmin(Request $request){
        if($request->hasFile('foto')){
            $name = 'image'.'-'.time().'.'.$request->file('foto')->getClientOriginalExtension();
            $path = $request->file('foto')->storeAs('public/upload/profile/',$name);
            User::where('id',$request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                // 'password' => bcrypt($request->password),
                'role_id' => $request->role,
                'foto' => $name
            ]);
        }else{
            User::where('id',$request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                // 'password' => bcrypt($request->password),
                'role_id' => $request->role
            ]);
        }
        return redirect('dashboard/dataadmin');
    }

    public function Delete($id){
        User::where('id', $id)->delete();
        return redirect('/dashboard/dataadmin');
    }
}
