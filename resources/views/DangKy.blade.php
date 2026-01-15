<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập | Đăng ký</title>
    <link rel="stylesheet" href="{{ asset('css/Login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="auth-box">
    {{-- FORM ĐĂNG NHẬP --}}
    <form id="loginBox" method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Đăng nhập</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="MatKhau" placeholder="Mật khẩu" required>

        <button type="submit">Đăng nhập</button>

        <div class="divider" style="text-align:center; margin:15px 0; color:#888; border-bottom:1px solid #eee; line-height:0.1em;">
            <span style="background:#fff; padding:0 10px;">Hoặc</span>
        </div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg" width="18px" style="margin-right:8px;">
            Tiếp tục với Google
        </a>

        @if(session('error'))
            <p class="error" style="color:red; margin-top:10px;">{{ session('error') }}</p>
        @endif

        <p class="switch">Chưa có tài khoản? <a onclick="showRegister()" style="cursor:pointer; color:blue;">Đăng ký</a></p>
    </form>

    {{-- FORM ĐĂNG KÝ --}}
    <form id="registerBox" style="display:none;">
        @csrf
        <h2>Đăng ký</h2>
        <input type="text" name="Ten" placeholder="Họ tên" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="MatKhau" placeholder="Mật khẩu" required>
        <button type="submit">Gửi OTP</button>
        <p class="switch"><a onclick="showLogin()" style="cursor:pointer; color:blue;">Quay lại đăng nhập</a></p>
    </form>

    {{-- FORM OTP --}}
    <form id="otpBox" style="display:none;">
        @csrf
        <h2>Xác thực OTP</h2>
        <input type="text" name="otp" placeholder="Nhập mã OTP" required>
        <button type="submit">Xác nhận</button>
    </form>
</div>

<style>
    .btn-google {
        display: flex; align-items: center; justify-content: center;
        background: #fff; border: 1px solid #ddd; padding: 10px;
        border-radius: 4px; text-decoration: none; color: #333; font-weight: 500;
        transition: 0.3s;
    }
    .btn-google:hover { background: #f7f7f7; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .auth-box { padding: 20px; background: #fff; border-radius: 8px; }
</style>
<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>