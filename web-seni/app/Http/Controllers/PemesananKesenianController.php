<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PemesananKesenian;
use Illuminate\Support\Facades\DB;
use Session;

class PemesananKesenianController extends Controller
{
    public function PemesananKesenian()
    {
        if(Session::get('role')=='2'){
            $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
            $p_kesenian = DB::table('users')
            ->select('pemesanan_kesenian.id','users.nama as nama_pemesan', 'tb.nama_kesenian', 'tb.nama_penyedia', 'pemesanan_kesenian.tanggal_book', 'pemesanan_kesenian.lokasi', 'pemesanan_kesenian.status', 'pemesanan_kesenian.pembayaran')
            ->join('pemesanan_kesenian', 'pemesanan_kesenian.pemesan_id', '=', 'users.id')
            ->join(\DB::raw('(select kesenian.id, kesenian.nama_kesenian, kesenian.id_seniman, users.nama as nama_penyedia from kesenian inner
            join users on kesenian.id_seniman = users.id) as tb'), 'tb.id', '=', 'pemesanan_kesenian.kesenian_id')
            ->where('tb.id_seniman', Session::get('id'))
            ->get();
            return view('dashboard.pemesanan_kesenian.data_pemesanan_kesenian',['p_kesenian' => $p_kesenian],['users' => $users]);
        }else{
            $users = DB::table('users')
            ->select('*')
            ->where('id', Session::get('id'))
            ->get();
            $p_kesenian = DB::table('users')
            ->select('pemesanan_kesenian.id','users.nama as nama_pemesan', 'tb.nama_kesenian', 'tb.nama_penyedia', 'pemesanan_kesenian.tanggal_book', 'pemesanan_kesenian.lokasi', 'pemesanan_kesenian.status', 'pemesanan_kesenian.pembayaran')
            ->join('pemesanan_kesenian', 'pemesanan_kesenian.pemesan_id', '=', 'users.id')
            ->join(\DB::raw('(select kesenian.id, kesenian.nama_kesenian, kesenian.id_seniman, users.nama as nama_penyedia from kesenian inner
            join users on kesenian.id_seniman = users.id) as tb'), 'tb.id', '=', 'pemesanan_kesenian.kesenian_id')
            ->get();
            return view('dashboard.pemesanan_kesenian.data_pemesanan_kesenian',['p_kesenian' => $p_kesenian],['users' => $users]);
        }
        return view('dashboard.pemesanan_kesenian.data_pemesanan_kesenian',['p_kesenian' => $p_kesenian],['users' => $users]);
    }

    public function tambahPesananKesenian(Request $request)
    {
        $validation = DB::table('pemesanan_kesenian')
            ->select('*')
            ->where('status', 'Diterima')
            ->where('tanggal_book', '19/07/2023')
            ->get();
        if($validation->isNotEmpty()){
            return redirect()->back()->withSuccess('Sudah terbooking untuk tanggal tersebut, silahkan pilih tanggal lain');
        }
        $pemesanan = new PemesananKesenian();
        $pemesanan->pemesan_id = $request->input('pemesan_id');
        $pemesanan->kesenian_id = $request->input('kesenian_id');
        $pemesanan->lokasi = $request->input('lokasi');
        $pemesanan->tanggal_book = $request->input('tanggal');
        $pemesanan->status = "-";
        $pemesanan->pembayaran ="-";

        $pemesanan->save();
        session()->flash('success', 'Pesanan sukses dibuat!!!');
        return redirect('/pesanankesenian');
    }

    public function terimaPesanan($id){
        PemesananKesenian::where('id',$id)->update([
            'status' => 'Diterima'
        ]);
        return redirect('/dashboard/pemesanankesenian');
    }

    public function tolakPesanan($id){
        PemesananKesenian::where('id',$id)->update([
            'status' => 'Ditolak'
        ]);
        return redirect('/dashboard/pemesanankesenian');

    }

    public function updatePembayaran(Request $request, $id){
        PemesananKesenian::where('id',$id)->update([
            'pembayaran' => $request->pembayaran,
        ]);
        return redirect('/dashboard/pemesanankesenian');
    }
}
