<header class="sticky-top shadow-sm" style="z-index: 1050; background-color: #fff;">
    <div class="bg-light py-2 border-bottom text-end px-4">
        <span class="me-3"><i class="fa fa-phone"></i> 0353740144 - 0859372075</span>

        @auth
            <a href="{{ route('profile') }}" class="text-dark text-decoration-none me-3"><i class="fa fa-user"></i>
                {{ Auth::user()->full_name }}</a>
            <a href="{{ route('logout') }}" class="text-dark text-decoration-none me-3"><i class="fa fa-sign-out-alt"></i>
                Đăng
                xuất</a>
        @else
            <a href="#" class="text-dark text-decoration-none me-3" data-bs-toggle="modal"
                data-bs-target="#authModal"><i class="fa fa-user"></i> Tài khoản</a>
        @endauth

        @auth
            <a href="{{ route('cart') }}" class="text-dark text-decoration-none"><i class="fa fa-shopping-bag"></i> Giỏ
                hàng</a>
        @else
            <a href="#" class="text-dark text-decoration-none" onclick="alert('Bạn cần đăng nhập để vào giỏ hàng!');"
                data-bs-toggle="modal" data-bs-target="#authModal">
                <i class="fa fa-shopping-bag"></i> Giỏ hàng
            </a>
        @endauth
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container">
            <a class="navbar-brand fs-2 fw-bold" style="font-family: serif;" href="/">H'mông</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav fw-bold">
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('home') }}">TRANG CHỦ</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('ao') }}">ÁO</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('quan') }}">QUẦN</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('phu-kien') }}">PHỤ KIỆN</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('he-thong-cua-hang') }}">HỆ THỐNG
                            CỬA HÀNG</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('thong-tin') }}">THÔNG TIN</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex">
                <div class="input-group">
                    <input type="text" class="form-control rounded-pill" placeholder="Tìm kiếm...">
                </div>
            </div>
        </div>
    </nav>
</header>
