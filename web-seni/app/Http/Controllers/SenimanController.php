<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Session;

class SenimanController extends Controller
{
    public function DataSeniman()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $seniman = DB::table('users')->where('role_id','2')->get();
        return view('dashboard.seniman.data_seniman',['seniman' => $seniman],['users' => $users]);
    }

    public function TambahSeniman()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        return view('dashboard.seniman.tambah_seniman',['users' => $users]);
    }

    public function doTambahSeniman(Request $request)
    {
        $name = 'image'.'-'.time().'.'.$request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/profile/',$name);

        $seniman = new User();
        $seniman->nama = $request->input('nama');
        $seniman->email = $request->input('email');
        $seniman->ttl = $request->input('ttl');
        $seniman->agama = $request->input('agama');
        $seniman->password = bcrypt($request->input('password'));
        $seniman->alamat = $request->input('alamat');
        $seniman->no_hp = $request->input('no_hp');
        $seniman->role_id = $request->input('role');
        $seniman->foto = $name;
        $seniman->save();
        return redirect('dashboard/dataseniman');
    }

    public function EditSeniman($id){
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $role = DB::table('role')->get();
        $seniman = DB::table('users')
            ->select('users.*', 'role.id as idRole' , 'role.role')
            ->join('role', 'users.role_id', '=', 'role.id')
            ->where('users.id', $id)
            ->get();
        return view('dashboard.seniman.edit_seniman', ['seniman' => $seniman], ['role' => $seniman],['users' => $users]);
    }

    public function doEditSeniman(Request $request){
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
        return redirect('dashboard/dataseniman');
    }

    public function DeleteSeniman($id){
        User::where('id', $id)->delete();
        return redirect('/dashboard/dataseniman');
    }
}
