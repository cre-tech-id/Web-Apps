<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use Session;

class EventController extends Controller
{
    public function dataEvent()
    {
        if(Session::get('role')=='2'){
        $event = DB::table('event')
            ->join('users', 'event.penyedia_id', '=', 'users.id')
            ->select('event.*', 'users.nama')
            ->where('penyedia_id', Session::get('id'))
            ->get();
            return view('event.data_event',['event' => $event]);
        }else{
            $event = DB::table('event')
            ->join('users', 'event.penyedia_id', '=', 'users.id')
            ->select('event.*', 'users.nama')
            ->get();
            return view('event.data_event',['event' => $event]);
        }
        return view('event.data_event',['event' => $event]);

    }

    public function viewTambahEvent()
    {
        return view('event.tambah_event');
    }

    public function tambahDataEvent(Request $request)
    {   $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/event/',$name);

        $event = new Event();
        $event->penyedia_id = $request->input('penyedia_id');
        $event->nama_event = $request->input('nama_event');
        $event->tanggal = $request->input('tanggal');
        $event->lokasi = $request->input('lokasi');
        $event->deskripsi = $request->input('deskripsi');
        $event->gambar = $name;
        
        $event->save();
        return redirect('/event');
    }

    public function hapusDataEvent($id){
        Event::where('id', $id)->delete();
        return redirect('/event');

    }

    public function editDataEvent($id){
        $event = DB::table('event')
            ->join('users', 'event.penyedia_id', '=', 'users.id')
            ->select('event.*', 'users.nama')
            ->where('event.id', $id)
            ->get();
        return view('event.edit_event',['event' => $event]);
    }

    public function postEditEvent(Request $request)
{
    if($request->hasFile('gambar')){
        $name = 'image'.'-'.time().'.'.$request->file('gambar')->getClientOriginalExtension();
        $path = $request->file('gambar')->storeAs('public/upload/event/',$name);
        Event::where('id',$request->id)->update([
            'penyedia_id' => $request->penyedia_id,
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
            'gambar' => $name,
        ]);
    }else{
        Event::where('id',$request->id)->update([
            'penyedia_id' => $request->penyedia_id,
            'nama_event' => $request->nama_event,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'deskripsi' => $request->deskripsi,
        ]);
    }
	return redirect('/event');
}

}