<?php
namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\Products;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    // thêm sản phẩm vào giỏ
    public function themVaoGio(Request $request, $sanPhamId)
    {
        $nguoiDung = session('user');

        if (!$nguoiDung) {
            return redirect('/dang-nhap')->with('error', 'Vui lòng đăng nhập');
        }

        $gioHang = GioHang::firstOrCreate(
            ['user_id' => $nguoiDung->id],
            ['Tongtien' => 0]
        );

        $sanPham = Products::findOrFail($sanPhamId);

        $chiTiet = ChiTietGioHang::where('Macart', $gioHang->id)
            ->where('Masanpham', $sanPhamId)
            ->first();

        if ($chiTiet) {
            $chiTiet->increment('Soluong');
        } else {
            ChiTietGioHang::create([
                'Macart' => $gioHang->id,
                'Masanpham' => $sanPhamId,
                'Gia' => $sanPham->gia,
                'Soluong' => 1
            ]);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    // xem giỏ hàng
    public function xemGio()
    {
        $nguoiDung = session('user');

        $gioHang = GioHang::where('user_id', $nguoiDung->id)
            ->with('chiTiet.sanPham')
            ->first();

        return view('giohang', compact('gioHang'));
    }
}
