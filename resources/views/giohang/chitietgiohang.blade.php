@extends('layouts.Meomeo')
@section('content')
<div class="cart-page">
    <h1 class="cart-title">Tất cả sản phẩm</h1>
    @if(empty($giohang))
        <p class="cart-empty">Giỏ hàng trống 🛒</p>
    @else
        @php $tong = 0; @endphp
        <div class="cart-wrapper">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Màu</th>
                        <th>Size</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tạm tính</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($giohang as $key => $sp)
                @php
                    $tam = $sp['gia'] * $sp['soluong'];
                    $tong += $tam;
                @endphp
                <tr class="cart-item" data-key="{{ $key }}">
                    <td class="cart-product">
                        <img src="{{ $sp['hinh'] }}">
                        <div>
                            <p class="cart-name">{{ $sp['ten'] }}</p>
                            <small>{{ $sp['mau'] ?? '-' }} / {{ $sp['size'] ?? '-' }}</small>
                        </div>
                    </td>
                    <td>{{ $sp['mau'] ?? '-' }}</td>
                    <td>{{ $sp['size'] ?? '-' }}</td>
                    <td>
                        <div class="qty-box">
                            <button onclick="capNhatSoLuongSP('{{ $key }}','minus')">−</button>
                            <span class="qty">{{ $sp['soluong'] }}</span>
                            <button onclick="capNhatSoLuongSP('{{ $key }}','plus')">+</button>
                        </div>
                    </td>
                    <td>{{ number_format($sp['gia']) }}đ</td>
                    <td class="cart-price">{{ number_format($tam) }}đ</td>
                </tr>
                @endforeach
                </tbody>

            </table>
            <div class="cart-summary">
                <div class="summary-row">
                    <span>Tổng cộng</span>
                    <b>{{ number_format($tong) }}đ</b>
                </div>
                <a href="{{ route('checkout') }}" class="btn-checkout">Thanh toán</a>
            </div>
        </div>
    @endif
</div>
@endsection
