<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Komentar;
use Session;

class KomentarController extends Controller
{
    public function komentar()
    {

        $komentar = DB::table('komentar')
        ->join('users', 'komentar.users_id', '=', 'users.id')
        ->join('paket', 'komentar.paket_id', '=', 'paket.id')
        ->join(DB::raw('(select users.nama as nama_penyedia,komentar.paket_id, komentar.penyedia_id, komentar.komentar from users inner join komentar on komentar.penyedia_id = users.id inner join paket on komentar.paket_id = paket.id) as penyedia'), 'komentar.komentar', '=', 'penyedia.komentar')
        ->select('komentar.id', 'users.nama as nama_user', 'penyedia.nama_penyedia', 'paket.nama_paket','komentar.komentar')
        ->get();

        return view('komentar.komentar',['komentar' => $komentar]);
    }

    public function hapusKomentar($id){
        Komentar::where('id', $id)->delete();
        return redirect('/komentar');

    }

}
