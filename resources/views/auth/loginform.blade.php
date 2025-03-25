@extends('layouts.layoutquanly')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login</title>
</head>
<body>
<div class="container">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    <h2> Login</h2>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required placeholder="Nhập email của bạn">
        </div>

        <div class="mb-3">
            <label class="form-label">Mật khẩu:</label>
            <input type="password" name="password" class="form-control" required placeholder="Nhập mật khẩu">
        </div>

        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
    </form>

    <div class="text-center mt-3">
        <small>Chưa có tài khoản? <a href="{{ url('/registerform') }}">Đăng ký ngay</a></small>
    </div>
</div>
</body>
</html>
@endsection