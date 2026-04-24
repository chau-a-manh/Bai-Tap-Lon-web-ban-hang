@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">
        <h2 class="text-center mb-5 fw-normal" style="font-family: 'Segoe UI', sans-serif;">Sản phẩm yêu thích</h2>

        <div class="table-responsive">
            <table class="table align-middle text-center border-bottom">
                <thead class="text-muted small border-top">
                    <tr>
                        <th class="py-3 fw-normal">Ảnh</th>
                        <th class="py-3 fw-normal">Tên sản phẩm</th>
                        <th class="py-3 fw-normal">Giá</th>
                        <th class="py-3 fw-normal">Ngày</th>
                        <th class="py-3 fw-normal">Trạng thái</th>
                        <th class="py-3 fw-normal">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($favorites as $fav)
                        <tr>
                            <td class="py-3"><img src="{{ asset('uploads/products/' . $fav->image) }}" width="60"
                                    class="border" alt="{{ $fav->name }}"></td>
                            <td class="py-3">{{ $fav->name }}</td>
                            <td class="py-3">{{ number_format($fav->price, 0, ',', '.') }}đ</td>
                            <td class="py-3">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</td>
                            <td class="py-3 text-muted">Còn hàng</td>
                            <td class="py-3">
                                <button class="btn btn-dark btn-sm rounded-0 text-uppercase" data-bs-toggle="modal"
                                    data-bs-target="#buyModal" data-id="{{ $fav->id }}" data-name="{{ $fav->name }}"
                                    data-price="{{ number_format($fav->price, 0, ',', '.') }}đ"
                                    data-image="{{ asset('uploads/products/' . $fav->image) }}"
                                    data-desc="{{ $fav->description }}">Mua hàng</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-dark fw-bold">Bạn chưa có sản phẩm yêu thích nào !</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
