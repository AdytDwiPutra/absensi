<?php

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MapelController;
use App\Http\Controllers\admin\PendidikController;
use App\Http\Controllers\admin\StaffController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\IclockController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\ProfesiController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\JadwalController;
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

Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

Route::get('/pendidik', [PendidikController::class, 'index'])->name('pendidik');
Route::post('/pendidik/edit', [PendidikController::class, 'store'])->name('pendidik.tambah');
Route::get('pendidik/show/{id}', [PendidikController::class, 'show'])->name('pendidik.show');
Route::get('pendidik/delete/{id}', [PendidikController::class, 'destroy']);
Route::get('pendidik/absen/{id}', [PendidikController::class, 'hadir']);
Route::get('/staff', [StaffController::class, 'index'])->name('staff');
Route::get('/profile/{id}', [PendidikController::class, 'profile'])->name('pendidik.profile');

/**Profesi */
Route::get('/profesi', [ProfesiController::class, 'index'])->name('profesi');
Route::post('/profesi/tambah', [ProfesiController::class, 'store'])->name('profesi.tambah');
Route::post('/profesi/edit/{id}', [ProfesiController::class, 'edit'])->name('profesi.edit');
Route::get('/profesi/delete/{id}', [ProfesiController::class, 'destroy']);

/**Jabatan */
Route::get('/jabatan', [JabatanController::class, 'index'])->name('jabatan');
Route::post('/jabatan/tambah', [JabatanController::class, 'store'])->name('jabatan.tambah');
Route::get('/jabatan/delete/{id}', [JabatanController::class, 'destroy']);

/**Mapel */
Route::get('/mapel', [MapelController::class, 'index'])->name('mapel');
Route::post('/mapel/tambah', [MapelController::class, 'store'])->name('mapel.tambah');
Route::get('/mapel/delete/{id}', [MapelController::class, 'destroy']);

/**Jadwal */
Route::get('/jadwal', [JadwalController::class,'index'])->name('jadwal');

Route::post('/registrasi', [RegistrasiController::class, 'create'])->name('registrasi');

/**Face detection */
Route::get('/absensi', function () {
    return redirect('http://localhost:7000/absensi');
})->name('absensi');

/**Sidik Jari */
Route::get('iclock/cdata',[IclockController::class,'cdataget'])->name('iclock.cdataget');
Route::post('iclock/cdata',[IclockController::class,'cdatapost'])->name('iclock.cdatapost');
Route::get('iclock/getrequest',[IclockController::class,'getrequest'])->name('iclock.getrequest');

Route::get('test', [MapelController::class, 'test'])->name('test');
/**Kehadiran */
Route::get('kehadiran',[KehadiranController::class,'index'])->name('kehadiran.index');
Route::get('hadir_Pegawai/{id}',[KehadiranController::class,'hadirClient'])->name('kehadiran.hadirClient');
Route::get('report_kehadiran',[KehadiranController::class,'report_kehadiran'])->name('kehadiran.report');
Route::post('waktu_tersedia',[KehadiranController::class,'waktu_tersedia'])->name('kehadiran.waktu_tersedia');
