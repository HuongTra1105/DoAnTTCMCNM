@extends('layouts.Meomeo')
@section('content')
<div class="container">
    <h3>Nhập mã OTP</h3>
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('otp.verify') }}">
    @csrf
    <input type="text" name="otp" placeholder="Nhập OTP" required>
    <button>Xác thực</button>
</form>
</div>
@endsection
