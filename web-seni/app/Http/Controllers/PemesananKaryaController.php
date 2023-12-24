<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PemesananKarya;
use App\Models\Karya;
use Illuminate\Support\Facades\DB;
use Session;

class PemesananKaryaController extends Controller
{
    public function PemesananKarya()
    {
        if (Session::get('role') == '2') {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $p_karya = DB::table('users')
                ->select(
                    'pemesanan_karya.id',
                    'users.nama as nama_pemesan',
                    'tb.nama_karya',
                    'tb.nama_penyedia',
                    'pemesanan_karya.jumlah',
                    'pemesanan_karya.alamat',
                    'pemesanan_karya.tanggal_pemesanan',
                    'pemesanan_karya.status',
                    'pemesanan_karya.pembayaran',
                    'pemesanan_karya.resi'
                )
                ->join('pemesanan_karya', 'pemesanan_karya.pemesan_id', '=', 'users.id')
                ->join(\DB::raw('(select karya.id, karya.nama_karya, karya.id_seniman, users.nama as nama_penyedia from karya inner
                join users on karya.id_seniman = users.id)as tb'), 'tb.id', '=', 'pemesanan_karya.karya_id')
                ->where('tb.id_seniman', Session::get('id'))
                ->get();
            return view('dashboard.pemesanan_karya.data_pemesanan_karya', ['p_karya' => $p_karya], ['users' => $users]);
        } else {
            $users = DB::table('users')
                ->select('*')
                ->where('id', Session::get('id'))
                ->get();
            $p_karya = DB::table('users')
                ->select(
                    'pemesanan_karya.id',
                    'users.nama as nama_pemesan',
                    'tb.nama_karya',
                    'tb.nama_seniman',
                    'pemesanan_karya.jumlah',
                    'pemesanan_karya.alamat',
                    'pemesanan_karya.tanggal_pemesanan',
                    'pemesanan_karya.status',
                    'pemesanan_karya.pembayaran',
                    'pemesanan_karya.resi'
                )
                ->join('pemesanan_karya', 'pemesanan_karya.pemesan_id', '=', 'users.id')
                ->join(\DB::raw('(select karya.id, karya.nama_karya, karya.id_seniman, users.nama as nama_seniman from karya inner
                join users on karya.id_seniman = users.id) as tb'), 'tb.id', '=', 'pemesanan_karya.karya_id')
                ->get();
            return view('dashboard.pemesanan_karya.data_pemesanan_karya', ['p_karya' => $p_karya], ['users' => $users]);
        }
        return view('dashboard.pemesanan_karya.data_pemesanan_karya', ['p_karya' => $p_karya], ['users' => $users]);
    }

    public function tambahPesananKarya(Request $request)
    {
        $karya = new PemesananKarya();
        $karya->pemesan_id = $request->input('pemesan_id');
        $karya->karya_id = $request->input('karya_id');
        $karya->jumlah = $request->input('jumlah');
        $karya->alamat = $request->input('alamat');
        $karya->tanggal_pemesanan = date('d-m-Y');
        $karya->total_harga = $request->input('jumlah') * $request->input('harga');
        $karya->status = "-";
        $karya->resi = "-";
        $karya->pembayaran = "Belum Bayar";
        $karya->save();

        Karya::where('id', $request->id)->update([
            'stok' => $request->stok - $request->jumlah,
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $order = $karya->id;
        $params = [
            'transaction_details' => [
                'order_id' => $karya->id,
                'gross_amount' => $karya->total_harga,
            ],
            'customer_details' => array(
                'first_name' => $karya->pemesan_id,
                'last_name' => '',
                // 'phone' => $request->phone,
            ),
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($snapToken);
        session()->flash('success', 'Pesanan sukses dibuat!!!');
        return view('base.payment', compact('snapToken', 'order'));

    }


    public function payment()
    {
        redirect('/payment');
    }

    public function bayar(Request $request)
    {
        PemesananKarya::where('id', $request->id)->update([
            'pembayaran' => $request->pembayaran
        ]);
        return redirect('/pesanankarya');

    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                PemesananKarya::where('id', $request->order_id)->update([
                    'pembayaran' => 'Berhasil',
                ]);
            }
        }
    }

    public function invoice($id)
    {
        $karya = DB::table('karya')
            ->select('pemesanan_karya.id as id_pesanan_karya','karya.id', 'karya.stok', 'pemesanan_karya.pemesan_id', 'karya.nama_karya', 'karya.deskripsi', 'karya.harga', 'pemesanan_karya.jumlah', 'pemesanan_karya.total_harga', 'pemesanan_karya.pembayaran', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->join('pemesanan_karya', 'pemesanan_karya.karya_id', '=', 'karya.id')
            ->where('pemesanan_karya.id', $id)
            ->get();
        return view('base.invoice', ['karya' => $karya]);
    }

    public function updateResi(Request $request)
    {
        PemesananKarya::where('id', $request->id)->update([
            'resi' => $request->resi,
        ]);
        return redirect('dashboard/pemesanankarya');
    }
}