@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">📋 Danh Sách Sinh Viên</h2>

    <a href="{{ route('students.create') }}" class="btn btn-success mb-3">
        ➕ Thêm Sinh Viên / Người Tham Dự
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>MSSV</th>
                <th>Email</th>
                <th>Ảnh Đại Diện</th>
                <th>Vai Trò</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                @if ($student->status == 1)
                <tr class="align-middle text-center">
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->studentname }}</td>
                    <td>{{ $student->mssv }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <img src="{{ $student->profile_image ? asset($student->profile_image) : asset('uploads/default-avatar.png') }}" 
                             width="80" height="80" class="rounded-circle border shadow" alt="Profile Image">
                    </td>
                    <td>
                        <span class="badge {{ $student->role == 2 ? 'bg-danger' : 'bg-primary' }}">
                            {{ $student->role == 2 ? 'Admin' : 'User' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-success">Active</span>
                    </td>
                    <td>
                        @if ($student->role == 1)
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" 
                              onsubmit="confirmDelete(event, this)" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                🗑 Xóa
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

{{-- Import thư viện SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(event, form) {
        event.preventDefault();
        Swal.fire({
            title: "⚠ Xác nhận xóa",
            text: "Bạn có chắc chắn muốn xóa sinh viên này? Toàn bộ điểm danh liên quan cũng sẽ bị xóa!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "🗑 Xóa ngay!",
            cancelButtonText: "❌ Hủy bỏ"
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>

@endsection
