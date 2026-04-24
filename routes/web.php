<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Http\Controllers\OrderController;

// ================= KHU VỰC KHÁCH HÀNG (PUBLIC) =================
Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ================= KHU VỰC QUẢN TRỊ (ADMIN) =================
// Dùng prefix 'admin' (đường dẫn bắt đầu bằng /admin/...)
// Dùng middleware 'auth' (phải đăng nhập) và 'admin' (phải là role 1)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Trang Quản lý doanh thu (Dashboard)
    Route::get('/admin', [\App\Http\Controllers\OrderController::class, 'dashboard'])->name('admin.dashboard');

    // Trang Lịch sử Order và Sản phẩm Yêu thích
    Route::get('/lich-su-order', [\App\Http\Controllers\OrderController::class, 'history'])->name('order.history');
    Route::get('/san-pham-yeu-thich', [\App\Http\Controllers\OrderController::class, 'favorites'])->name('favorites');

    // Quản lý Sản phẩm (Cũ)
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');

    // THÊM 3 ROUTE MỚI NÀY:
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// ================= KHU VỰC KHÁCH HÀNG (PUBLIC) =================
Route::get('/', function () {

    // Lấy 4 sản phẩm mới nhất của từng danh mục
    $ao = \App\Models\Product::where('category_id', 1)->orderBy('id', 'desc')->take(8)->get();
    $quan = \App\Models\Product::where('category_id', 2)->orderBy('id', 'desc')->take(8)->get();
    $phu_kien = \App\Models\Product::where('category_id', 3)->orderBy('id', 'desc')->take(8)->get();

    // Truyền cả 3 danh sách này ra trang home
    return view('home', compact('ao', 'quan', 'phu_kien'));
})->name('home');

Route::get('/ao', function () {
    $products = \App\Models\Product::where('category_id', 1)->orderBy('id', 'desc')->paginate(12);
    return view('ao', compact('products'));
})->name('ao');

Route::get('/quan', function () {
    $products = \App\Models\Product::where('category_id', 2)->orderBy('id', 'desc')->paginate(12);
    return view('quan', compact('products'));
})->name('quan');

Route::get('/phu-kien', function () {
    $products = \App\Models\Product::where('category_id', 3)->orderBy('id', 'desc')->paginate(12);
    return view('phu-kien', compact('products'));
})->name('phu-kien');

Route::get('/he-thong-cua-hang', function () {
    return view('he-thong-cua-hang');
})->name('he-thong-cua-hang');

Route::get('/thong-tin', function () {
    return view('thong-tin');
})->name('thong-tin');

// Route yêu cầu phải đăng nhập mới được vào
Route::middleware(['auth'])->group(function () {
    Route::get('/tai-khoan', function () {
        return view('profile');
    })->name('profile');
});

Route::middleware(['auth'])->group(function () {

    // 1. Luồng Thanh toán & Đặt hàng mới
    Route::get('/thanh-toan', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/dat-hang', [OrderController::class, 'placeOrder'])->name('order.place');

    // 2. Giỏ hàng (Quản lý đơn hàng)
    Route::get('/gio-hang', [OrderController::class, 'cart'])->name('cart');

    // 3. Thay đổi thông tin & Hủy đơn
    Route::get('/thanh-toan/sua/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/thanh-toan/cap-nhat/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/don-hang/huy/{id}', [OrderController::class, 'destroy'])->name('order.destroy');
});

// Các trang thông tin (Tin Tức)
Route::get('/thong-tin/tam-nhin', function () {
    return view('information.tam-nhin');
})->name('info.tam-nhin');
Route::get('/thong-tin/bao-mat', function () {
    return view('information.bao-mat');
})->name('info.bao-mat');
Route::get('/thong-tin/mua-hang', function () {
    return view('information.mua-hang');
})->name('info.mua-hang');
Route::get('/thong-tin/doi-hang', function () {
    return view('information.doi-hang');
})->name('info.doi-hang');
Route::get('/thong-tin/van-chuyen', function () {
    return view('information.van-chuyen');
})->name('info.van-chuyen');
