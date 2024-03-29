<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\File;
use App\Models\Paket;
use App\Models\Rating;
use Session;

class PaketController extends Controller
{
    public function dataPaket()
    {
        if(Session::get('role')=='2'){
            $paket = DB::table('paket')->where('penyedia_id', Session::get('id'))->get();
            return view('paket.data_paket',['paket' => $paket]);
        }else{
            $paket = DB::table('paket')->get();
            return view('paket.data_paket',['paket' => $paket]);
        }
        return view('paket.data_paket',['paket' => $paket]);
    }

    public function viewTambahPaket()
    {
        $penyedia = DB::table('users')->where('role_id', '2')->get();
        return view('paket.tambah_paket', ['penyedia' => $penyedia]);
    }

    public function tambahDataPaket(Request $request)
    {
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/paket/',$name);

        $paket = new Paket();
        $paket->nama_paket = $request->input('nama_paket');
        $paket->penyedia_id = $request->input('penyedia_id');
        $paket->detail = $request->input('detail');
        $paket->harga = $request->input('harga');
        $paket->min_dp = $request->input('min_dp');
        $paket->gambar = $name;
        $paket->status = 'Open';
        $paket->save();

        return redirect('/paket');
    }

    public function hapusDataPaket($id){
        Paket::where('id', $id)->delete();
        return redirect('/paket');

    }

    public function editDataPaket($id){
        $penyedia = DB::table('users')->where('role_id', '2')->get();
        $paket = DB::table('paket')
            ->select('paket.*', 'users.id as idUser', 'users.nama')
            ->join('users', 'paket.penyedia_id', '=', 'users.id')
            ->where('paket.id', $id)
            ->get();
        return view('paket.edit_paket', ['paket' => $paket], ['penyedia' => $penyedia]);

    }

    public function postEditPaket(Request $request)
{
    if($request->hasFile('gambar')){
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/paket/',$name);
	    Paket::where('id',$request->id)->update([
            'nama_paket' => $request->nama_paket,
            'detail' => $request->detail,
            'harga' => $request->harga,
            'min_dp' => $request->min_dp,
            'gambar' => $name,
        ]);
	}else{
        Paket::where('id',$request->id)->update([
            'nama_paket' => $request->nama_paket,
            'detail' => $request->detail,
            'harga' => $request->harga,
            'min_dp' => $request->min_dp,
        ]);
    }
	return redirect('/paket');
}

public function updateStatus(Request $request, $id){
    Paket::where('id',$id)->update([
        'status' => $request->status,
    ]);
    return redirect('/paket');
}
}
