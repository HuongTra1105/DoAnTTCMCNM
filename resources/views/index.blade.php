<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header class="header">
    <div class="logo" >SOMETHING</div>
    <form class="search-form" action="{{ route('search') }}">
    <input type="text" name="q" placeholder="Tìm sản phẩm...">
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
<section class="hero">
    <h1>Xuân về – Noel sang</h1>
    <p>Mặc đẹp cả năm, vui trọn mùa lễ</p>
</section>
<section class="banner-slider">
    <div class="slides">
        <img src="https://phongvu.vn/cong-nghe/wp-content/uploads/2025/09/hinh-nen-lol-lien-minh-huyen-thoai-40.jpg" class="active">
        <img src="https://img.thuthuatphanmem.vn/uploads/2018/09/26/hinh-anh-noel-dep-nhat-the-gioi_051048381.jpg">
        <img src="https://phongvu.vn/cong-nghe/wp-content/uploads/2025/09/hinh-nen-lol-lien-minh-huyen-thoai-65.jpg">
    </div>
    <div class="dots">
        <span class="dot active" onclick="showSlide(0)"></span>
        <span class="dot" onclick="showSlide(1)"></span>
        <span class="dot" onclick="showSlide(2)"></span>
    </div>
</section>
<section class="container" id="sanpham">
    <div class="product-grid">
        @foreach ($products as $p)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ $p->mainImage->duong_dan_hinh ?? 'https://via.placeholder.com/300x380' }}">
                </div>
                <h3>{{ $p->Tensanpham }}</h3>
                @if ($p->gia_giam)
                    <p class="price">
                        <span class="old">{{ number_format($p->gia) }}đ</span>
                        <span class="sale">{{ number_format($p->gia_giam) }}đ</span>
                    </p>
                @else
                    <p class="price">{{ number_format($p->gia) }}đ</p>
                @endif
                <a class="btn" href="{{ route('product.show', $p->id) }}">Xem chi tiết</a>
            </div>
        @endforeach
    </div>
</section>
<div class="pagination">
       {{ $products->links('pagination::bootstrap-4') }}
    </div>
</body>
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
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.slides img');
const dots = document.querySelectorAll('.dot');
function showSlide(index) {
    slides.forEach(s => s.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));

    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentSlide = index;
}
setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}, 4000);
</script>
</html>
