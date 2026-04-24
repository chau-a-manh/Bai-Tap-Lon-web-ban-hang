@extends('layouts.app')
@php
    // Tính Điểm tích lũy: Tổng số lượng sản phẩm đã mua
    $diemTichLuy = \App\Models\OrderDetail::whereHas('order', function ($q) {
        $q->where('user_id', Auth::id());
    })->sum('quantity');

    // Tính Số sản phẩm yêu thích: Số loại sản phẩm độc nhất đã mua
    $soYeuThich = \App\Models\OrderDetail::whereHas('order', function ($q) {
        $q->where('user_id', Auth::id());
    })
        ->distinct()
        ->count('product_id');
@endphp
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <h2 class="text-center mb-5 fw-bold" style="font-family: serif; color: #334e68;">Tài khoản</h2>

        <div class="row mt-4">
            <div class="col-md-6 mb-4 px-md-5">
                <h5 class="fw-bold border-bottom pb-3 mb-4">Thông tin tài khoản</h5>

                <p class="mb-2"><strong>Xin chào:</strong> {{ Auth::user()->full_name }}</p>
                <p class="mb-2"><strong>Email/Tài khoản:</strong> {{ Auth::user()->username }}</p>
                <p class="mb-2">Điểm Tích lũy của bạn: <strong>{{ $diemTichLuy }}</strong></p>
                <p class="mb-4">Cấp độ khách hàng:
                    <strong>{{ $diemTichLuy > 10 ? 'Khách hàng VIP' : 'Thành viên mới' }}</strong>
                </p>

                <ul class="list-unstyled lh-lg mt-4">
                    <li><a href="{{ route('profile.edit.form') }}" class="text-dark text-decoration-none">Thay đổi thông tin
                            tài khoản</a></li>
                    <li><a href="{{ route('password.change.form') }}" class="text-dark text-decoration-none">Thay đổi mật
                            khẩu</a></li>

                    @if (Auth::user()->role == 1)
                        <li
                            class="mt-3 mb-3 p-3 bg-light border border-danger border-opacity-25 rounded d-flex flex-column gap-2">
                            <p class="text-danger fw-bold mb-1 small text-uppercase">Khu vực dành cho Admin</p>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-danger btn-sm text-start">
                                <i class="fa fa-cogs"></i> Quản lý / Thêm sản phẩm
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-success btn-sm text-start">
                                <i class="fa fa-chart-line"></i> Quản lý doanh thu
                            </a>
                        </li>
                    @endif

                    <li class="mt-3">
                        <a href="{{ route('logout') }}" class="text-dark text-decoration-none">
                            <i class="fa fa-sign-out-alt"></i> Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-md-6 px-md-5">
                <h5 class="fw-bold border-bottom pb-3 mb-4">Sản phẩm yêu thích</h5>

                <ul class="list-unstyled lh-lg">
                    <li><a href="{{ route('favorites') }}" class="text-secondary text-decoration-none">Sản phẩm yêu thích
                            ({{ $soYeuThich }})</a></li>
                    <li><a href="{{ route('order.history') }}" class="text-secondary text-decoration-none">Lịch sử
                            order</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center rounded-0" role="alert">
            <i class="fa fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection
