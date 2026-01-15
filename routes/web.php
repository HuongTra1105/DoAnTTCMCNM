<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\NguoiDungController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\ThanhToanController;
use App\Http\Controllers\Admin\QlSanPhamController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\QlDonHangController;


Route::get('auth/google', [NguoiDungController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [NguoiDungController::class, 'handleGoogleCallback']);
Route::get('/dang-nhap', fn () => view('DangKy'))->name('login.form');
Route::get('auth/google', [NguoiDungController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [NguoiDungController::class, 'handleGoogleCallback']);
Route::post('/dang-nhap', [AuthController::class, 'login'])->name('login');
Route::post('/dang-ky-ajax', [AuthController::class, 'registerAjax'])
    ->name('register.ajax');
Route::post('/otp-verify-ajax', [AuthController::class, 'verifyOtpAjax'])
    ->name('otp.verify.ajax');
Route::post('/dang-xuat', [NguoiDungController::class, 'logout'])->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{param}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/tim-kiem', [HomeController::class, 'search'])->name('search');
Route::get('/tai-khoan', [NguoiDungController::class, 'index'])->name('account');
Route::post('/gio-hang/them', [GioHangController::class, 'them'])->name('giohang.them');
Route::get('/gio-hang/chi-tiet', [GioHangController::class, 'chitiet'])->name('giohang.chitiet');
Route::post('/gio-hang/cap-nhat', [GioHangController::class, 'capnhat']);
Route::get('/thanh-toan', [ThanhToanController::class, 'index'])->name('checkout');
Route::post('/thanh-toan', [ThanhToanController::class, 'xuLy'])->name('checkout.submit');
Route::get('/dat-hang-thanh-cong', fn () => view('ThanhCong'))->name('ThanhCong');
Route::prefix('admin')
    ->middleware('admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])
            ->name('admin.home');

        Route::get('/sanpham', [QlSanPhamController::class, 'index'])
            ->name('Admin.SanPham.DsSanPham');

        Route::get('/sanpham/them', [QlSanPhamController::class, 'create'])
            ->name('Admin.SanPham.create');

        Route::post('/sanpham/them', [QlSanPhamController::class, 'store'])
            ->name('Admin.SanPham.store');

        Route::get('/sanpham/sua/{id}', [QlSanPhamController::class, 'edit'])
            ->name('Admin.SanPham.edit');

        Route::post('/sanpham/sua/{id}', [QlSanPhamController::class, 'update'])
            ->name('Admin.SanPham.update');

        Route::post('/sanpham/xoa/{id}', [QlSanPhamController::class, 'destroy'])
            ->name('Admin.SanPham.destroy');
        
         Route::get('/don-hang', [QlDonHangController::class, 'index'])
            ->name('Admin.SanPham.DsDonHang');

        Route::post('/don-hang/duyet/{id}', [QlDonHangController::class, 'duyet'])
            ->name('Admin.SanPham.DuyetDonHang');
});
 