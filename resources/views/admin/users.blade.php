@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
            <h3 class="text-uppercase fw-bold mb-0" style="color: #2c3e50;"><i class="fa fa-users me-2"></i> Quản lý Tài khoản
            </h3>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary rounded-0">
                <i class="fa fa-arrow-left me-2"></i> Quay lại Dashboard
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3">Họ và tên</th>
                                <th class="py-3">Tài khoản / Email</th>
                                <th class="py-3">Điện thoại</th>
                                <th class="py-3">Vai trò</th>
                                <th class="py-3">Ngày đăng ký</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td class="px-4 fw-bold text-primary">#{{ $user->id }}</td>
                                    <td class="fw-bold">{{ $user->full_name }}</td>
                                    <td>{{ $user->email ?? $user->username }}</td>
                                    <td>{{ $user->phone ?? 'Chưa cập nhật' }}</td>
                                    <td>
                                        @if ($user->role == 1)
                                            <span class="badge bg-danger rounded-pill px-3">Admin</span>
                                        @else
                                            <span class="badge bg-secondary rounded-pill px-3">Khách hàng</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-5 text-muted">Chưa có tài khoản nào trên hệ thống.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
