
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/css/app.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<header class="header">
    <a href="{{ route('home') }}" class="logo">SOMETHING</a>
    <form action="{{ route('search') }}" method="GET" class="search-box">
    <input type="text"
           name="q"
           placeholder="Tìm sản phẩm..."
           value="{{ request('q') }}">
    </form>
<nav class="menu">
@foreach ($categories as $cat)
    <div class="menu-item">
        <a href="{{ route('category.show', $cat->slug) }}">
            {{ $cat->Tendanhmuc }}
        </a>
        @if ($cat->children && $cat->children->isNotEmpty())
            <div class="dropdown">
                @foreach ($cat->children as $child)
                    <a href="{{ route('category.show', $child->slug) }}">
                        {{ $child->Tendanhmuc }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endforeach
<a href="javascript:void(0)" onclick="moGioHang()" class="cart-icon">
    Giỏ hàng
    <span class="cart-count">
        {{ collect(session('giohang', []))->sum('soluong') }}
    </span>
</a>
@include('giohang.GioHang')
@if(session('user'))
            <div class="menu-item">
                <span>Xin chào {{ session('user')->Ten }}</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button class="logout">
                        Đăng xuất
                    </button>
                </form>
            </div>
        @else
            <a href="/dang-ky">Tài khoản</a>
        @endif
</nav>
</header>
<main>
    @yield('content')
</main>
<footer class="footer">
    <div class="footer-wrap">
        <div class="footer-col">
            <h4>SOMETHING</h4>
            <p>Trang phục Tết, Noel và đồ trang trí đơn giản, dễ mặc.</p>
        </div>
        <div class="footer-col">
            <h4>Danh mục</h4>
            <a href="#">Đồ Tết</a>
            <a href="#">Đồ Noel</a>
            <a href="#">Trang trí</a>
        </div>
        <div class="footer-col">
            <h4>Hỗ trợ</h4>
            <a href="#">Liên hệ</a>
            <a href="#">Hướng dẫn mua</a>
            <a href="#">Đổi trả</a>
        </div>
    </div>
    <div class="footer-bottom">
        © 2025 Sell once, survive the whole year
    </div>
</footer>
<script src="{{ asset('js/ProductDetail.js') }}"></script>
</body>
</html>