<div id="overlay-gio-hang" class="overlay" onclick="dongGioHang()"></div>
<div id="khung-gio-hang" class="khung-gio-hang">
    <div class="gio-hang-header">
        <h4>Giỏ hàng</h4>
        <button class="btn-dong" onclick="dongGioHang()">✕</button>
    </div>
    @if(session('giohang') && count(session('giohang')) > 0)
        @php $tong = 0; @endphp
        @foreach(session('giohang') as $sp)
            @php $tong += $sp['gia'] * $sp['soluong']; @endphp
            <div class="gio-item">
                <img src="{{ $sp['hinh'] }}" alt="">
                <div>
                    <p class="ten">{{ $sp['ten'] }}</p>
                    <small>{{ $sp['mau'] }} - {{ $sp['size'] }}</small>
                    <p>x{{ $sp['soluong'] }}</p>
                </div>
            </div>
        @endforeach
        <div class="gio-tong">
            <span>Tổng cộng</span>
            <b>{{ number_format($tong) }}đ</b>
        </div>
        <a href="{{ route('giohang') }}" class="btn-xem">Xem chi tiết</a>
        <a href="{{ route('thanhtoan') }}" class="btn-mua">Thanh toán</a>
    @else
        <p class="gio-rong">Chưa có sản phẩm nào trong giỏ.</p>
    @endif
</div>
