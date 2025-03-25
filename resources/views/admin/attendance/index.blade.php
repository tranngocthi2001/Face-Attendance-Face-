@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">📌 Quản Lý Điểm Danh</h2>

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

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

    <table class="table table-bordered table-hover ">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Môn Học</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($subjects as $subject)
                <tr>
                    <td>{{ $subject->id }}</td>
                    <td class="fw-bold">{{ $subject->subjectname }}</td>
                    <td>
                        <a href="{{ route('attendances.create', $subject->id) }}" class="btn btn-success">
                            ➕ Tạo Điểm Danh
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
