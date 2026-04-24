@extends('layouts.app')

@section('content')
    <div class="container mt-4 mb-5">

        <div class="row mb-5">
            <div class="col-12">
                <div id="homeBannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">

                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#homeBannerCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#homeBannerCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#homeBannerCarousel" data-bs-slide-to="2"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('uploads/cover-photo/anh_nen1.png') }}" class="d-block w-100" alt="Banner 1"
                                style="height: 600px; object-fit: cover;">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('uploads/cover-photo/anh_nen2.png') }}" class="d-block w-100" alt="Banner 2"
                                style="height: 600px; object-fit: cover;">
                        </div>

                        <div class="carousel-item">
                            <img src="{{ asset('uploads/cover-photo/anh_nen3.png') }}" class="d-block w-100" alt="Banner 3"
                                style="height: 600px; object-fit: cover;">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#homeBannerCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Trang trước</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#homeBannerCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Trang sau</span>
                    </button>
                </div>
            </div>
        </div>

        @php
            $getDisplayList = function ($collection) {
                return $collection->count() >= 8 ? $collection->take(8) : $collection->take(4);
            };
        @endphp

        <div class="mb-5">
            <h3 class="fw-bold mb-4 text-uppercase">
                <a href="{{ route('ao') }}" class="text-dark text-decoration-none">Áo <i
                        class="fa fa-angle-right fs-5"></i></a>
            </h3>
            <div class="row text-center">
                @forelse ($getDisplayList($ao) as $product)
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
                            <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#authModal">Mua hàng</button>
                        @endauth
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Đang cập nhật sản phẩm Áo...</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mb-5 border-top pt-4">
            <h3 class="fw-bold mb-4 text-uppercase">
                <a href="{{ route('quan') }}" class="text-dark text-decoration-none">Quần <i
                        class="fa fa-angle-right fs-5"></i></a>
            </h3>
            <div class="row text-center">
                @forelse ($getDisplayList($quan) as $product)
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
                            <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#authModal">Mua hàng</button>
                        @endauth
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Đang cập nhật sản phẩm Quần...</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mb-5 border-top pt-4">
            <h3 class="fw-bold mb-4 text-uppercase">
                <a href="{{ route('phu-kien') }}" class="text-dark text-decoration-none">Phụ kiện <i
                        class="fa fa-angle-right fs-5"></i></a>
            </h3>
            <div class="row text-center">
                @forelse ($getDisplayList($phu_kien) as $product)
                    <div class="col-md-3 col-6 mb-4">
                        <div class="border" style="height: 300px; overflow: hidden;">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-100 h-100" style="object-fit: cover;">
                        </div>
                        <h6 class="text-muted mt-3">{{ $product->name }}</h6>
                        <p class="fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }}đ</p>
                        @auth
                            <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#buyModal" data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                data-price="{{ number_format($product->price, 0, ',', '.') }}đ"
                                data-image="{{ asset('uploads/products/' . $product->image) }}"
                                data-desc="{{ $product->description }}">Mua hàng</button>
                        @else
                            <button class="btn btn-outline-dark btn-sm w-100" data-bs-toggle="modal"
                                data-bs-target="#authModal">Mua hàng</button>
                        @endauth
                    </div>
                @empty
                    <div class="col-12 text-center text-muted">
                        <p>Đang cập nhật sản phẩm Phụ kiện...</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>
@endsection
