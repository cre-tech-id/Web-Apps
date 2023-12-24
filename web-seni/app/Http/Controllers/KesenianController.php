<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kesenian;
use Illuminate\Support\Facades\DB;
use Session;

class KesenianController extends Controller
{
    public function DataKesenian()
    {
        if (Session::get('role') == '2') {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $kesenian = DB::table('kesenian')->where('id_seniman', Session::get('id'))->get();
            return view('dashboard.kesenian.data_kesenian', ['kesenian' => $kesenian], ['users' => $users]);
        } else {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $kesenian = DB::table('kesenian')
                ->select('kesenian.*', 'users.nama')
                ->join('users', 'kesenian.id_seniman', '=', 'users.id')
                ->get();
            return view('dashboard.kesenian.data_kesenian', ['kesenian' => $kesenian], ['users' => $users]);
        }
        return view('dashboard.kesenian.data_kesenian', ['kesenian' => $kesenian]);
    }

    public function TambahKesenian()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $seniman = DB::table('users')->where('role_id', '2')->get();
        return view('dashboard.kesenian.tambah_kesenian', ['seniman' => $seniman], ['users' => $users]);
    }

    public function doTambahKesenian(Request $request)
    {
        $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/kesenian/', $name);

        $kesenian = new Kesenian();
        $kesenian->nama_kesenian = $request->input('nama_kesenian');
        $kesenian->id_seniman = $request->input('id_seniman');
        $kesenian->deskripsi = $request->input('deskripsi');
        $kesenian->kategori = $request->input('kategori');
        $kesenian->harga = $request->input('harga');
        $kesenian->foto = $name;
        $kesenian->save();
        return redirect('dashboard/datakesenian');
    }

    public function EditKesenian($id)
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $seniman = DB::table('users')->where('role_id', '2')->get();
        $kesenian = DB::table('kesenian')
            ->select('kesenian.*', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kesenian.id', $id)
            ->get();
        return view('dashboard.kesenian.edit_kesenian', ['users' => $users], ['kesenian' => $kesenian], ['seniman' => $seniman]);
    }

    public function doEditKesenian(Request $request)
    {
        if ($request->hasFile('foto')) {
            $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $path = $request->file('foto')->storeAs('public/upload/kesenian/', $name);
            Kesenian::where('id', $request->id)->update([
                'nama_kesenian' => $request->nama_kesenian,
                'id_seniman' => $request->id_seniman,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'foto' => $name
            ]);
        } else {
            Kesenian::where('id', $request->id)->update([
                'nama_kesenian' => $request->nama_kesenian,
                'id_seniman' => $request->id_seniman,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
            ]);
        }
        return redirect('dashboard/datakesenian');
    }

    public function DeleteKesenian($id)
    {
        Kesenian::where('id', $id)->delete();
        return redirect('/dashboard/datakesenian');
    }
}