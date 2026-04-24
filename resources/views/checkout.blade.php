@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Giỏ hàng</li>
                <li class="breadcrumb-item active">Thanh toán</li>
            </ol>
        </nav>

        @php
            // Cài đặt biến dựa trên việc đây là Mua mới hay Sửa đơn
            $isEdit = isset($order);
            $prod = $isEdit ? $order->orderDetails->first()->product : $product;
            $price = $isEdit ? $order->total_money : $prod->price;
            $actionUrl = $isEdit ? route('order.update', $order->id) : route('order.place');
        @endphp

        <form action="{{ $actionUrl }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7 pe-md-5">
                    <h5 class="mb-4">{{ $isEdit ? 'Thay đổi thông tin giao hàng' : 'Thông tin giao hàng' }}</h5>
                    <input type="hidden" name="product_id" value="{{ $prod->id }}">
                    <input type="hidden" name="price" value="{{ $price }}">

                    <input type="text" class="form-control mb-3 py-2 rounded-0" value="{{ Auth::user()->full_name }}"
                        readonly>
                    <div class="row mb-3">
                        <div class="col-md-8"><input type="email" class="form-control py-2 rounded-0"
                                value="{{ Auth::user()->username }}" readonly></div>
                        <div class="col-md-4"><input type="text" class="form-control py-2 rounded-0"
                                value="{{ Auth::user()->phone }}" readonly></div>
                    </div>

                    <input type="text" name="address" class="form-control mb-3 py-2 rounded-0"
                        placeholder="Địa chỉ chi tiết (Số nhà, đường...)" required>

                    <div class="row mb-3">
                        <div class="col-md-6"><input type="text" name="city" class="form-control py-2 rounded-0"
                                placeholder="Tỉnh/ Thành phố" required></div>
                        <div class="col-md-6"><input type="text" name="ward" class="form-control py-2 rounded-0"
                                placeholder="Phường/ Xã" required></div>
                    </div>
                    <textarea name="notes" class="form-control mb-4 rounded-0" rows="3" placeholder="Ghi chú"></textarea>

                    <h6 class="fw-bold mb-3">Phương thức thanh toán</h6>
                    <div class="border p-3 rounded-0 mb-4 text-muted"><input type="radio" checked class="me-2"> Thanh
                        toán khi nhận hàng (COD)</div>
                </div>

                <div class="col-md-5 bg-light p-4 border">
                    <div class="d-flex border-bottom pb-3 mb-3">
                        <img src="{{ asset('uploads/products/' . $prod->image) }}"
                            style="width: 70px; height: 70px; object-fit:cover" class="border rounded">
                        <div class="ms-3 w-100">
                            <p class="mb-0 fw-bold">{{ $prod->name }} <span
                                    class="float-end text-danger">{{ number_format($price, 0, ',', '.') }}đ</span></p>
                            <small class="text-muted">Size: {{ $isEdit ? 'Cũ' : $size }}</small>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between mb-3"><span class="text-muted">Phí vận
                            chuyển</span><span>—</span></div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4"><span>Tổng cộng</span><span
                            class="text-danger">VND {{ number_format($price, 0, ',', '.') }}đ</span></div>

                    <div class="alert border border-warning text-dark small p-3 rounded-0 mb-4"
                        style="background-color: #fffaf0;">
                        Chúng tôi sẽ XÁC NHẬN đơn hàng bằng TIN NHẮN SMS hoặc GỌI ĐIỆN. Bạn vui lòng kiểm tra TIN NHẮN hoặc
                        NGHE MÁY ngay khi đặt hàng thành công.
                    </div>
                    <button type="submit" class="btn text-white w-100 py-3 rounded-0 fw-bold"
                        style="background-color: #2980b9;">{{ $isEdit ? 'LƯU LẠI' : 'HOÀN TẤT ĐƠN HÀNG' }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
