<?php

namespace App\Http\Controllers;

use App\Models\dataPengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dataAdmin()
    {
        $admin = DB::table('users')->where('role_id','1')->get();

    	// mengirim data pegawai ke view index
        return view('admin.data_admin',['admin' => $admin]);
    }

    public function viewTambahAdmin()
    {
        return view('admin.tambah_admin');
    }

    public function tambahDataAdmin(Request $request)
    {
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/profile/',$name);

        $admin = new User();
        $admin->nama = $request->input('nama_admin');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->no_hp = $request->input('no_hp');
        $admin->role_id = $request->input('role');
        $admin->gambar = $name;
        $admin->save();

        return redirect('/admin');
    }

    public function hapusDataAdmin($id){
        dataPengguna::where('id', $id)->delete();
        return redirect('/admin');

    }

    public function editDataAdmin($id){
        $role = DB::table('role')->get();
        $admin = DB::table('users')
            ->select('users.*', 'role.id as idRole' , 'role.role')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', $id)
            ->get();
        return view('admin.edit_admin', ['admin' => $admin], ['role' => $role]);

    }

    public function postEditAdmin(Request $request)
{
    if($request->hasFile('gambar')){
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/profile/',$name);
        dataPengguna::where('id',$request->id)->update([
            'nama' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            // 'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'gambar' => $name
        ]);
    }else{
        dataPengguna::where('id',$request->id)->update([
            'nama' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            // 'password' => bcrypt($request->password),
            'role_id' => $request->role
        ]);
    }
	return redirect('/admin');
}

}
