<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Chat;
use Session;
use Illuminate\Support\Facades\DB;
use App\Events\MessageCreated;

class ChatController extends Controller
{

    public function chat($id){
        $user = DB::table('users')
            ->select('*')
            ->where('id', $id)
            ->get();
        $chat = DB::table('chat')
            ->select('users.nama as sender', 'tb.reciever', 'chat.pesan')
            ->join(\DB::raw('(select users.nama as reciever, chat.pesan from chat inner join users on chat.reciever = users.id) as tb'), 'tb.pesan', '=', 'chat.pesan')
            ->join('users', 'users.id', '=', 'chat.sender')
            ->join(\DB::raw('(select id, concat(reciever,sender) helper from chat) as x'), 'x.id', '=', 'chat.id')
            ->where('x.helper', Session::get('id').$id)
            ->orWhere('x.helper', $id.Session::get('id'))
            ->get();
        return view('dashboard.chat.chat',['users' => $user],['chat' => $chat]);
    }

    public function listchat()
    {
        $users = DB::table('users')
        ->select('*')
        ->where('id', Session::get('id'))
        ->get();
        $chat = DB::table('chat')
            ->select('users.nama as sender', 'tb.reciever', 'chat.pesan', 'users.id as sender_id', 'tb.reciever_id')
            ->join('users', 'users.id', '=', 'chat.sender')
            ->join(\DB::raw('(select chat.id, chat.reciever as reciever_id, users.nama as reciever from chat inner join users on chat.reciever = users.id) as tb'), 'tb.id', '=', 'chat.id')
            ->join(\DB::raw('(select max(id)as id from chat GROUP BY chat.sender + chat.reciever) as maks'), 'maks.id', '=', 'chat.id')
            ->where('chat.sender', Session::get('id'))
            ->orWhere('chat.reciever', Session::get('id'))
            ->groupBy(\DB::raw('users.id + tb.reciever_id'))
            ->get();
        return view('dashboard.chat.chat_list',['users' => $users],['chat' => $chat]);
    }

    public function store(Request $request)
    {
        $pesan = request()->pesan;
        $sender = request()->sender;
        $receiver = request()->receiver;
        event(new MessageCreated($pesan,$sender, $receiver ));

        $save = new Chat;
        $save->pesan = $request->pesan;
        $save->sender = $request->sender;
        $save->reciever = $request->receiver;
        $save ->save();

        return redirect('/listchat');
    }

}
