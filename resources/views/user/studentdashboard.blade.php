@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4 fw-bold text-primary">📌 Danh Sách Điểm Danh</h2>

    @if($attendances->isEmpty())
        <div class="alert alert-info text-center">
            ⏳ Chưa có lượt điểm danh nào!
        </div>
    @else
        <table class="table table-hover table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Sinh Viên</th>
                    <th>Môn Học</th>
                    <th>Thời Gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td class="fw-semibold">{{ $attendance->student->id }}</td>
                        <td>{{ $attendance->student->studentname }}</td>
                        <td class="text-primary fw-semibold">{{ $attendance->subject->subjectname }}</td>
                        <td class="text-success fw-semibold">{{ date('H:i d/m/Y', strtotime($attendance->time)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
