@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <h2 class="fw-bold mb-4 text-uppercase">Giỏ hàng của tôi</h2>
        <div class="table-responsive border">
            <table class="table table-hover align-middle mb-0 text-center">
                <thead class="table-light">
                    <tr>
                        <th class="py-3">Mã Đơn</th>
                        <th class="py-3">Hình ảnh</th>
                        <th class="py-3">Tên sản phẩm</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="py-3">Tổng tiền</th>
                        <th class="py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        @php $item = $order->orderDetails->first()->product; @endphp
                        <tr>
                            <td class="fw-bold">#{{ $order->id }}</td>
                            <td><img src="{{ asset('uploads/products/' . $item->image) }}"
                                    style="width: 60px; height: 60px; object-fit: cover;" class="border"></td>
                            <td class="fw-bold">{{ $item->name }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $order->status }}</span></td>
                            <td class="text-danger fw-bold">{{ number_format($order->total_money, 0, ',', '.') }}đ</td>
                            <td>
                                <a href="{{ route('order.edit', $order->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-0 me-1"><i class="fa fa-edit"></i> Thay
                                    đổi thông tin</a>
                                <form action="{{ route('order.destroy', $order->id) }}" method="POST"
                                    class="d-inline-block" onsubmit="return confirm('Bạn muốn hủy đơn hàng này?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-0"><i
                                            class="fa fa-times"></i> Hủy đơn hàng</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-muted">Giỏ hàng của bạn đang trống.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
