@extends('layouts.layoutquanly')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="width: 400px; border-radius: 12px;">
        <h3 class="text-center mb-4">Đăng Ký</h3>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    {{-- Hiển thị thông báo lỗi (nếu có) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
        <!-- Hiển thị thông báo lỗi -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Họ và tên:</label>
                <input type="text" name="student_name" class="form-control" required placeholder="Nhập họ và tên">
            </div>

            <div class="mb-3">
                <label class="form-label">MSSV:</label>
                <input type="text" name="mssv" class="form-control" required placeholder="Nhập MSSV">
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required placeholder="Nhập email của bạn">
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu:</label>
                <input type="password" name="password" class="form-control" required placeholder="Nhập mật khẩu">
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh đại diện:</label>
                <input type="file" name="profile_image" class="form-control" accept="image/*" required id="profileImageInput">
                <img id="profileImagePreview" class="mt-2 rounded" style="width: 100%; display: none;" />
            </div>

            <button type="submit" class="btn btn-primary w-100">Đăng Ký</button>
        </form>

        <div class="text-center mt-3">
            <small>Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a></small>
        </div>
    </div>
</div>

<!-- Script Preview Ảnh -->
<script>
    document.getElementById('profileImageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('profileImagePreview');
                img.src = e.target.result;
                img.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection