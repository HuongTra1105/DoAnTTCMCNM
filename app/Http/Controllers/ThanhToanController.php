<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioHang;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;

class ThanhToanController extends Controller
{
   public function index()
    {
    $giohang = session('giohang', []);
    if (empty($giohang)) {
        return redirect('/')->with('error', 'Giỏ hàng trống');
    }
    $tongTien = 0;
    foreach ($giohang as $item) {
        $tongTien += $item['gia'] * $item['soluong'];
    }
    return view('checkout', compact('giohang', 'tongTien'));
    }
    public function xuLy(Request $request)
    {
    $giohang = session('giohang', []);
    if (empty($giohang)) {
        return back()->with('error', 'Giỏ hàng trống');
    }
    $tongTien = 0;
    foreach ($giohang as $item) {
        $tongTien += $item['gia'] * $item['soluong'];
    }
    $donHang = DonHang::create([
        'Tongtien' => $tongTien,
        'Hoten' => $request->Hoten,
        'Sodienthoai' => $request->Sodienthoai,
        'Diachi' => $request->Diachi,
        'Ghichu' => $request->Ghichu,
        'Trangthai' => 'Cho',
        'TrangThaiTT' => 'unpaid'
    ]);
    foreach ($giohang as $item) {
        ChiTietDonHang::create([
            'Madonhang' => $donHang->id,
            'Masanpham' => $item['id'],
            'Tensanpham' => $item['ten'],
            'Gia' => $item['gia'],
            'Soluong' => $item['soluong']
        ]);
    }
    session()->forget('giohang');
    return redirect()->route('ThanhCong');
    }
}
