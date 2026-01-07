<div id="overlay-gio-hang" class="overlay" onclick="dongGioHang()"></div>
<div id="khung-gio-hang" class="khung-gio-hang">
    <div class="gio-hang-header">
        <h4>Giỏ hàng</h4>
        <button class="btn-dong" onclick="dongGioHang()">✕</button>
    </div>
 @php $tong = 0; @endphp
    <div class="gio-hang-body">
        <div id="gio-hang-list">
            @if(session('giohang'))
                @foreach(session('giohang') as $sp)
                    @php $tong += $sp['gia'] * $sp['soluong']; @endphp
                    <div class="gio-item" data-key="{{ $sp['id'] }}_{{ $sp['mau'] }}_{{ $sp['size'] }}">
                        <img src="{{ $sp['hinh'] }}" alt="">
                        <div>
                            <p class="ten">{{ $sp['ten'] }}</p>
                            <small>{{ $sp['mau'] }} - {{ $sp['size'] }}</small>
                            <p class="soluong">x{{ $sp['soluong'] }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <p id="gio-rong" class="gio-rong"
           style="{{ session('giohang') && count(session('giohang')) ? 'display:none' : '' }}">
           Chưa có sản phẩm nào trong giỏ.
        </p>
    </div>
    <div class="gio-hang-footer">
        <div class="gio-tong">
            <span>Tổng cộng</span>
            <b id="gio-hang-tong">{{ number_format($tong) }}đ</b>
        </div>
        <a href="{{ route('giohang.chitiet') }}" class="btn-xem">Xem chi tiết</a>
    </div>
</div>
