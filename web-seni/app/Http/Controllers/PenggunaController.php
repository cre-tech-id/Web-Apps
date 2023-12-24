<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;

class PenggunaController extends Controller
{
    public function DataPengguna()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $pengguna = DB::table('users')->where('role_id','3')->get();
        return view('dashboard.pengguna.data_pengguna',['pengguna' => $pengguna],['users' => $users]);
    }

    public function TambahPengguna()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        return view('dashboard.pengguna.tambah_pengguna',['users' => $users]);
    }

    public function doTambahPengguna(Request $request)
    {
        $name = 'image'.'-'.time().'.'.$request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/profile/',$name);

        $pengguna = new User();
        $pengguna->nama = $request->input('nama');
        $pengguna->email = $request->input('email');
        $pengguna->ttl = $request->input('ttl');
        $pengguna->agama = $request->input('agama');
        $pengguna->password = bcrypt($request->input('password'));
        $pengguna->alamat = $request->input('alamat');
        $pengguna->no_hp = $request->input('no_hp');
        $pengguna->role_id = $request->input('role');
        $pengguna->foto = $name;
        $pengguna->save();
        return redirect('dashboard/datapengguna');
    }

    public function EditPengguna($id){
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $role = DB::table('role')->get();
        $pengguna = DB::table('users')
            ->select('users.*', 'role.id as idRole' , 'role.role')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', $id)
            ->get();
        return view('dashboard.pengguna.edit_pengguna', ['pengguna' => $pengguna], ['role' => $role],['users' => $users]);
    }

    public function doEditPengguna(Request $request){
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
        return redirect('dashboard/datapengguna');
    }

    public function DeletePengguna($id){
        User::where('id', $id)->delete();
        return redirect('/dashboard/datapengguna');
    }
}
