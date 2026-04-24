@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <div class="text-center mb-5">
            <h2 class="fw-normal" style="font-family: 'Segoe UI', sans-serif;">Thông tin cá nhân</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-7">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Họ tên:</div>
                        <div class="col-md-9"><input type="text" name="full_name" class="form-control rounded-0 py-2"
                                value="{{ $user->full_name }}" required></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Ngày sinh:</div>
                        <div class="col-md-9"><input type="date" name="ngay_sinh" class="form-control rounded-0 py-2"
                                value="{{ $user->ngay_sinh }}"></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Điện thoại:</div>
                        <div class="col-md-9"><input type="text" name="phone" class="form-control rounded-0 py-2"
                                value="{{ $user->phone }}" required></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Email:</div>
                        <div class="col-md-9"><input type="email" name="email" class="form-control rounded-0 py-2"
                                value="{{ $user->username }}" readonly style="background-color: #f8f9fa;"></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Tỉnh/Thành phố :</div>
                        <div class="col-md-9"><input type="text" name="tinh_thanh_pho"
                                class="form-control rounded-0 py-2" placeholder="Nhập Tỉnh/Thành phố"
                                value="{{ $user->tinh_thanh_pho }}"></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Phường xã :</div>
                        <div class="col-md-9"><input type="text" name="phuong_xa" class="form-control rounded-0 py-2"
                                placeholder="Nhập Phường/Xã" value="{{ $user->phuong_xa }}"></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-3 fw-bold text-dark">Địa chỉ chi tiết:</div>
                        <div class="col-md-9"><input type="text" name="dia_chi_chi_tiet"
                                class="form-control rounded-0 py-2" placeholder="Số nhà, tên đường..."
                                value="{{ $user->dia_chi_chi_tiet }}"></div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-3"></div>
                        <div class="col-md-9 d-flex gap-4">
                            <button type="submit" class="btn border rounded-0 px-4 py-2"
                                style="background-color: #f1f3f5;">Cập nhật</button>
                            <a href="{{ route('profile') }}" class="btn text-dark px-4 py-2 text-decoration-none">Quay
                                lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
