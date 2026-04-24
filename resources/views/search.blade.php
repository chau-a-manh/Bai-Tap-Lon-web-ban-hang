@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5" style="min-height: 50vh;">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase fs-1" style="font-family: 'Segoe UI', sans-serif;">Tìm kiếm</h2>
            <p class="text-muted mb-2">Có {{ $products->total() }} sản phẩm cho tìm kiếm</p>
            <hr class="mx-auto" style="width: 60px; border: 2px solid #000; opacity: 1;">
        </div>

        <div class="mb-4">
            <p class="text-muted">Kết quả tìm kiếm cho "<strong>{{ $keyword }}</strong>".</p>
        </div>

        <div class="row text-center">
            @forelse ($products as $product)
                <div class="col-md-3 col-6 mb-4">
                    <div class="border" style="height: 300px; overflow: hidden;">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}"
                            class="w-100 h-100" style="object-fit: cover;">
                    </div>
                    <h6 class="text-muted mt-3">{{ $product->name }}</h6>
                    <p class="fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                    @auth
                        <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal" data-bs-target="#buyModal"
                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                            data-price="{{ number_format($product->price, 0, ',', '.') }}đ"
                            data-image="{{ asset('uploads/products/' . $product->image) }}"
                            data-desc="{{ $product->description }}">Mua hàng</button>
                    @else
                        <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal" data-bs-target="#authModal">Mua
                            hàng</button>
                    @endauth
                </div>
            @empty
                <div class="col-12 text-center text-muted py-5">
                    <i class="fa fa-search fa-3x mb-3 text-black-50"></i>
                    <h5>Không tìm thấy sản phẩm nào!</h5>
                    <p>Vui lòng thử lại với một từ khóa khác (ví dụ: áo, váy, túi...)</p>
                </div>
            @endforelse

            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $products->appends(['keyword' => $keyword])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
