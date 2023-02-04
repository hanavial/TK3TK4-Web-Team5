<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

// User
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:web')->group( function(){
    Route::get('/barang',[BarangController::class,'index'])->name('user.barang.index');
    Route::get('/barang/show/{id}',[BarangController::class,'show'])->name('user.barang.show');

    Route::get('/transaksi',[TransaksiController::class,'index'])->name('user.transaksi.index');
    Route::get('/transaksi/create/{id}',[TransaksiController::class,'create'])->name('user.transaksi.create');
    Route::post('/transaksi/store',[TransaksiController::class,'store'])->name('user.transaksi.store');
    Route::get('/transaksi/show/{id}',[TransaksiController::class,'show'])->name('user.transaksi.show');
    Route::put('/transaksi/cancel/{id}',[TransaksiController::class,'cancel'])->name('user.transaksi.cancel');
});

// Staff
Route::get('/staff/login',[LoginController::class,'showLoginFormStaff'])->name('staff.login_view');
Route::post('/staff/login',[LoginController::class,'loginStaff'])->name('staff.login');
// Route::get('/staff/register',[RegisterController::class,'showRegisterFormStaff'])->name('staff.register_view');
// Route::post('/staff/register',[RegisterController::class,'createStaff'])->name('staff.register');

Route::get('/staff', [HomeStaffController::class, 'index'])->name('staff.home');

Route::middleware('auth:staff')->group( function(){
    Route::get('/staff/user',[UserController::class,'index'])->name('staff.user.index');
    Route::get('/staff/user/create',[UserController::class,'create'])->name('staff.user.create');
    Route::get('/staff/user/show/{id}',[UserController::class,'show'])->name('staff.user.show');
    Route::post('/staff/user/store',[UserController::class,'store'])->name('staff.user.store');

    Route::get('/staff/barang',[BarangController::class,'index'])->name('staff.barang.index');
    Route::get('/staff/barang/create',[BarangController::class,'create'])->name('staff.barang.create');
    Route::get('/staff/barang/show/{id}',[BarangController::class,'show'])->name('staff.barang.show');
    Route::get('/staff/barang/edit/{id}',[BarangController::class,'edit'])->name('staff.barang.edit');
    Route::post('/staff/barang/store',[BarangController::class,'store'])->name('staff.barang.store');
    Route::put('/staff/barang/update/{id}',[BarangController::class,'update'])->name('staff.barang.update');
    Route::delete('/staff/barang/delete/{id}',[BarangController::class,'destroy'])->name('staff.barang.destroy');

    Route::get('/staff/transaksi',[TransaksiController::class,'index'])->name('staff.transaksi.index');
    Route::get('/staff/transaksi/show/{id}',[TransaksiController::class,'show'])->name('staff.transaksi.show');
    Route::put('/staff/transaksi/confirm/{id}',[TransaksiController::class,'confirm'])->name('staff.transaksi.confirm');
    Route::put('/staff/transaksi/reject/{id}',[TransaksiController::class,'reject'])->name('staff.transaksi.reject');

    Route::get('/staff/laporan',[LaporanController::class,'index'])->name('staff.laporan.index');
    Route::get('/staff/laporan/grafik',[LaporanController::class,'grafik'])->name('staff.laporan.grafik');
});

// Admin
Route::get('/admin/login',[LoginController::class,'showLoginFormAdmin'])->name('admin.login_view');
Route::post('/admin/login',[LoginController::class,'loginAdmin'])->name('admin.login');
// Route::get('/admin/register',[RegisterController::class,'showRegisterFormAdmin'])->name('admin.register_view');
// Route::post('/admin/register',[RegisterController::class,'createAdmin'])->name('admin.register');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');

Route::middleware('auth:admin')->group( function(){
    Route::get('/admin/user',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/admin/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::get('/admin/user/show/{id}',[UserController::class,'show'])->name('admin.user.show');
    Route::get('/admin/user/edit/{id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/admin/user/store',[UserController::class,'store'])->name('admin.user.store');
    Route::put('/admin/user/update/{id}',[UserController::class,'update'])->name('admin.user.update');
    Route::delete('/admin/user/delete/{id}',[UserController::class,'destroy'])->name('admin.user.destroy');

    Route::get('/admin/staff',[StaffController::class,'index'])->name('admin.staff.index');
    Route::get('/admin/staff/create',[StaffController::class,'create'])->name('admin.staff.create');
    Route::get('/admin/staff/show/{id}',[StaffController::class,'show'])->name('admin.staff.show');
    Route::get('/admin/staff/edit/{id}',[StaffController::class,'edit'])->name('admin.staff.edit');
    Route::post('/admin/staff/store',[StaffController::class,'store'])->name('admin.staff.store');
    Route::put('/admin/staff/update/{id}',[StaffController::class,'update'])->name('admin.staff.update');
    Route::delete('/admin/staff/delete/{id}',[StaffController::class,'destroy'])->name('admin.staff.destroy');

    Route::get('/admin/barang',[BarangController::class,'index'])->name('admin.barang.index');
    Route::get('/admin/barang/create',[BarangController::class,'create'])->name('admin.barang.create');
    Route::get('/admin/barang/show/{id}',[BarangController::class,'show'])->name('admin.barang.show');
    Route::get('/admin/barang/edit/{id}',[BarangController::class,'edit'])->name('admin.barang.edit');
    Route::post('/admin/barang/store',[BarangController::class,'store'])->name('admin.barang.store');
    Route::put('/admin/barang/update/{id}',[BarangController::class,'update'])->name('admin.barang.update');
    Route::delete('/admin/barang/delete/{id}',[BarangController::class,'destroy'])->name('admin.barang.destroy');

    Route::get('/admin/transaksi',[TransaksiController::class,'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/show/{id}',[TransaksiController::class,'show'])->name('admin.transaksi.show');

    Route::get('/admin/laporan',[LaporanController::class,'index'])->name('admin.laporan.index');
    Route::get('/admin/laporan/grafik',[LaporanController::class,'grafik'])->name('admin.laporan.grafik');
});

