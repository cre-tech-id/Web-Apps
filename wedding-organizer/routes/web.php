<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\Paket;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function (Request $request) {
        if (auth()->user()->role_id == '1') {
            session()->regenerate();
            $value = $request->session()->get('role', auth()->user()->role_id);
            $role = '1';
            $admin = User::where('role_id', '1')->count();
            $penyedia = User::where('role_id', '2')->count();
            $user = User::where('role_id', '3')->count();
            $paket = DB::table('paket')->count();
            return view('dashboard_user_type/dashboard_admin', compact('admin', 'penyedia', 'user', 'paket', 'role', 'value'));
        } else {
            session()->regenerate();
            $role = '2';
            $event = Event::where('penyedia_id', Session::get('id'))->count();
            $pemesanan = DB::table('pemesanan')
            ->join('paket', 'pemesanan.paket_id', '=', 'paket.id')
            ->join('users', 'pemesanan.pemesan_id', '=', 'users.id')
            ->join(DB::raw('(select pemesanan.*, paket.nama_paket, paket.penyedia_id,
                    users.nama
                    from pemesanan INNER JOIN paket on pemesanan.paket_id = paket.id
                    INNER JOIN users on paket.penyedia_id = users.id) t'), 't.id', '=', 'pemesanan.id')
            ->where('paket.penyedia_id', Session::get('id'))
            ->select('pemesanan.*', 'paket.nama_paket', 'paket.penyedia_id', 'users.nama as nama_pemesan', 'users.no_hp', 't.nama as nama_penyedia')
            ->count();
            $paket = Paket::where('penyedia_id', Session::get('id'))->count();
            return view('dashboard_user_type/dashboard_penyedia', compact('pemesanan', 'event', 'paket', 'role'));
        }
    })->middleware(['auth', 'is_verify'])->name('dashboard');

    Route::get('/penyedia', [PenyediaController::class, 'dataPenyedia'])->name('penyedia');
    Route::get('/penyedia/tambah', [PenyediaController::class, 'viewTambahPenyedia'])->name('tambah_penyedia');
    Route::post('/penyedia/tambah', [PenyediaController::class, 'tambahDataPenyedia'])->name('post_penyedia');
    Route::get('/penyedia/hapus/{id}', [PenyediaController::class, 'hapusDataPenyedia'])->name('hapus_penyedia');
    Route::get('/penyedia/edit/{id}/', [PenyediaController::class, 'editDataPenyedia'])->name('edit_penyedia');
    Route::post('/penyedia/edit', [PenyediaController::class, 'postEditPenyedia'])->name('post_edit_penyedia');
    Route::get('/penyedia/terima/{id}', [PenyediaController::class, 'terimaPenyedia'])->name('terima_penyedia');
    Route::get('/penyedia/tolak/{id}', [PenyediaController::class, 'tolakPenyedia'])->name('tolak_penyedia');

    Route::get('/admin', [AdminController::class, 'dataAdmin'])->name('admin');
    Route::get('/admin/tambah', [AdminController::class, 'viewTambahAdmin'])->name('tambah_admin');
    Route::post('/admin/tambah', [AdminController::class, 'tambahDataAdmin'])->name('post_admin');
    Route::get('/admin/hapus/{id}', [AdminController::class, 'hapusDataAdmin'])->name('hapus_admin');
    Route::get('/admin/edit/{id}/', [AdminController::class, 'editDataAdmin'])->name('edit_admin');
    Route::post('/admin/edit', [AdminController::class, 'postEditAdmin'])->name('post_edit_admin');

    Route::get('/user', [UserController::class, 'dataUser'])->name('user');
    Route::get('/user/tambah', [UserController::class, 'viewTambahUser'])->name('tambah_user');
    Route::post('/user/tambah', [UserController::class, 'tambahDataUser'])->name('post_user');
    Route::get('/user/hapus/{id}', [UserController::class, 'hapusDataUser'])->name('hapus_user');
    Route::get('/user/edit/{id}/', [UserController::class, 'editDataUser'])->name('edit_user');
    Route::post('/user/edit', [UserController::class, 'postEditUser'])->name('post_edit_user');

    Route::get('/paket', [PaketController::class, 'dataPaket'])->name('paket');
    Route::get('/paket/tambah', [PaketController::class, 'viewTambahPaket'])->name('tambah_paket');
    Route::post('/paket/tambah', [PaketController::class, 'tambahDataPaket'])->name('post_paket');
    Route::get('/paket/hapus/{id}', [PaketController::class, 'hapusDataPaket'])->name('hapus_paket');
    Route::get('/paket/edit/{id}/', [PaketController::class, 'editDataPaket'])->name('edit_paket');
    Route::post('/paket/edit', [PaketController::class, 'postEditPaket'])->name('post_edit_paket');
    Route::post('/paket/status/{id}', [PaketController::class, 'updateStatus'])->name('update_status');

    Route::get('/pemesanan', [PemesananController::class, 'dataPemesanan'])->name('pemesanan');
    Route::get('/pemesanan/terima/{id}', [PemesananController::class, 'terimaPesanan'])->name('terima_pesanan');
    Route::get('/pemesanan/tolak/{id}', [PemesananController::class, 'tolakPesanan'])->name('tolak_pesanan');
    Route::post('/pemesanan/pembayaran/{id}', [PemesananController::class, 'updatePembayaran'])->name('update_pembayaran');

    Route::get('/pembayaran', [PemesananController::class, 'dataPembayaran'])->name('pembayaran');
    Route::get('/pembayaran/detailpembayaran/{id}', [PemesananController::class, 'detailPembayaran'])->name('detail_pembayaran');

    Route::get('/event', [EventController::class, 'dataEvent'])->name('event');
    Route::get('/event/tambah', [EventController::class, 'viewTambahEvent'])->name('tambah_event');
    Route::post('/event/tambah', [EventController::class, 'tambahDataEvent'])->name('post_event');
    Route::get('/event/hapus/{id}', [EventController::class, 'hapusDataEvent'])->name('hapus_event');
    Route::get('/event/edit/{id}/', [EventController::class, 'editDataEvent'])->name('edit_event');
    Route::post('/event/edit', [EventController::class, 'postEditEvent'])->name('post_edit_event');

    Route::get('/komentar', [KomentarController::class, 'komentar'])->name('komentar');
    Route::get('/komentar/hapus/{id}', [KomentarController::class, 'hapusKomentar'])->name('hapus_komentar');


    Route::get('static-sign-in', function () {
        return view('static-sign-in');
    })->name('sign-in');

    Route::get('static-sign-up', function () {
        return view('static-sign-up');
    })->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
    Route::get('/user-profile', [InfoUserController::class, 'create']);
    Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
        return redirect()->route('dashboard');
    })->name('sign-up');
});


Route::group(['middleware' => 'guest'], function () {
    Route::get('getkecamatan', [RegisterController::class, 'getKecamatan'])->name('get.kecamatan');
    Route::get('getdesa', [RegisterController::class, 'getDesa'])->name('get.desa');
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/registeruser', [RegisterController::class, 'userRegister']);
    Route::post('/doregisteruser', [RegisterController::class, 'doUserRegister']);
    Route::get('/register-succes/', [RegisterController::class, 'registeredUser'])->name('registereduser');
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
    Route::get('/login/forgot-password', [ResetController::class, 'create']);
    Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
    Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
    Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
