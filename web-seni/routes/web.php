<?php

use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SenimanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KesenianController;
use App\Http\Controllers\KaryaController;
use App\Http\Controllers\PemesananKaryaController;
use App\Http\Controllers\PemesananKesenianController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;
use App\Events\MessageCreated;

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

Route::get('/', [BaseController::class, 'index'])->name('index');
Route::get('/home', [BaseController::class, 'index'])->middleware(['auth', 'is_verify_email'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/dologin', [AuthController::class, 'doLogin'])->name('dologin');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/doregister', [AuthController::class, 'doRegister'])->name('doregister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/store-data', [ChatController::class, 'store'])->name('store');

Route::get('/forgot-password', function () {
    return view('auth.forgot');
})->middleware('guest')->name('forgot');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);

})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'is_verify_email'])->name('dashboard');
Route::get('/dashboard/dataadmin', [AdminController::class, 'DataAdmin'])->name('dataadmin');
Route::get('/dashboard/tambahadmin', [AdminController::class, 'TambahAdmin'])->name('tambahadmin');
Route::post('/dashboard/dotambahadmin', [AdminController::class, 'doTambahAdmin'])->name('dotambahadmin');
Route::get('/dashboard/editadmin/{id}/', [AdminController::class, 'EditAdmin'])->name('editadmin');
Route::post('/dashboard/doeditadmin', [AdminController::class, 'doEditAdmin'])->name('doeditadmin');
Route::get('/dashboard/hapusadmin/{id}', [AdminController::class, 'Delete'])->name('hapusadmin');

Route::get('/dashboard/dataseniman', [SenimanController::class, 'DataSeniman'])->name('dataseniman');
Route::get('/dashboard/tambahseniman', [SenimanController::class, 'TambahSeniman'])->name('tambahseniman');
Route::post('/dashboard/dotambahseniman', [SenimanController::class, 'doTambahSeniman'])->name('dotambahseniman');
Route::get('/dashboard/editseniman/{id}/', [SenimanController::class, 'EditSeniman'])->name('editseniman');
Route::post('/dashboard/doeditseniman', [SenimanController::class, 'doEditSeniman'])->name('doeditseniman');
Route::get('/dashboard/hapusseniman/{id}', [SenimanController::class, 'DeleteSeniman'])->name('hapusseniman');

Route::get('/dashboard/datapengguna', [PenggunaController::class, 'DataPengguna'])->name('datapengguna');
Route::get('/dashboard/tambahpengguna', [PenggunaController::class, 'TambahPengguna'])->name('tambahpengguna');
Route::post('/dashboard/dotambahpengguna', [PenggunaController::class, 'doTambahPengguna'])->name('dotambahpengguna');
Route::get('/dashboard/editpengguna/{id}/', [PenggunaController::class, 'EditPengguna'])->name('editpengguna');
Route::post('/dashboard/doeditpengguna', [PenggunaController::class, 'doEditPengguna'])->name('doeditpengguna');
Route::get('/dashboard/hapuspengguna/{id}', [PenggunaController::class, 'DeletePengguna'])->name('hapuspengguna');

Route::get('/dashboard/datakesenian', [KesenianController::class, 'DataKesenian'])->name('datakesenian');
Route::get('/dashboard/tambahkesenian', [KesenianController::class, 'TambahKesenian'])->name('tambahkesenian');
Route::post('/dashboard/dotambahkesenian', [KesenianController::class, 'doTambahKesenian'])->name('dotambahkesenian');
Route::get('/dashboard/editkesenian/{id}/', [KesenianController::class, 'EditKesenian'])->name('editkesenian');
Route::post('/dashboard/doeditkesenian', [KesenianController::class, 'doEditKesenian'])->name('doeditkesenian');
Route::get('/dashboard/hapuskesenian/{id}', [KesenianController::class, 'DeleteKesenian'])->name('hapuskesenian');

Route::get('/dashboard/datakarya', [KaryaController::class, 'DataKarya'])->name('datakarya');
Route::get('/dashboard/tambahkarya', [KaryaController::class, 'TambahKarya'])->name('tambahkarya');
Route::post('/dashboard/dotambahkarya', [KaryaController::class, 'doTambahKarya'])->name('dotambahkarya');
Route::get('/dashboard/editkarya/{id}/', [KaryaController::class, 'EditKarya'])->name('editkarya');
Route::post('/dashboard/doeditkarya', [KaryaController::class, 'doEditKarya'])->name('doeditkarya');
Route::get('/dashboard/hapuskarya/{id}', [KaryaController::class, 'DeleteKarya'])->name('hapuskarya');

Route::get('/dashboard/pemesanankarya', [PemesananKaryaController::class, 'PemesananKarya'])->name('pemesanankarya');
Route::get('/dashboard/tambahpemesanankarya', [PemesananKaryaController::class, 'tambahPesananKarya'])->name('tambahpemesanankarya');
Route::post('/dashboard/pemesanankarya/updateresi', [PemesananKaryaController::class, 'updateResi'])->name('updateresi');

Route::get('/dashboard/pemesanankesenian', [PemesananKesenianController::class, 'PemesananKesenian'])->name('pemesanankesenian');
Route::get('/dashboard/tambahpemesanankesenian', [PemesananKesenianController::class, 'tambahPesananKesenian'])->name('tambahpemesanankesenian');
Route::get('/dashboard/pesankesenian/terima/{id}', [PemesananKesenianController::class, 'terimaPesanan'])->name('terimapesanseni');
Route::get('/dashboard/pesankesenian/tolak/{id}', [PemesananKesenianController::class, 'tolakPesanan'])->name('tolakpesanseni');
Route::post('/dashboard/kesenian/updatepembayaranseni/{id}', [PemesananKesenianController::class, 'updatePembayaran'])->name('updatebayarseni');

Route::get('/listchat', [BaseController::class, 'chatList'])->name('listchat');
Route::get('/chat/{id}', [BaseController::class, 'chat'])->name('chat');

Route::get('/send', function () {
    event(new MessageCreated('$pesan', '$from', '$to'));
});

Route::get('/dashboard/chatlist', [ChatController::class, 'listchat'])->name('seniman.listchat');
Route::get('/dashboard/chat/{id}', [ChatController::class, 'Chat'])->name('seniman.chat');

Route::get('/kesenian', [BaseController::class, 'kesenian'])->name('kesenian');
Route::get('/sewamusik', [BaseController::class, 'sewaMusik'])->name('sewamusik');
Route::get('/sewatari', [BaseController::class, 'sewaTari'])->name('sewatari');
Route::get('/sewasastra', [BaseController::class, 'sewaSastra'])->name('sewasastra');
Route::get('/sewateater', [BaseController::class, 'sewaTeater'])->name('sewateater');
Route::get('/pesanankesenian', [BaseController::class, 'dataPesananKesenian'])->name('pesanankesenian');
Route::get('/detailkesenian/{id}', [BaseController::class, 'DetailKesenian'])->name('detailkesenian');

Route::get('/karya', [BaseController::class, 'karya'])->name('karya');
Route::get('/musik', [BaseController::class, 'musik'])->name('musik');
Route::get('/rupa', [BaseController::class, 'rupa'])->name('rupa');
Route::get('/sastra', [BaseController::class, 'sastra'])->name('sastra');
Route::get('/pesanankarya', [BaseController::class, 'dataPesananKarya'])->name('pesanankarya');
Route::get('/detailkarya/{id}', [BaseController::class, 'DetailKarya'])->name('detailkarya');
Route::get('/payment', [PemesananKaryaController::class, 'payment'])->name('payment');
Route::post('/bayar', [PemesananKaryaController::class, 'bayar'])->name('bayar');

Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::get('/editprofile/{id}', [ProfileController::class, 'editProfile'])->name('editprofile');
Route::post('/doeditprofile', [ProfileController::class, 'doEditProfile'])->name('doeditprofile');

Route::get('/userprofile', [ProfileController::class, 'userProfile'])->name('userprofile');
Route::get('/edituserprofile/{id}', [ProfileController::class, 'editUserProfile'])->name('edituserprofile');
Route::post('/doedituserprofile', [ProfileController::class, 'doEditUserProfile'])->name('doedituserprofile');

Route::get('/kesenianjs/{id}', [BaseController::class, 'kesenian_jsn'])->name('kesenianjs');
Route::get('/karyajs/{id}', [BaseController::class, 'karya_jsn'])->name('karyajs');

Route::get('account/verify/{token}', [AuthController::class, 'verifyAccount'])->name('user.verify');

// Route::post('/pesanankesenian', [BaseController::class, 'pesanankesenian']);
Route::get('/invoice/{id}', [PemesananKaryaController::class, 'invoice']);