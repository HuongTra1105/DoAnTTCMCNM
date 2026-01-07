@extends('layouts.Meomeo')
@section('content')
<div class="success-wrap">
    <div class="success-box">
        <div class="icon">✓</div>
        <h2>Đặt hàng thành công</h2>
        <p>Cảm ơn bạn đã mua sắm tại <b>SOMETHING</b>.</p>
        @if(session('order_code'))
            <p class="order-code">
                Mã đơn hàng: <b>#{{ session('order_code') }}</b>
            </p>
        @endif
        <p class="note">
            Chúng tôi sẽ liên hệ với bạn để xác nhận đơn hàng trong thời gian sớm nhất.
        </p>
        <a href="{{ route('home') }}" class="btn-home">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
