@extends('layouts.app')
@section('content')
    <div class="container mt-4 mb-5">
        <nav aria-label="breadcrumb" class="bg-light p-2 mb-4 rounded">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-dark text-decoration-none"><i
                            class="fa fa-home"></i> Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Phụ kiện</li>
            </ol>
        </nav>
        <h2 class="mb-4 text-uppercase fw-normal">Phụ kiện</h2>

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
                    <p>Đang cập nhật sản phẩm Phụ kiện...</p>
                </div>
            @endforelse
            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
