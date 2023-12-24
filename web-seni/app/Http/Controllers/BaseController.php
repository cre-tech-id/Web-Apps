<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kesenian;
use App\Models\Karya;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageCreated;
use Session;

class BaseController extends Controller
{
    public function index()
    {

        return view('base.index');
    }

    public function kesenian()
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', \DB::raw('(CASE
            WHEN length(kesenian.nama_kesenian) > "25" THEN concat(substr(kesenian.nama_kesenian, 1, 25), "...")
            ELSE kesenian.nama_kesenian
            END) AS nama_kesenian'), 'kesenian.deskripsi', 'kesenian.kategori', 'kesenian.harga', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->get();
        return view('base.kesenian', ['kesenian' => $kesenian]);
    }

    public function kesenian_jsn($id)
    {
        $kesenian = Kesenian::find($id);
        return response()->json($kesenian);
    }

    public function karya_jsn($id)
    {
        $karya = karya::find($id);
        return response()->json($karya);
    }

    public function DetailKesenian($id)
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', 'kesenian.nama_kesenian', 'kesenian.deskripsi', 'kesenian.harga', 'users.id as seniman_id', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kesenian.id', $id)
            ->get();
        return view('base.detail_kesenian', ['kesenian' => $kesenian]);
    }

    public function karya()
    {
        $karya = DB::table('karya')
            ->select('karya.id', 'karya.nama_karya', 'karya.deskripsi', 'karya.kategori', 'karya.harga', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->get();
        return view('base.karya', ['karya' => $karya]);
    }

    public function DetailKarya($id)
    {
        $karya = DB::table('karya')
            ->select('karya.id', 'karya.stok', 'karya.nama_karya', 'karya.deskripsi', 'users.nama', 'users.id as seniman_id', 'karya.harga', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->where('karya.id', $id)
            ->get();
        return view('base.detail_karya', ['karya' => $karya]);
    }

    public function dataPesananKarya()
    {
        $karya = DB::table('pemesanan_karya')
            ->select(
                'pemesanan_karya.id',
                'karya.stok',
                'users.nama',
                'karya.nama_karya',
                'pemesanan_karya.jumlah',
                'karya.harga',
                \DB::raw('(pemesanan_karya.jumlah*karya.harga) as total_pesanan'),
                'pemesanan_karya.alamat',
                'pemesanan_karya.tanggal_pemesanan',
                'pemesanan_karya.status',
                'pemesanan_karya.pembayaran',
                'pemesanan_karya.resi'
            )
            ->join('users', 'pemesanan_karya.pemesan_id', '=', 'users.id')
            ->join('karya', 'pemesanan_karya.karya_id', '=', 'karya.id')
            ->where('pemesanan_karya.pemesan_id', Session::get('id'))
            ->orderBy('pemesanan_karya.id','DESC')
            ->get();
        return view('base.pesanan_karya', ['karya' => $karya]);
    }

    public function dataPesananKesenian()
    {
        $kesenian = DB::table('pemesanan_kesenian')
            ->select('users.nama', 'kesenian.nama_kesenian', 'pemesanan_kesenian.lokasi', 'pemesanan_kesenian.tanggal_book', 'pemesanan_kesenian.status', 'pemesanan_kesenian.pembayaran')
            ->join('users', 'pemesanan_kesenian.pemesan_id', '=', 'users.id')
            ->join('kesenian', 'pemesanan_kesenian.kesenian_id', '=', 'kesenian.id')
            ->where('pemesanan_kesenian.pemesan_id', Session::get('id'))
            ->get();
        return view('base.pesanan_kesenian', ['kesenian' => $kesenian]);
    }

    public function chatList(){
        $chat = DB::table('chat')
            ->select('users.nama as sender', 'tb.reciever', 'chat.pesan', 'users.id as sender_id', 'tb.reciever_id')
            ->join('users', 'users.id', '=', 'chat.sender')
            ->join(\DB::raw('(select chat.id, chat.reciever as reciever_id, users.nama as reciever from chat inner join users on chat.reciever = users.id) as tb'), 'tb.id', '=', 'chat.id')
            ->join(\DB::raw('(select max(id)as id from chat group by concat((chat.sender + chat.reciever),(chat.sender * chat.reciever))) as maks'), 'maks.id', '=', 'chat.id')
            ->where('chat.sender', Session::get('id'))
            ->orWhere('chat.reciever', Session::get('id'))
            ->groupBy(\DB::raw('concat((users.id + tb.reciever_id),(users.id * tb.reciever_id))'))
            ->get();
        return view('base.chat_list',['chat' => $chat]);
    }

    public function chat($id)
    {
        $user = DB::table('users')
            ->select('*')
            ->where('id', $id)
            ->get();
        $chat = DB::table('chat')
            ->select('users.nama as sender', 'tb.reciever', 'chat.pesan')
            ->join(\DB::raw('(select users.nama as reciever, chat.pesan from chat inner join users on chat.reciever = users.id) as tb'), 'tb.pesan', '=', 'chat.pesan')
            ->join('users', 'users.id', '=', 'chat.sender')
            ->join(\DB::raw('(select id, concat(reciever,sender) helper from chat) as x'), 'x.id', '=', 'chat.id')
            ->where('x.helper', Session::get('id') . $id)
            ->orWhere('x.helper', $id . Session::get('id'))
            ->get();
        return view('base.chat', ['user' => $user], ['chat' => $chat]);
    }


    // per kategori pembelian

    public function rupa()
    {
        $karya = DB::table('karya')
            ->select('karya.id', 'karya.nama_karya', 'karya.deskripsi', 'karya.kategori', 'karya.harga', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'rupa')
            ->get();
        return view('base.karya', ['karya' => $karya]);
    }
    public function musik()
    {
        $karya = DB::table('karya')
            ->select('karya.id', 'karya.nama_karya', 'karya.deskripsi', 'karya.kategori', 'karya.harga', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'musik')
            ->get();
        return view('base.karya', ['karya' => $karya]);
    }
    public function sastra()
    {
        $karya = DB::table('karya')
            ->select('karya.id', 'karya.nama_karya', 'karya.deskripsi', 'karya.kategori', 'karya.harga', 'karya.foto', 'users.nama')
            ->join('users', 'karya.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'sastra')
            ->get();
        return view('base.karya', ['karya' => $karya]);
    }

    // kategori penyewaan 

    public function sewaMusik()
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', \DB::raw('(CASE
            WHEN length(kesenian.nama_kesenian) > "25" THEN concat(substr(kesenian.nama_kesenian, 1, 25), "...")
            ELSE kesenian.nama_kesenian
            END) AS nama_kesenian'), 'kesenian.deskripsi', 'kesenian.kategori', 'kesenian.harga', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'musik')
            ->get();
        return view('base.kesenian', ['kesenian' => $kesenian]);
    }

    public function sewaSastra()
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', \DB::raw('(CASE
            WHEN length(kesenian.nama_kesenian) > "25" THEN concat(substr(kesenian.nama_kesenian, 1, 25), "...")
            ELSE kesenian.nama_kesenian
            END) AS nama_kesenian'), 'kesenian.deskripsi', 'kesenian.kategori', 'kesenian.harga', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'sastra')
            ->get();
        return view('base.kesenian', ['kesenian' => $kesenian]);
    }
    public function sewaTari()
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', \DB::raw('(CASE
            WHEN length(kesenian.nama_kesenian) > "25" THEN concat(substr(kesenian.nama_kesenian, 1, 25), "...")
            ELSE kesenian.nama_kesenian
            END) AS nama_kesenian'), 'kesenian.deskripsi', 'kesenian.kategori', 'kesenian.harga', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'tari')
            ->get();
        return view('base.kesenian', ['kesenian' => $kesenian]);
    }
    public function sewaTeater()
    {
        $kesenian = DB::table('kesenian')
            ->select('kesenian.id', \DB::raw('(CASE
            WHEN length(kesenian.nama_kesenian) > "25" THEN concat(substr(kesenian.nama_kesenian, 1, 25), "...")
            ELSE kesenian.nama_kesenian
            END) AS nama_kesenian'), 'kesenian.deskripsi', 'kesenian.kategori', 'kesenian.harga', 'kesenian.foto', 'users.nama')
            ->join('users', 'kesenian.id_seniman', '=', 'users.id')
            ->where('kategori', '=', 'teater')
            ->get();
        return view('base.kesenian', ['kesenian' => $kesenian]);
    }

}