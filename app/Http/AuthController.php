<?php

namespace App\Http\Controllers;

use App\Models\NguoiDung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showOtpForm()
    {
        return view('otp');
    }
    public function register(Request $request)
    {
    $request->validate([
        'Ten' => 'required',
        'email' => 'required|email|unique:nguoidung,email',
        'MatKhau' => 'required|min:6'
    ]);

    $otp = rand(100000, 999999);

    $user = NguoiDung::create([
        'Manguoidung' => uniqid('ND'),
        'Ten' => $request->Ten,
        'email' => $request->email,
        'MatKhau' => Hash::make($request->MatKhau),
        'Vaitro' => 'user',
        'TrangThai' => 0, 
        'otp' => $otp,
        'otp_expires_at' => now()->addMinutes(5)
    ]);
    Mail::to($user->email)->send(new OtpMail($otp));
    session(['otp_user_id' => $user->id]);
    return redirect()->route('otp.form')
    ->with('success', 'Vui lòng kiểm tra email để nhập OTP');
    }

    public function verifyOtp(Request $request)
    {
    $request->validate([
        'otp' => 'required'
    ]);

    $user = NguoiDung::find(session('otp_user_id'));

    if (!$user) {
        return redirect('/dang-ky')->with('error', 'Phiên xác thực hết hạn');
    }

    if ($user->otp !== $request->otp) {
        return back()->with('error', 'OTP không đúng');
    }

    if (now()->gt($user->otp_expires_at)) {
        return back()->with('error', 'OTP đã hết hạn');
    }

    $user->update([
        'otp' => null,
        'otp_expires_at' => null,
        'email_verified_at' => now(),
        'TrangThai' => 1
    ]);

    session()->forget('otp_user_id');

    return redirect('/dang-nhap')
        ->with('success', 'Xác thực thành công, vui lòng đăng nhập');
    }
    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'MatKhau' => 'required'
    ]);

    $user = NguoiDung::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->MatKhau, $user->MatKhau)) {
        return back()->with('error', 'Sai email hoặc mật khẩu');
    }

    if ($user->TrangThai == 0) {
        session(['otp_user_id' => $user->id]);
        return redirect()->route('otp.form')
            ->with('error', 'Tài khoản chưa xác thực OTP');
    }

    session(['user' => $user]);
    return redirect('/')->with('success', 'Đăng nhập thành công');
    }
}
