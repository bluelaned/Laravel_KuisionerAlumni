<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Test2Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;


// use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('welcome', ['title' => 'Welcome']);
// })->name('welcome');


// REGISTER
Route::get('register', [LoginController::class, 'register'])->name('register_action'); 
Route::post('register_action', [LoginController::class, 'register_action'])->name('register_action');

// LOGIN
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('login_action', [LoginController::class, 'login_action'])->name('login_action');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// ADMIN
Route::middleware(['auth', 'login:admin'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('home', [AdminController::class, 'index'])->name('admin.home');
        Route::get('kuisioner/pertanyaan', [AdminController::class, 'kuisioner_pertanyaan'])->name('admin.kuisioner.pertanyaan');
        Route::post('kuisioner/create_action', [AdminController::class, 'buat_pertanyaan'])->name('admin.kuisioner.create_action');
        Route::get('kuisioner/edit_kuisioner/{id}', [AdminController::class, 'edit_kuisioner'])->name('admin.kuisioner.edit_kuisioner');
        Route::put('kuisioner/update/{id}', [AdminController::class, 'update_kuisioner'])->name('update_kuisioner');

        Route::get('kuisioner/delete/{id}', [AdminController::class, 'hapus_action'])->name('hapus_action');

        Route::get('kuisioner/response', [AdminController::Class, 'kuisioner_response'])->name('admin.kuisioner.response');
    
        Route::get('tracerstudy/response', [AdminController::Class, 'tracer_response'])->name('admin.tracerstudy.response');
        
        Route::get('informasi/berita', [AdminController::Class, 'informasi_berita'])->name('admin.informasi.berita');
        Route::get('informasi/pengumuman', [AdminController::Class, 'informasi_pengumuman'])->name('admin.informasi.pengumuman');
    });
});


// ALUMNI
Route::get('kuisioner', [AlumniController::class, 'home'])->name('alumni.home');
Route::post('kuisioner/submit_user', [AlumniController::class, 'submit_user'])->name('alumni.submit_user');

Route::middleware(['alumnilogin:alumni'])->group(function () {
    Route::get('kuisioner/pertanyaan', [AlumniController::class, 'kuisioner_pertanyaan'])->name('alumni.pertanyaan');
    Route::post('kuisioner/submit_kuisioner', [AlumniController::class, 'submit_kuisioner'])->name('alumni.submit_kuisioner');
});

Route::get('complete', [AlumniController::class, 'complete'])->name('complete');