@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">🎛️ Trang Quản Trị</h2>

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            ✅ {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Hiển thị thông báo lỗi --}}
    @error('email')
        <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            ❌ {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @enderror

    <div class="d-flex flex-column align-items-center">
        <a href="/students" class="btn btn-outline-primary btn-lg w-50 mb-3">
            👨‍🎓 Quản lý Sinh Viên, Người Tham Dự
        </a>
        <a href="/subjects" class="btn btn-outline-success btn-lg w-50 mb-3">
            📚 Quản lý Môn Học, Sự Kiện
        </a>
        <a href="/attendances" class="btn btn-outline-warning btn-lg w-50 mb-3">
            📋 Quản lý Điểm Danh
        </a>
    </div>
</div>
@endsection
