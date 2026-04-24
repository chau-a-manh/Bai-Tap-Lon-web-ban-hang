@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <div class="text-center mb-5">
            <h2 class="fw-normal" style="font-family: 'Segoe UI', sans-serif;">Đổi mật khẩu</h2>
            <p class="text-muted small">Trang chủ / Đổi mật khẩu</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('error'))
                    <div class="alert alert-danger rounded-0">{{ session('error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger rounded-0">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('password.change') }}" method="POST">
                    @csrf
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-md-end"><label class="fw-bold text-dark">Mật khẩu cũ:</label></div>
                        <div class="col-md-8"><input type="password" name="old_password" class="form-control rounded-0 py-2"
                                placeholder="Mật khẩu cũ" required></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-md-end"><label class="fw-bold text-dark">Mật khẩu mới:</label></div>
                        <div class="col-md-8"><input type="password" name="new_password" class="form-control rounded-0 py-2"
                                placeholder="Mật khẩu mới" required></div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <div class="col-md-4 text-md-end"><label class="fw-bold text-dark">Xác Mật khẩu :</label></div>
                        <div class="col-md-8"><input type="password" name="new_password_confirmation"
                                class="form-control rounded-0 py-2" placeholder="Xác nhận mật khẩu mới" required></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <button type="submit" class="btn btn-light border rounded-0 px-4 py-2"
                                style="background-color: #f8f9fa;">Xác nhận</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
