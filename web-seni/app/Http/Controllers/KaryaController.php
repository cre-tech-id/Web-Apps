<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Karya;
use Illuminate\Support\Facades\DB;
use Session;

class KaryaController extends Controller
{
    public function DataKarya()
    {
        if (Session::get('role') == '2') {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $karya = DB::table('karya')->where('id_seniman', Session::get('id'))->get();
            return view('dashboard.karya.data_karya', ['karya' => $karya], ['users' => $users]);
        } else {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $karya = DB::table('karya')
                ->select('karya.*', 'users.nama')
                ->join('users', 'karya.id_seniman', '=', 'users.id')
                ->get();
            return view('dashboard.karya.data_karya', ['karya' => $karya], ['users' => $users]);
        }
        return view('dashboard.karya.data_karya', ['karya' => $karya], ['users' => $users]);
    }

    public function TambahKarya()
    {
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        $seniman = DB::table('users')->where('role_id', '2')->get();
        return view('dashboard.karya.tambah_karya', ['seniman' => $seniman], ['users' => $users]);
    }

    public function doTambahKarya(Request $request)
    {
        $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
        $path = $request->file('foto')->storeAs('public/upload/karya/', $name);

        $karya = new Karya();
        $karya->nama_karya = $request->input('nama_karya');
        $karya->id_seniman = $request->input('id_seniman');
        $karya->deskripsi = $request->input('deskripsi');
        $karya->kategori = $request->input('kategori');
        $karya->harga = $request->input('harga');
        $karya->stok = $request->input('stok');
        $karya->foto = $name;
        $karya->save();
        return redirect('dashboard/datakarya');
    }

    public function EditKarya($id)
    {
        $seniman = DB::table('users')->where('role_id', '2')->get();
        $karya = DB::table('karya')
            ->select('karya.*', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->where('karya.id', $id)
            ->get();
        $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
        return view('dashboard.karya.edit_karya', ['users' => $users], ['karya' => $karya], ['seniman' => $seniman]);
    }

    public function doEditKarya(Request $request)
    {
        if ($request->hasFile('foto')) {
            $name = 'image' . '-' . time() . '.' . $request->file('foto')->getClientOriginalExtension();
            $path = $request->file('foto')->storeAs('public/upload/karya/', $name);
            Karya::where('id', $request->id)->update([
                'nama_karya' => $request->nama_karya,
                'id_seniman' => $request->id_seniman,
                'deskripsi' => $request->deskripsi,
                'kategori' => $request->kategori,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'foto' => $name
            ]);
        } else {
            Karya::where('id', $request->id)->update([
                'nama_karya' => $request->nama_karya,
                'id_seniman' => $request->id_seniman,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'stok' => $request->stok,
            ]);
        }
        return redirect('dashboard/datakarya');
    }

    public function DeleteKarya($id)
    {
        Karya::where('id', $id)->delete();
        return redirect('/dashboard/datakarya');
    }
}