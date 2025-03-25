@extends('layouts.layoutquanly')

@section('content')
<div class="container mt-4">
    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Hiển thị thông báo lỗi --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="text-center text-primary mb-4">Điểm Danh: {{ $subject->subjectname }}</h2>

    <div class="text-center mb-4">
        <video id="video" class="border rounded shadow" width="300" height="200" autoplay></video>
        <canvas id="canvas" width="400" height="300" style="display: none;"></canvas>
        <img id="capturedImage" class="border rounded shadow mt-2" style="display: none; width: 200px; height: 150px;"/>
    </div>

    <div class="text-center">
        <button id="captureBtn" class="btn btn-primary">📷 Điểm Danh</button>
    </div>

    <form id="attendanceForm" action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
        <input type="hidden" name="image" id="imageInput">
    </form>

    <h3 class="mt-5 text-success">Danh Sách Điểm Danh</h3>
    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Họ & Tên</th>
                <th>MSSV</th>
                <th>Thời Gian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->student->studentname }}</td>
                    <td>{{ $attendance->student->mssv }}</td>
                    <td class="text-success fw-semibold">{{ \Carbon\Carbon::parse($attendance->time)->timezone('Asia/Ho_Chi_Minh')->format('H:i d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // Lấy phần tử video & canvas
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const ctx = canvas.getContext("2d");
    const capturedImage = document.getElementById("capturedImage");
    const imageInput = document.getElementById("imageInput");
    const captureBtn = document.getElementById("captureBtn");
    const attendanceForm = document.getElementById("attendanceForm");

    // Mở camera
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(error => console.error("❌ Lỗi truy cập camera: ", error));

    // Chụp ảnh & tự động gửi form
    captureBtn.addEventListener("click", () => {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        let imageData = canvas.toDataURL("image/png"); // Chuyển ảnh thành Base64
        imageInput.value = imageData; // Gán Base64 vào input hidden
        capturedImage.src = imageData; // Hiển thị ảnh đã chụp
        capturedImage.style.display = "block"; 
        attendanceForm.submit(); // Tự động gửi form
    });
</script>
@endsection
