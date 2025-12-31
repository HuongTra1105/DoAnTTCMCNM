<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>regis</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
</head>
<body style="display:flex; align-items:center; justify-content:center;">
<div class="login-page">
    <div class="form">
        <form class="register-form" method="POST" action="{{ route('register') }}">
            @csrf
            <h2>Đăng ký</h2>
            <input type="text" name="Ten" placeholder="Full Name *" required>
            <input type="email" name="email" placeholder="Email *" required>
            <input type="password" name="MatKhau" placeholder="Password *" required>
            <button class="btn" type="submit">Tạo Tài khoản</button>
            <p class="message">Có tài khoản gòi?
                <a href="#" class="toggle">Zô</a>
            </p>
        </form>
        <form class="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Zô nhà</h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="MatKhau" placeholder="Password" required>
            <button class="btn" type="submit">Vừng ơi mở ra</button>
            <p class="message">Chưa có nhà?
                <a href="#" class="toggle">Tạo đi em</a>
            </p>
        </form>

    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/ProductDetail.js') }}"></script>
</body>
</html>
