<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website bán đồ thổ cẩm dân tộc H'mông</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .product-placeholder {
            width: 100%;
            height: 300px;
            background-color: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            margin-bottom: 15px;
        }

        .nav-tabs .nav-link.active {
            font-weight: bold;
            color: #000;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
        }

        /* Tùy chỉnh icon Accordion thành dấu + và - */
        .accordion-button::after {
            content: '+';
            background-image: none;
            font-size: 1.5rem;
            font-weight: 300;
            color: #000;
        }

        .accordion-button:not(.collapsed)::after {
            content: '-';
            background-image: none;
            transform: none;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .accordion-button:not(.collapsed) {
            background-color: transparent;
            color: #000;
        }
    </style>
</head>

<body class="bg-light">

    @include('partials.header')

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center rounded-0 mb-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show text-center rounded-0 mb-0" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main class="bg-white">
        @yield('content')
    </main>

    @include('partials.footer')

    <div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <ul class="nav nav-tabs w-100 text-center" id="authTabs" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link active w-100 rounded-0 py-3" id="login-tab" data-bs-toggle="tab"
                                data-bs-target="#login" type="button" role="tab">ĐĂNG NHẬP</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link w-100 rounded-0 py-3" id="register-tab" data-bs-toggle="tab"
                                data-bs-target="#register" type="button" role="tab">ĐĂNG KÝ</button>
                        </li>
                    </ul>

                    <div class="tab-content p-4" id="authTabsContent">

                        <div class="tab-pane fade show active" id="login" role="tabpanel">
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="mb-3 border-bottom">
                                    <input type="text" name="login_id" class="form-control border-0 shadow-none px-0"
                                        placeholder="Nhập email hoặc Tên đăng nhập" required>
                                </div>
                                <div class="mb-3 border-bottom">
                                    <input type="password" name="password"
                                        class="form-control border-0 shadow-none px-0" placeholder="Mật khẩu" required>
                                </div>
                                <button type="submit" class="btn btn-dark px-4 py-2">ĐĂNG NHẬP</button>

                                <div class="text-center mt-4">
                                    <a href="#" class="text-decoration-none text-primary">Quên mật khẩu?</a>
                                    <p class="mt-2 mb-3">Hoặc đăng nhập với</p>
                                    <div class="d-flex justify-content-center gap-2">
                                        <button type="button" class="btn text-white"
                                            style="background-color: #3b5998;"><i class="fab fa-facebook-f me-2"></i>
                                            Đăng nhập bằng Facebook</button>
                                        <button type="button" class="btn text-white bg-dark"><i
                                                class="fab fa-google me-2"></i> Đăng nhập bằng Google</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="register" role="tabpanel">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <div class="mb-3 border">
                                    <input type="text" name="full_name" class="form-control border-0 shadow-none"
                                        placeholder="Họ tên" required>
                                </div>
                                <div class="mb-3 border">
                                    <input type="text" name="phone" class="form-control border-0 shadow-none"
                                        placeholder="Điện thoại" required>
                                </div>
                                <div class="mb-3 border">
                                    <input type="email" name="email" class="form-control border-0 shadow-none"
                                        placeholder="Email" required>
                                </div>
                                <div class="mb-3 border">
                                    <input type="password" name="password" class="form-control border-0 shadow-none"
                                        placeholder="Mật khẩu của bạn" required>
                                </div>
                                <button type="submit" class="btn text-white px-4 py-2"
                                    style="background-color: #ff7f00;">ĐĂNG KÝ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="buyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-0">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0 px-4 pb-4">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <h4 class="fw-bold mb-4" style="font-family: serif;">H'mông</h4>
                            <div id="modalProductImage" class="w-100 border" style="height: 350px; overflow:hidden;">
                            </div>
                        </div>

                        <div class="col-md-6 pt-4 pt-md-0">
                            <h5 class="fw-normal" id="modalProductName">Tên sản phẩm</h5>
                            <p class="text-muted small mb-2">Tình trạng: <span class="text-dark fw-bold">Còn
                                    hàng</span></p>
                            <h5 class="fw-bold mb-4 text-danger" id="modalProductPrice">0đ</h5>

                            <p class="small mb-2 text-uppercase fw-bold">Kích thước</p>
                            <div class="d-flex gap-2 mb-4" id="sizeSelector">
                                <button type="button"
                                    class="btn btn-dark text-white rounded-0 px-3 py-1 size-btn">M</button>
                                <button type="button"
                                    class="btn btn-outline-secondary rounded-0 px-3 py-1 size-btn">L</button>
                                <button type="button"
                                    class="btn btn-outline-secondary rounded-0 px-3 py-1 size-btn">XL</button>
                                <button type="button"
                                    class="btn btn-outline-secondary rounded-0 px-3 py-1 size-btn">2XL</button>
                            </div>

                            <form action="{{ route('checkout') }}" method="GET">
                                <input type="hidden" name="product_id" id="modalInputProductId">
                                <input type="hidden" name="size" id="modalInputSize" value="2XL"> <button
                                    type="submit"
                                    class="btn btn-dark w-100 rounded-0 py-2 mb-4 text-uppercase fw-bold">Sở hữu
                                    ngay</button>
                            </form>
                            <div class="accordion accordion-flush border-top" id="productAccordion">
                                <div class="accordion-item border-bottom">
                                    <h2 class="accordion-header"><button
                                            class="accordion-button rounded-0 shadow-none text-uppercase small px-0 fw-bold"
                                            data-bs-toggle="collapse" data-bs-target="#collapseInfo">Thông tin sản
                                            phẩm</button></h2>
                                    <div id="collapseInfo" class="accordion-collapse collapse show"
                                        data-bs-parent="#productAccordion">
                                        <div class="accordion-body px-0 text-muted small pt-0 pb-3"
                                            id="collapseInfoBody">Đang cập nhật...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // 1. Script chọn Size
            var sizeBtns = document.querySelectorAll('.size-btn');
            sizeBtns.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    // Xóa trạng thái đang chọn của tất cả nút
                    sizeBtns.forEach(b => {
                        b.classList.remove('btn-dark', 'text-white');
                        b.classList.add('btn-outline-secondary');
                    });
                    // Bật trạng thái chọn cho nút được click
                    this.classList.remove('btn-outline-secondary');
                    this.classList.add('btn-dark', 'text-white');
                });
            });

            // 2. Script đẩy dữ liệu vào Modal
            var buyModal = document.getElementById('buyModal');
            if (buyModal) {
                buyModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget; // Nút Mua hàng vừa bấm

                    // Lấy dữ liệu từ nút
                    var name = button.getAttribute('data-name');
                    var price = button.getAttribute('data-price');
                    var image = button.getAttribute('data-image');
                    var desc = button.getAttribute('data-desc');

                    // Gắn vào Modal
                    document.getElementById('modalProductName').textContent = name;
                    document.getElementById('modalProductPrice').textContent = price;
                    document.getElementById('collapseInfoBody').textContent = desc ? desc :
                        'Chưa có mô tả cho sản phẩm này.';
                    document.getElementById('modalProductImage').innerHTML = '<img src="' + image +
                        '" class="w-100 h-100" style="object-fit: cover;">';
                });
            }
        });

        // 1. Script chọn Size
        var sizeBtns = document.querySelectorAll('.size-btn');
        var sizeInput = document.getElementById('modalInputSize'); // Lấy input ẩn

        sizeBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                sizeBtns.forEach(b => {
                    b.classList.remove('btn-dark', 'text-white');
                    b.classList.add('btn-outline-secondary');
                });
                this.classList.remove('btn-outline-secondary');
                this.classList.add('btn-dark', 'text-white');
                sizeInput.value = this.textContent.trim(); // Cập nhật size được chọn
            });
        });

        // 2. Script đẩy dữ liệu vào Modal
        var buyModal = document.getElementById('buyModal');
        if (buyModal) {
            buyModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var id = button.getAttribute('data-id'); // THÊM DÒNG NÀY LẤY ID
                var name = button.getAttribute('data-name');
                var price = button.getAttribute('data-price');
                var image = button.getAttribute('data-image');
                var desc = button.getAttribute('data-desc');

                document.getElementById('modalInputProductId').value = id; // ĐẨY ID VÀO FORM
                document.getElementById('modalProductName').textContent = name;
                document.getElementById('modalProductPrice').textContent = price;
                document.getElementById('collapseInfoBody').textContent = desc ? desc : 'Đang cập nhật nội dung.';
                document.getElementById('modalProductImage').innerHTML = '<img src="' + image +
                    '" class="w-100 h-100" style="object-fit: cover;">';
            });
        }
    </script>
</body>

</html>
