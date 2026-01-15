<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Exception;

class NguoiDungController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/dang-nhap');
        }
        return view('nguoidung.index', ['user' => session('user')]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['user', 'otp_user_id']);
        return redirect('/')->with('success', 'Đã đăng xuất');
    }

    // Chuyển hướng sang Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý dữ liệu trả về từ Google
    public function handleGoogleCallback()
{
    try {
        $googleUser = Socialite::driver('google')->user();
        
        $user = NguoiDung::updateOrCreate(
            ['Email' => $googleUser->getEmail()],
            [
                'Ten' => $googleUser->getName(),
                'MatKhau' => bcrypt(Str::random(16)),
                'Vaitro' => 'user',
                'TrangThai' => 1
            ]
        );

        session(['user' => $user]);
        return redirect('/')->with('success', 'Đăng nhập thành công!');
    } catch (Exception $e) {
        return redirect('/dang-nhap')->with('error', 'Lỗi: ' . $e->getMessage());
    }
}

    public function login(Request $request)
    {
        $user = NguoiDung::where('Email', $request->email)->first();

        if ($user && (Hash::check($request->MatKhau, $user->MatKhau) || $request->MatKhau == $user->MatKhau)) {
            session(['user' => $user]);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->back()->with('error', 'Email hoặc mật khẩu không đúng');
    }
}