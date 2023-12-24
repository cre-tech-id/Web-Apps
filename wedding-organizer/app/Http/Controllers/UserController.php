<?php

namespace App\Http\Controllers;

use App\Models\dataPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function dataUser()
    {
        $user = DB::table('users')->where('role_id','3')->get();
 
        return view('user.data_user',['user' => $user]);
    }

    public function viewTambahUser()
    {
        return view('user.tambah_user');
    }

    public function tambahDataUser(Request $request)
    {   
        $user = new dataPengguna();
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $request->input('role');
        $user->alamat = $request->input('alamat');
        $user->no_hp = $request->input('no_hp');
        $user->save();
        return redirect('/user');
    }

    public function hapusDataUser($id){
        dataPengguna::where('id', $id)->delete();
        return redirect('/user');

    }

    public function editDataUser($id){
        $role = DB::table('role')->get();
        $user = DB::table('users')
            ->select('users.*', 'role.id as idRole' , 'role.role')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', $id)
            ->get();
        return view('user.edit_user', ['user' => $user], ['role' => $role]);

    }

    public function postEditUser(Request $request)
{
	dataPengguna::where('id',$request->id)->update([
		'nama' => $request->nama,
        'email' => $request->email,
        'alamat' => $request->alamat,
        'no_hp' => $request->no_hp,
		// 'password' => bcrypt($request->password),
		'role_id' => $request->role
	]);
	return redirect('/user');
}

}
