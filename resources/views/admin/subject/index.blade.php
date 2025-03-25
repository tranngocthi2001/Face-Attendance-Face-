@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">📚 Danh Sách Môn Học</h2>

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

    <a href="{{ route('subjects.create') }}" class="btn btn-success mb-3">
        ➕ Thêm Môn Học / Sự Kiện
    </a>

    <table class="table table-bordered table-hover text-center">
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
                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary">
                            ✏️ Chỉnh Sửa
                        </a>

                        <button class="btn btn-danger" onclick="confirmDelete({{ $subject->id }})">
                            🗑️ Xóa
                        </button>

                        <form id="delete-form-{{ $subject->id }}" 
                              action="{{ route('subjects.destroy', $subject->id) }}" 
                              method="POST" class="d-none">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Thêm SweetAlert2 để hiển thị thông báo xác nhận xóa --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(subjectId) {
        Swal.fire({
            title: "Bạn có chắc chắn?",
            text: "Môn học này và tất cả điểm danh liên quan sẽ bị xóa!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Có, xóa ngay!",
            cancelButtonText: "Hủy"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + subjectId).submit();
            }
        });
    }
</script>
@endsection
