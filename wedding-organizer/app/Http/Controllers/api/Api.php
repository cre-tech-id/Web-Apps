<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use App\Models\Pemesanan;
use App\Models\Rating;
use App\Models\Komentar;
use App\Models\Bukti;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\str;
use Illuminate\Support\Facades\DB;

class Api extends Controller
{
    public function penyedia()
    {
        $penyedia = DB::table('users')
        ->join(DB::raw('(select rating.penyedia_id, cast(sum(rating.rating)-5 as decimal(10,1))
        as totalrating, count(rating.rating)-1 as totaluser from rating inner join users on
        rating.penyedia_id = users.id GROUP by rating.penyedia_id)as t'),'t.penyedia_id', '=', 'users.id')
        ->join('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
        ->join('indonesia_districts', 'indonesia_districts.id', '=', 'users.kecamatan')
        ->join('indonesia_villages', 'indonesia_villages.id', '=', 'users.desa')
        ->select('users.nama as penyedia', DB::raw('concat(indonesia_cities.name, ", ",indonesia_districts.name, " ",indonesia_villages.name, " ", users.detail_alamat) as alamat'), \DB::raw('SUBSTRING(no_hp, 2, 20) as no'), \DB::raw('case
        when cast(t.totalrating/t.totaluser as decimal(10,2)) > 0 then cast(t.totalrating/t.totaluser as decimal(10,2))
        ELSE
        0
        end as totalrating'), \DB::raw('case
        when t.totalrating/t.totaluser BETWEEN 0 and 0.4 then 0
        when t.totalrating/t.totaluser BETWEEN 0.5 and 0.9 then 0.5
        when t.totalrating/t.totaluser BETWEEN 1 and 1.4 then 1
        when t.totalrating/t.totaluser BETWEEN 1.5 and 1.9 then 1.5
        when t.totalrating/t.totaluser BETWEEN 2 and 2.4 then 2
        when t.totalrating/t.totaluser BETWEEN 2.5 and 2.9 then 2.5
        when t.totalrating/t.totaluser BETWEEN 3 and 3.4 then 3
        when t.totalrating/t.totaluser BETWEEN 3.5 and 3.9 then 3.5
        when t.totalrating/t.totaluser BETWEEN 4 and 4.4 then 4
        when t.totalrating/t.totaluser BETWEEN 4.5 and 5 then 4.5
        when t.totalrating/t.totaluser BETWEEN 5 and 6 then 5
        ELSE
        0
        end as ratingbulat'), 'users.gambar')
        ->where('role_id', '=', '2')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'Fetch all posts',
            'data' => $penyedia
        ]);
    }

    public function register(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'nama' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'alamat' => 'required',
                'no_hp' => 'required',
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'alamat' => $request->alamat,
                'no_hp' => $request->no_hp,
                'role_id' => '3'
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if(!Auth::attempt($request->only(['email', 'password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();
            $detail = DB::table('users')
                        ->select('users.id','users.nama', 'users.is_verify', 'users.email', 'users.no_hp as no', 'users.gambar', 'users.desc', DB::raw('concat(indonesia_cities.name, ", ",indonesia_districts.name, " ",indonesia_villages.name, " ", users.detail_alamat) as alamat') )
                        ->join('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
                        ->join('indonesia_districts', 'indonesia_districts.id', '=', 'users.kecamatan')
                        ->join('indonesia_villages', 'indonesia_villages.id', '=', 'users.desa')
                        ->where('users.email', '=', $request->email)
                        ->get();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken,
                'data' => $detail
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function user($id){
        return response()->json([
            'success' => true,
            'message' => 'fetch single data',
            'data' => [User::find($id)]
        ]);
    }

    public function paket(){
        $paket = DB::table('paket')
        ->join('users', 'users.id', '=', 'paket.penyedia_id')
        ->join(DB::raw('(select rating.penyedia_id, cast(sum(rating.rating)-5 as decimal(10,1))
        as totalrating, count(rating.rating)-1 as totaluser from rating inner join users on
        rating.penyedia_id = users.id GROUP by rating.penyedia_id)as t'),'t.penyedia_id', '=', 'users.id')
        ->join('indonesia_cities', 'indonesia_cities.id', '=', 'users.kota')
        ->join('indonesia_districts', 'indonesia_districts.id', '=', 'users.kecamatan')
        ->join('indonesia_villages', 'indonesia_villages.id', '=', 'users.desa')
        ->select( 'users.gambar as gambaruser', DB::raw('concat(indonesia_cities.name, ", ",indonesia_districts.name, " ",indonesia_villages.name, " ", users.detail_alamat) as alamat'),'t.penyedia_id as penyediaid','paket.id', 'paket.nama_paket as nama', 'users.nama as penyedia', 'paket.detail', 'paket.harga', 'paket.status',
        \DB::raw('SUBSTRING(no_hp, 2, 20) as no'), 'paket.gambar', 'paket.min_dp as dp', \DB::raw('case
        when cast(t.totalrating/t.totaluser as decimal(10,2)) > 0 then cast(t.totalrating/t.totaluser as decimal(10,2))
        ELSE
        0
        end as totalrating'), \DB::raw('case
        when t.totalrating/t.totaluser BETWEEN 0 and 0.4 then 0
        when t.totalrating/t.totaluser BETWEEN 0.5 and 0.9 then 0.5
        when t.totalrating/t.totaluser BETWEEN 1 and 1.4 then 1
        when t.totalrating/t.totaluser BETWEEN 1.5 and 1.9 then 1.5
        when t.totalrating/t.totaluser BETWEEN 2 and 2.4 then 2
        when t.totalrating/t.totaluser BETWEEN 2.5 and 2.9 then 2.5
        when t.totalrating/t.totaluser BETWEEN 3 and 3.4 then 3
        when t.totalrating/t.totaluser BETWEEN 3.5 and 3.9 then 3.5
        when t.totalrating/t.totaluser BETWEEN 4 and 4.4 then 4
        when t.totalrating/t.totaluser BETWEEN 4.5 and 5 then 4.5
        when t.totalrating/t.totaluser BETWEEN 5 and 6 then 5
        ELSE
        0
        end as ratingbulat'))
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'fetch data paket',
            'data' => $paket
        ]);
    }

    public function event(){
        $event = DB::table('event')
        ->join('users', 'users.id', '=', 'event.penyedia_id')
        ->select( 'event.id', 'users.nama as penyedia', 'event.nama_event as event', 'event.tanggal', 'event.lokasi', 'event.deskripsi', 'event.gambar')
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'fetch data event',
            'data' => $event
        ]);
    }

    public function pembayaran(){
        $labels = ['Lunas'];
        $data2 = [];
        foreach ($labels as $label)
        {
            $data2[] = [
                'lunas' => $label,
                'dp' => 'DP'
            ];
        }

        return response()->json([
            'success' => true,
            'message' => 'true',
            'data' => $data2
        ]);
    }

    public function pesanan($id){
        $pesanan = DB::table('pemesanan')
        ->join('paket', 'pemesanan.paket_id', '=', 'paket.id')
        ->join('users', 'pemesanan.pemesan_id', '=', 'users.id')
        ->join(DB::raw('(select pemesanan.*, paket.nama_paket, paket.penyedia_id,
        users.nama
        from pemesanan INNER JOIN paket on pemesanan.paket_id = paket.id
        INNER JOIN users on paket.penyedia_id = users.id) t'), 't.id', '=', 'pemesanan.id')
        ->where('pemesanan.pemesan_id', $id)
        ->select('paket.min_dp as dp','pemesanan.id', 'users.nama as pemesan','users.id as userid', 't.penyedia_id as penyediaid', 'pemesanan.tanggal_book as tanggal',
        'paket.nama_paket as paket', 'paket.id as id_paket', 'pemesanan.lokasi', 't.nama as penyedia', 'pemesanan.status',
        'pemesanan.pembayaran', 'pemesanan.harga_paket', 'pemesanan.selesai')
        ->get();
        if($pesanan->isEmpty()){
            return response()->json([
                'success' => true,
                'message' => 'data pemesanan is empty',
                'data' => $pesanan
          ]);
        }
        else{
            return response()->json([
                'success' => true,
                'message' => 'fetch data pesanan',
                'data' => $pesanan
            ]);
        }

    }

    public function createPesanan(Request $request){
        $validatePesanan = Validator::make($request->all(),
        [
            'pemesan_id' => 'required',
            'paket_id' => 'required',
            'lokasi' => 'required',
            'tanggal_book' => 'required',
        ]);

        if($validatePesanan->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validatePesanan->errors()
            ], 401);
        }

        $pemesanan = Pemesanan::create([
            'pemesan_id' => $request->pemesan_id,
            'paket_id' => $request->paket_id,
            'lokasi' => $request->lokasi,
            'tanggal_book' => $request->tanggal_book,
            'status' => 'Belum dikonfirmasi',
            'harga_paket' => $request->harga_paket,
            'pembayaran' => '0',
            'selesai' => 'Belum selesai',
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Added Successfully',
        ], 200);
    }

    public function updateProfile(Request $request){
        if($request->hasFile('file')){
            $name = 'image'.'-'.time().'.'.$request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('public/upload/profile/',$name);
            $data = $request->data;
            $json_data = json_decode($data, true);

            $id = $json_data['id_user'];
            $nama = $json_data['nama_user'];
            $alamat = $json_data['alamat_user'];
            $no = $json_data['no_user'];

            user::where('id', $id)->update([
                'nama' => $nama,
                'detail_alamat' => $alamat,
                'no_hp' => $no,
                'gambar' => $name,
        ]);
        }else{
            $data = $request->data;
            $json_data = json_decode($data, true);

            $id = $json_data['id_user'];
            $nama = $json_data['nama_user'];
            $alamat = $json_data['alamat_user'];
            $no = $json_data['no_user'];

            user::where('id', $id)->update([
                'nama' => $nama,
                'detail_alamat' => $alamat,
                'no_hp' => $no,
        ]);
        }

        return response()->json([
            'success' => true,
            'message' => $id,
        ], 200);
        }

        public function Rating(Request $request){
            $validatePesanan = Validator::make($request->all(),
            [
                'users_id' => 'required',
                'penyedia_id' => 'required',
                'rating' => 'required',
            ]);

            if($validatePesanan->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatePesanan->errors()
                ], 401);
            }

            Pemesanan::where('id', $request->selesai)->update([
                'selesai' => "Sudah selesai",
            ]);

            $rating = Rating::create([
                'users_id' => $request->users_id,
                'penyedia_id' => $request->penyedia_id,
                'rating' => $request->rating,
                ]);

            return response()->json([
                'status' => true,
                'message' => 'Rating Added Successfully',
            ], 200);
        }

    public function komentar($id){
        $komentar = DB::table('komentar')
        ->join('users', 'users.id', '=', 'komentar.users_id')
        ->select( 'users.nama', 'komentar.paket_id as paket', 'komentar.komentar')
        ->where('komentar.paket_id', $id)
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'fetch data event',
            'data' => $komentar
        ]);
    }

    public function postKomentar(Request $request){
        $validatePesanan = Validator::make($request->all(),
        [
            'users_id' => 'required',
            'penyedia_id' => 'required',
            'paket_id' => 'required',
            'komentar' => 'required',
        ]);

        if($validatePesanan->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validatePesanan->errors()
            ], 401);
        }

        $komentar = Komentar::create([
            'users_id' => $request->users_id,
            'penyedia_id' => $request->penyedia_id,
            'paket_id' => $request->paket_id,
            'komentar' => $request->komentar,
            ]);

        return response()->json([
            'status' => true,
            'message' => 'Data Added Successfully',
        ], 200);
    }

    public function getKota($provinsi){
        $kota = DB::table('indonesia_cities')
        ->where('province_code', DB::raw('(select code from indonesia_provinces where name ="' . $provinsi . '")'))
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'true',
            'data' => $kota
        ]);
    }

    public function getprovinsi(){
        $provinsi = DB::table('indonesia_provinces')->get();
        return response()->json([
            'provinsi' => $provinsi
        ]);
    }

    public function getkecamatan($kota){
        $kecamatan = DB::table('indonesia_districts')
        ->where('city_code', DB::raw('(select code from indonesia_cities where name ="' . $kota . '")'))
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'true',
            'data' => $kecamatan
        ]);
    }

    public function getKelurahan($kecamatan){
        $kelurahan = DB::table('indonesia_villages')
        ->where('district_code', DB::raw('(select code from indonesia_districts where name ="' . $kecamatan . '")'))
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'true',
            'data' => $kelurahan
        ]);
    }

    public function listPembayaran($id){
        $bukti = DB::table('bukti')
        ->select('id','created_at as tanggal', 'nominal')
        ->where('pemesanan_id', $id)
        ->get();
        return response()->json([
            'success' => true,
            'message' => 'true',
            'data' => $bukti
        ]);
    }

    public function uploadBukti(Request $request){
        if($request->hasFile('file')){
            $name = 'image'.'-'.time().'.'.$request->file('file')->getClientOriginalExtension();
            $path = $request->file('file')->storeAs('public/upload/bukti/',$name);
            $data = $request->data;
            $json_data = json_decode($data, true);

            $pemesanan_id = $json_data['pemesanan_id'];
            $nominal = $json_data['nominal'];
            $pembayaran = $json_data['pembayaran'];

            $bukti = Bukti::create([
                'pemesanan_id' => $pemesanan_id,
                'nominal' => $nominal,
                'bukti' => $name,
                ]);

            Pemesanan::where('id', $pemesanan_id)->update([
                'pembayaran' => $pembayaran,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Success add data',
            ], 200);
        }else
            return response()->json([
                'success' => false,
                'message' => 'Add file first',
            ], 200);
        }
    }


