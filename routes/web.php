<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\ThanhToanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/dang-ky', function () {
    return view('DangKy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{param}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('/otp', [AuthController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify');
Route::post('/dang-ky', [AuthController::class, 'register'])->name('register');
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::get('/dang-nhap', function () {return view('DangKy'); })->name('login.form');
Route::post('/dang-xuat', [NguoiDungController::class, 'logout'])->name('logout');
Route::get('/tai-khoan', [NguoiDungController::class, 'index'])->name('account');
Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('checkout');
Route::post('/thanh-toan', [ThanhToanController::class, 'xuLy'])->name('checkout.submit');
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('giohang.them');
Route::get('/gio-hang/chi-tiet', [GioHangController::class, 'chitiet'])
    ->name('giohang.chitiet');
Route::post('/gio-hang/cap-nhat', [GioHangController::class, 'capnhat']);
Route::get('/dat-hang-thanh-cong', function () {
    return view('ThanhCong');
})->name('ThanhCong');
