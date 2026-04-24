@extends('layouts.app')
@section('content')
    <div class="container mt-4 mb-5">
        <nav aria-label="breadcrumb" class="bg-light p-2 mb-4 rounded">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark text-decoration-none"><i
                            class="fa fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Hệ thống cửa hàng</li>
            </ol>
        </nav>
        <h2 class="mb-4 fw-normal">Hệ thống cửa hàng</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="card rounded-0 mb-3 border">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cửa hàng đồ thổ cẩm H'mông - Trụ sở chính</h5>
                        <p class="card-text text-muted mb-1"><i class="fa fa-map-marker-alt text-danger me-2"></i> Số 1,
                            Đường Bản Mây, Sapa, Lào Cai</p>
                        <p class="card-text text-muted"><i class="fa fa-phone text-danger me-2"></i> Hotline: 0353740144</p>
                    </div>
                </div>

                <div class="card rounded-0 mb-3 border">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Cửa hàng đồ thổ cẩm H'mông - Chi nhánh Hà Nội</h5>
                        <p class="card-text text-muted mb-1"><i class="fa fa-map-marker-alt text-danger me-2"></i> Số 123,
                            Đường Cầu Giấy, Hà Nội</p>
                        <p class="card-text text-muted"><i class="fa fa-phone text-danger me-2"></i> Hotline: 0859372075</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
