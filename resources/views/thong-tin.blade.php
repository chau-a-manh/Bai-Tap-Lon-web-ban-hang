@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <h2 class="mb-3 fw-normal fs-1">Tin Tức</h2>
        <nav aria-label="breadcrumb" class="bg-light p-2 mb-5">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"
                        class="text-muted text-decoration-none fst-italic">Trang chủ</a></li>
                <li class="breadcrumb-item active fst-italic" aria-current="page">Tin Tức</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/tam-nhin.png') }}" class="card-img-top rounded-0" alt="Tầm nhìn"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title text-uppercase mb-1" style="font-size: 14px;">Tầm nhìn - Sứ mệnh H'mông</p>
                        <p class="text-muted small mb-3">Tầm nhìn - Sứ mệnh H'mông</p>
                        <a href="#" class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/cua-hang.png') }}" class="card-img-top rounded-0" alt="Cửa hàng"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title mb-1" style="font-size: 14px;">Hệ Thống Cửa Hàng</p>
                        <p class="text-muted small mb-3">Hệ Thống Cửa Hàng</p>
                        <a href="{{ route('he-thong-cua-hang') }}"
                            class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/bao-mat.png') }}" class="card-img-top rounded-0" alt="Bảo mật"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title mb-1" style="font-size: 14px;">Chính sách bảo mật thông tin</p>
                        <p class="text-muted small mb-3">Chính sách bảo mật thông tin</p>
                        <a href="#" class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/mua-hang.png') }}" class="card-img-top rounded-0" alt="Mua hàng"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title mb-1" style="font-size: 14px;">Hướng dẫn mua hàng</p>
                        <p class="text-muted small mb-3">Cách thức xem hàng và đặt hàng</p>
                        <a href="#" class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/doi-hang.png') }}" class="card-img-top rounded-0" alt="Đổi hàng"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title mb-1" style="font-size: 14px;">Chính sách đổi hàng</p>
                        <p class="text-muted small mb-3">QUY ĐỊNH ĐỔI HÀNG</p>
                        <a href="#" class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-5">
                <div class="card border-0">
                    <img src="{{ asset('uploads/news/van-chuyen.png') }}" class="card-img-top rounded-0" alt="Vận chuyển"
                        style="height: 250px; object-fit: cover; background-color: #f8f9fa;">
                    <div class="card-body px-0 pt-3">
                        <p class="card-title mb-1" style="font-size: 14px;">Chính sách vận chuyển</p>
                        <p class="text-muted small mb-3">VẬN CHUYỂN</p>
                        <a href="#" class="text-danger text-decoration-none small fst-italic">Xem thêm</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
