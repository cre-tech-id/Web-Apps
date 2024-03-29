<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use Session;

class PemesananController extends Controller
{
    public function dataPemesanan()
    {
        if (Session::get('role') == '2') {
            $pemesanan = DB::table('pemesanan')
                ->join('paket', 'pemesanan.paket_id', '=', 'paket.id')
                ->join('users', 'pemesanan.pemesan_id', '=', 'users.id')
                ->join(DB::raw('(select pemesanan.*, paket.nama_paket, paket.penyedia_id,
            users.nama
            from pemesanan INNER JOIN paket on pemesanan.paket_id = paket.id
            INNER JOIN users on paket.penyedia_id = users.id) t'), 't.id', '=', 'pemesanan.id')
                ->where('paket.penyedia_id', Session::get('id'))
                ->select('pemesanan.*', 'paket.nama_paket', 'paket.penyedia_id', 'users.nama as nama_pemesan', 'users.no_hp', 't.nama as nama_penyedia')
                ->get();
        } else {
            $pemesanan = DB::table('pemesanan')
                ->join('paket', 'pemesanan.paket_id', '=', 'paket.id')
                ->join('users', 'pemesanan.pemesan_id', '=', 'users.id')
                ->join(DB::raw('(select pemesanan.*, paket.nama_paket, paket.penyedia_id,
            users.nama
            from pemesanan INNER JOIN paket on pemesanan.paket_id = paket.id
            INNER JOIN users on paket.penyedia_id = users.id) t'), 't.id', '=', 'pemesanan.id')
                ->select('pemesanan.*', 'paket.nama_paket', 'paket.penyedia_id', 'users.nama as nama_pemesan', 'users.no_hp', 't.nama as nama_penyedia')
                ->get();
            return view('pemesanan.data_pemesanan', ['pemesanan' => $pemesanan]);
        }
        return view('pemesanan.data_pemesanan', ['pemesanan' => $pemesanan]);
    }

    public function terimaPesanan($id)
    {
        Pemesanan::where('id', $id)->update([
            'status' => 'Diterima'
        ]);
        return redirect('/pemesanan');
    }

    public function tolakPesanan($id)
    {
        Pemesanan::where('id', $id)->update([
            'status' => 'Ditolak'
        ]);
        return redirect('/pemesanan');
    }

    public function updatePembayaran(Request $request, $id)
    {
        Pemesanan::where('id', $id)->update([
            'pembayaran' => $request->pembayaran,
        ]);
        return redirect('/pemesanan');
    }

    public function dataPembayaran()
    {
        if (Session::get('role') == '2') {
            $pemesanan = DB::table('pemesanan')
            ->join('users', 'users.id', '=', 'pemesanan.pemesan_id')
            ->join('paket', 'paket.id', '=', 'pemesanan.paket_id')
            ->select('pemesanan.id','users.nama', 'paket.nama_paket', 'pemesanan.pembayaran', 'pemesanan.harga_paket')
            ->where('paket.penyedia_id', Session::get('id'))
            ->get();
        return view('pemesanan.pembayaran', compact('pemesanan'));
        }else{
            $pemesanan = DB::table('pemesanan')
            ->join('users', 'users.id', '=', 'pemesanan.pemesan_id')
            ->join('paket', 'paket.id', '=', 'pemesanan.paket_id')
            ->select('pemesanan.id','users.nama', 'paket.nama_paket', 'pemesanan.pembayaran', 'pemesanan.harga_paket')
            ->get();
        return view('pemesanan.pembayaran', compact('pemesanan'));
        }
    }

    public function detailPembayaran($id)
    {
        $pembayaran = DB::table('bukti')
            ->join('pemesanan', 'pemesanan.id' , '=', 'bukti.pemesanan_id')
            ->select('bukti.*', 'pemesanan.pembayaran')
            ->where('pemesanan_id', $id)
            ->get();
        return view('pemesanan.detail_pembayaran', compact('pembayaran'));
    }
}
