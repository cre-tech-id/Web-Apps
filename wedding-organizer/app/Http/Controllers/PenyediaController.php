<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PenyediaController extends Controller
{ 

    public function dataPenyedia()
    {
        $penyedia = DB::table('users')->where('role_id','2')->get();
 
    	// mengirim data pegawai ke view index
        return view('penyedia.data_penyedia',['penyedia' => $penyedia]);
    }

    public function viewTambahPenyedia()
    {
        return view('penyedia.tambah_penyedia');
    }

    public function tambahDataPenyedia(Request $request)
    {   
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/profile/',$name);

        $penyedia = new User();
        $penyedia->nama = $request->input('nama');
        $penyedia->email = $request->input('email');
        $penyedia->password = bcrypt($request->input('password'));
        $penyedia->alamat = $request->input('alamat');
        $penyedia->no_hp = $request->input('no_hp');
        $penyedia->role_id = $request->input('role_id');
        $penyedia->gambar = $name;
        $penyedia->save();
    
        return redirect('/penyedia');
    }
    
    public function hapusDataPenyedia($id){
        User::where('id', $id)->delete();
        return redirect('/penyedia');

    }

    public function editDataPenyedia($id){
        $role = DB::table('role')->get();
        $penyedia = DB::table('users')
        ->select('users.*', 'role.id as idRole' , 'role.role')
        ->join('role', 'users.role_id', '=', 'role.id')
        ->where('users.id', $id)
        ->get();
        return view('penyedia.edit_penyedia', ['penyedia' => $penyedia], ['role' => $role]);

    }

    public function postEditPenyedia(Request $request)
{
    if($request->hasFile('gambar')){
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/profile/',$name);
        User::where('id',$request->id)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            // 'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'gambar' => $name
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
	return redirect('/penyedia');
}

    public function terimaPenyedia($id){
        User::where('id',$id)->update([
            'is_verify' => '1'
        ]);
        return redirect('/penyedia');
    }

    public function tolakPenyedia($id){
        User::where('id',$id)->update([
            'is_verify' => '2'
        ]);
        return redirect('/penyedia');

    }

}
