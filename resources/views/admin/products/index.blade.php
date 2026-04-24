@extends('layouts.app')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-uppercase fw-bold mb-0">Quản lý Sản phẩm</h3>
            <a href="{{ route('admin.products.create') }}" class="btn btn-dark rounded-0 fw-bold">
                <i class="fa fa-plus me-2"></i> Thêm sản phẩm
            </a>
        </div>

        <form action="{{ route('admin.products.index') }}" method="GET" class="mb-4 d-flex gap-2 w-50">
            <select name="category_id" class="form-select rounded-0 border-dark">
                <option value="">-- Hiển thị tất cả --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-dark rounded-0 px-4">Lọc</button>
        </form>

        <div class="card border-0 shadow-sm rounded-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="py-3 px-4">ID</th>
                                <th class="py-3 text-center">Hình ảnh</th>
                                <th class="py-3">Tên sản phẩm</th>
                                <th class="py-3">Danh mục</th>
                                <th class="py-3">Giá bán</th>
                                <th class="py-3 text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td class="px-4 fw-bold">{{ $product->id }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                            style="width: 60px; height: 60px; object-fit: cover;" class="border">
                                    </td>
                                    <td class="fw-bold">{{ $product->name }}</td>
                                    <td>{{ $product->category ? $product->category->name : '' }}</td>
                                    <td class="text-danger fw-bold">{{ number_format($product->price, 0, ',', '.') }}đ</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary rounded-0 me-1"><i class="fa fa-edit"></i>
                                            Sửa</a>

                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                            class="d-inline-block" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-0"><i
                                                    class="fa fa-trash"></i> Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">Không tìm thấy sản phẩm.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
