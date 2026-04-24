@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <div class="row">
            <div class="col-md-9 pe-md-5">
                <h5 class="mb-4 text-uppercase fw-bold">Đơn hàng</h5>
                <div class="table-responsive">
                    <table class="table border-top border-bottom align-middle text-center">
                        <thead class="text-muted small">
                            <tr>
                                <th class="py-3 fw-normal">Đơn hàng</th>
                                <th class="py-3 fw-normal">Thông tin đơn hàng</th>
                                <th class="py-3 fw-normal">Trạng thái</th>
                                <th class="py-3 fw-normal">Sản phẩm</th>
                                <th class="py-3 fw-normal">Tổng tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                @php $item = $order->orderDetails->first()->product; @endphp
                                <tr>
                                    <td class="py-3">#{{ $order->id }}</td>
                                    <td class="py-3 text-start small">
                                        {{ $order->created_at->format('d/m/Y') }}<br>{{ $order->shipping_address }}</td>
                                    <td class="py-3">{{ $order->status }}</td>
                                    <td class="py-3"><img src="{{ asset('uploads/products/' . $item->image) }}"
                                            width="50" class="border"></td>
                                    <td class="py-3 fw-bold text-danger">
                                        {{ number_format($order->total_money, 0, ',', '.') }}đ</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-muted">Bạn chưa có đơn hàng nào.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3">
                <h3 class="mb-4" style="font-family: serif;">Tài khoản</h3>
                <ul class="list-unstyled lh-lg">
                    <li><a href="{{ route('profile') }}" class="text-dark text-decoration-none">Thông tin tài khoản</a></li>
                    <li><a href="{{ route('order.history') }}" class="text-info text-decoration-none">Quản lý đơn hàng</a>
                    </li>
                    <li><a href="{{ route('logout') }}" class="text-dark text-decoration-none">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
