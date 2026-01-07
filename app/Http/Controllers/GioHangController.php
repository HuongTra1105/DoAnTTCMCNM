<?php
namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\Products;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
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
    public function xemGio()
    {
        $nguoiDung = session('user');

        $gioHang = GioHang::where('user_id', $nguoiDung->id)
            ->with('chiTiet.sanPham')
            ->first();

        return view('giohang', compact('gioHang'));
    }
    public function them(Request $request)
    {
    $sanpham = Products::findOrFail($request->id);
    $giohang = session()->get('giohang', []);
    $key = $sanpham->id . '-' . ($request->mau ?? 'none') . '-' . ($request->size ?? 'none');
    if (isset($giohang[$key])) {
        $giohang[$key]['soluong']++;
    } else {
        $giohang[$key] = [
            'id' => $sanpham->id,
            'ten' => $sanpham->Tensanpham,
            'gia' => ($sanpham->gia_giam && $sanpham->gia_giam > 0)
                        ? $sanpham->gia_giam
                        : $sanpham->gia,
            'mau' => $request->mau,
            'size' => $request->size,
            'soluong' => 1,
            'hinh' => $sanpham->mainImage->duong_dan_hinh ?? ''
        ];
    }
    session()->put('giohang', $giohang);
    $tongSoLuong = 0;
    foreach ($giohang as $item) {
    $tongSoLuong += $item['soluong'];
    }
    session()->put('giohang', $giohang);
    return response()->json([
        'success' => true,
        'count' => $tongSoLuong,
        'item' => [
            'key' => $key,
            'ten' => $giohang[$key]['ten'],
            'gia' => $giohang[$key]['gia'],
            'hinh' => $giohang[$key]['hinh'],
            'mau' => $giohang[$key]['mau'],
            'size' => $giohang[$key]['size'],
            'soluong' => $giohang[$key]['soluong']
        ]
    ]);
    }
    public function chitiet()
    {
        $giohang = session('giohang', []);
        return view('giohang.chitietgiohang', compact('giohang'));
    }
    public function capnhat(Request $request)
    {
    $giohang = session('giohang', []);
    $key = $request->key;
    $action = $request->action;
    if (!isset($giohang[$key])) {
        return response()->json(['success' => false]);
    }
    if ($action === 'plus') {
        $giohang[$key]['soluong']++;
    }
    if ($action === 'minus') {
        if ($giohang[$key]['soluong'] > 1) {
            $giohang[$key]['soluong']--;
        } else {
            unset($giohang[$key]);
        }
    }
    session()->put('giohang', $giohang);
    $tong = 0;
    foreach ($giohang as $sp) {
        $tong += $sp['gia'] * $sp['soluong'];
    }
    return response()->json([
        'success' => true,
        'soluong' => $giohang[$key]['soluong'] ?? 0,
        'tong' => number_format($tong)
    ]);
    }
}
