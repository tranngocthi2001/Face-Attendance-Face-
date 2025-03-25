@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        
    @endif
    <h2 class="text-center text-primary mb-4">➕ Thêm Môn Học Mới</h2>

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

    <div class="card shadow-lg p-4">
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="subjectname" class="form-label fw-bold">Tên Môn Học</label>
                <input type="text" name="subjectname" id="subjectname" 
                       class="form-control" required
                       placeholder="Nhập tên môn học...">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">
                    ✅ Thêm Môn Học
                </button>
                <a href="{{ route('subjects.index') }}" class="btn btn-secondary">🔙 Quay Lại</a>
            </div>
        </form>
    </div>
</div>
@endsection
