@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h4 class="mb-0 text-uppercase fw-bold">Thêm Sản Phẩm Mới</h4>
                    </div>
                    <div class="card-body p-4">

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control rounded-0"
                                    placeholder="VD: Áo phông H'mông nam" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                                    <select name="category_id" class="form-select rounded-0" required>
                                        <option value="">-- Chọn danh mục --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Giá bán (VNĐ) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="price" class="form-control rounded-0"
                                        placeholder="VD: 150000" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Mô tả sản phẩm</label>
                                <textarea name="description" class="form-control rounded-0" rows="4" placeholder="Nhập chất liệu, kiểu dáng..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold">Hình ảnh sản phẩm <span
                                        class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control rounded-0" accept="image/*"
                                    required>
                                <small class="text-muted">Chọn ảnh có định dạng .jpg, .png, .jpeg</small>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-dark w-50 py-2 fw-bold text-uppercase rounded-0">Lưu
                                    sản phẩm</button>
                                <a href="{{ route('home') }}"
                                    class="btn btn-outline-secondary w-50 py-2 fw-bold text-uppercase rounded-0">Hủy / Về
                                    trang chủ</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
