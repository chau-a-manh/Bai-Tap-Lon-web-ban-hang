@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="text-uppercase fw-bold mb-0" style="color: #2c3e50;"><i class="fa fa-chart-line me-2"></i> Tổng quan
                Doanh thu</h3>

            <form action="{{ route('admin.dashboard') }}" method="GET" class="d-flex align-items-center gap-2">
                <label class="fw-bold text-muted text-nowrap">Lọc theo:</label>
                <select name="filter" class="form-select border-dark shadow-sm" onchange="this.form.submit()">
                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Tất cả thời gian</option>
                    <option value="day" {{ $filter == 'day' ? 'selected' : '' }}>Hôm nay</option>
                    <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Tuần này</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Tháng này</option>
                    <option value="quarter" {{ $filter == 'quarter' ? 'selected' : '' }}>Quý này</option>
                </select>
            </form>
        </div>

        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white border-0 shadow rounded-3 h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase fw-normal text-white-50">Tổng Doanh Thu</h6>
                                <h3 class="fw-bold mb-0">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h3>
                            </div>
                            <i class="fa fa-wallet fa-3x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white border-0 shadow rounded-3 h-100 p-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase fw-normal text-white-50">Số Đơn Hàng</h6>
                                <h3 class="fw-bold mb-0">{{ $totalOrders }} <span class="fs-6 fw-normal">đơn</span></h3>
                            </div>
                            <i class="fa fa-shopping-cart fa-3x text-white-50"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('admin.users') }}" class="text-decoration-none">
                    <div class="card bg-warning text-dark border-0 shadow rounded-3 h-100 p-3"
                        style="transition: transform 0.2s;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="text-uppercase fw-normal text-black-50">Khách Hàng Đăng Ký</h6>
                                    <h3 class="fw-bold mb-0 text-dark">{{ $totalUsers }} <span
                                            class="fs-6 fw-normal">người</span></h3>
                                </div>
                                <i class="fa fa-users fa-3x text-black-50"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="mb-0 fw-bold"><i class="fa fa-list me-2"></i> Đơn hàng cập nhật gần đây</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 px-4">Mã Đơn</th>
                                <th class="py-3">Ngày đặt</th>
                                <th class="py-3">Địa chỉ giao</th>
                                <th class="py-3">Tổng tiền</th>
                                <th class="py-3">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td class="px-4 fw-bold text-primary">#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-start"
                                        style="max-width: 250px; text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"
                                        title="{{ $order->shipping_address }}">
                                        {{ $order->shipping_address }}
                                    </td>
                                    <td class="text-danger fw-bold">{{ number_format($order->total_money, 0, ',', '.') }}đ
                                    </td>
                                    <td><span
                                            class="badge bg-warning text-dark rounded-pill px-3">{{ $order->status }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-5 text-muted">Chưa có đơn hàng nào được đặt.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
