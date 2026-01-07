@extends('layouts.Meomeo')

@section('content')
<div class="container" style="max-width:700px">
<h3>Thanh toán</h3>
<h4>Thông tin đơn hàng</h4>
<ul>
@foreach($giohang as $item)
    <li>
        {{ $item['ten'] }}
        × {{ $item['soluong'] }}
        — {{ number_format($item['gia'] * $item['soluong']) }}đ
    </li>
@endforeach
</ul>
<p><b>Tổng tiền:</b> {{ number_format($tongTien) }}đ</p>
<hr>
<form method="POST" action="{{ route('checkout.submit') }}">
@csrf
<label>Họ tên</label>
<input type="text" name="Hoten"
       value="{{ session('user')->Ten ?? '' }}"
       required>
<label>Số điện thoại</label>
<input type="text" name="Sodienthoai" required>
<label>Địa chỉ</label>
<textarea name="Diachi" required></textarea>
<label>Ghi chú</label>
<textarea name="Ghichu"></textarea>
<hr>
<h4>Phương thức thanh toán</h4>
<label>
    <input type="radio" checked>   Thanh toán khi nhận hàng (COD)
</label>
<label style="color:#888">
    <input type="radio" disabled>  Thanh toán online (chức năng đang hoàn thiện)
</label>
<button class="btn">Xác nhận đặt hàng</button>
</form>
</div>
@endsection
