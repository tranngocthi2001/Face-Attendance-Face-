
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>T-Smart </title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
<link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold text-primary" href="{{ url('/admindashboard') }}">
                    <i class="fas fa-graduation-cap"></i> T-Smart
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto ms-lg-4">
                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" aria-current="page" href="{{ url('/admindashboard') }}">
                                🏠 Trang chủ
                            </a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center">
                        @if (auth('student')->check())
                            <span class="navbar-text me-3 fw-semibold text-primary">
                                Xin chào, {{ auth('student')->user()->studentname }} 👋
                            </span>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    🚪 Đăng xuất
                                </button>
                            </form>
                        @else
                            <a href="{{ url('/registerform') }}" class="btn btn-outline-primary btn-sm me-2">
                                ✍️ Đăng ký
                            </a>
                            <a href="{{ url('/login') }}" class="btn btn-primary btn-sm">
                                🔑 Đăng nhập
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </nav>
        
        <!-- Header -->
        <header class="bg-dark py-5 position-relative">
            <div class="container text-center text-white position-relative">
                <h1 class="display-4 fw-bold">T-Smart</h1>
                <p class="lead fw-normal text-white-50 mb-3">
                    Trang web điểm danh nhận diện khuôn mặt dùng API Face++
                </p>
                <a href="{{ url('/attendances') }}" class="btn btn-warning btn-lg fw-bold shadow">
                    🚀 Bắt đầu điểm danh
                </a>
            </div>
        </header>
        
        <!-- Section-->
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif
        <h1>&nbsp;&nbsp;&nbsp; </h1>

        <main>
            @yield('content')
        </main>
        <h1>&nbsp;&nbsp;&nbsp; </h1>
        <h1>&nbsp;&nbsp;&nbsp; </h1>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container">
                <!-- Contact Information -->
                <div class="mt-4 text-center text-white">
                    <p><strong>Liên hệ: </strong>Email: dh51901412@student.stu.edu.vn.com | Hotline: <a href="tel:0348888144" class="text-white">034 8888 144</a></p>
                </div>

                <!-- Social Media Links -->
                <div class="mt-3 text-center">
                    <h1>&nbsp;&nbsp;&nbsp; </h1>
                    <p class="text-white"><strong>Kết nối với chúng tôi:</strong>
                        <a href="https://facebook.com" target="_blank" class="text-white me-3">
                            <i class="fab fa-facebook"></i> Facebook
                        </a>
                        <a href="https://zalo.me/yourzalo" target="_blank" class="text-white me-3">
                            <i class="fas fa-phone"></i> Zalo
                        </a>
                        <a href="https://instagram.com/" target="_blank" class="text-white">
                            <i class="fab fa-instagram"></i> instagram
                        </a>
                    </p>

                </div>

                <!-- Additional Information -->
                <div class="mt-4 text-center text-white">
                    <p><strong>Thông tin khác:</strong>
                        <p>Địa chỉ: 180 Đường Cao Lỗ, Phường 4, Quận 8, Thành phố Hồ Chí Minh</p>
                        <p>Giờ làm việc: 08:00 - 17:00 (Thứ Hai - Thứ Bảy)</p>
                    </p>

                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
