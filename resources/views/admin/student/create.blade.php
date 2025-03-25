@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">👨‍🎓 Thêm Sinh Viên Mới</h2>

    {{-- Hiển thị thông báo lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        
    @endif
    <div class="card shadow-lg p-4">
        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="student_name" class="form-label fw-bold">👤 Tên Sinh Viên</label>
                <input type="text" name="student_name" id="student_name" 
                       class="form-control" required
                       placeholder="Nhập tên sinh viên...">
            </div>

            <div class="mb-3">
                <label for="mssv" class="form-label fw-bold">🆔 MSSV</label>
                <input type="text" name="mssv" id="mssv" 
                       class="form-control" required
                       placeholder="Nhập mã số sinh viên...">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label fw-bold">📧 Email</label>
                <input type="email" name="email" id="email" 
                       class="form-control" required
                       placeholder="Nhập email...">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">🔒 Mật Khẩu</label>
                <input type="password" name="password" id="password" 
                       class="form-control" required
                       placeholder="Nhập mật khẩu...">
            </div>

            <div class="mb-3">
                <label for="profile_image" class="form-label fw-bold">🖼 Ảnh Đại Diện</label>
                <input type="file" name="profile_image" id="profile_image" 
                       class="form-control" accept="image/*" required
                       onchange="previewImage(event)">
                <img id="imagePreview" class="mt-3" style="max-width: 150px; display: none;">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    ✅ Thêm Sinh Viên
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">🔙 Quay Lại</a>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection
