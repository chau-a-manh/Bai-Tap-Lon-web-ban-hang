@extends('layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h4 class="mb-0 fw-bold">Sửa Sản Phẩm</h4>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{ route('admin.products.update', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="fw-bold">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control rounded-0"
                                    value="{{ $product->name }}" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Danh mục</label>
                                    <select name="category_id" class="form-select rounded-0" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">Giá bán</label>
                                    <input type="number" name="price" class="form-control rounded-0"
                                        value="{{ $product->price }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Mô tả</label>
                                <textarea name="description" class="form-control rounded-0" rows="4">{{ $product->description }}</textarea>
                            </div>
                            <div class="mb-4">
                                <label class="fw-bold">Hình ảnh mới (Bỏ trống nếu không muốn đổi ảnh)</label>
                                <input type="file" name="image" class="form-control rounded-0" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-dark w-100 py-2 fw-bold rounded-0">CẬP NHẬT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
