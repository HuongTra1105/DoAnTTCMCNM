<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NguoiDung;

class NguoiDungController extends Controller
{
    public function index()
    {
        if (!session()->has('user')) {
            return redirect('/auth');
        }
        return view('nguoidung.index', [
            'user' => session('user')
        ]);
    }
    public function logout(Request $request)
    {
        $request->session()->forget('user');
        $request->session()->forget('otp_user_id');
        return redirect('/')->with('success', 'Đã đăng xuất');
    }
}
