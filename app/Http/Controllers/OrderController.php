<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // 1. Mở trang Thanh toán
    public function checkout(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $size = $request->size ?? 'M'; // Mặc định size M
        $user = Auth::user();
        return view('checkout', compact('product', 'size', 'user'));
    }

    // 2. Xử lý lưu đơn hàng
    public function placeOrder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->order_date = now();
        $order->total_money = $request->price;
        $order->status = 'Đang chờ';
        // Gộp địa chỉ
        $order->shipping_address = $request->address . ', ' . $request->ward . ', ' . $request->city;
        $order->save();

        $detail = new OrderDetail();
        $detail->order_id = $order->id;
        $detail->product_id = $request->product_id;
        $detail->quantity = 1;
        $detail->price = $request->price;
        $detail->save();

        return redirect()->route('cart')->with('success', 'Đặt hàng thành công!');
    }

    // 3. Mở trang Giỏ hàng
    public function cart()
    {
        // Lấy các đơn hàng của user đang đăng nhập
        $orders = Order::with('orderDetails.product')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('cart', compact('orders'));
    }

    // 4. Mở trang Sửa thông tin giao hàng
    public function edit($id)
    {
        $order = Order::with('orderDetails.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('checkout', compact('order')); // Tái sử dụng lại view checkout
    }

    // 5. Cập nhật thông tin
    public function update(Request $request, $id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->shipping_address = $request->address . ', ' . $request->ward . ', ' . $request->city;
        $order->save();

        return redirect()->route('cart')->with('success', 'Cập nhật thông tin giao hàng thành công!');
    }

    // 6. Hủy đơn
    public function destroy($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        $order->delete();
        return redirect()->route('cart')->with('success', 'Đã hủy đơn hàng!');
    }

    // 7. Trang Quản lý Doanh thu (Dành cho Admin)
    public function dashboard(Request $request)
    {
        // Chặn nếu không phải Admin
        if (Auth::user()->role != 1) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
        }

        // Khởi tạo câu truy vấn đơn hàng
        $query = Order::query();

        // ---------------------------------------------------
        // LÔ-GIC LỌC THEO NGÀY / TUẦN / THÁNG / QUÝ
        // ---------------------------------------------------
        $filter = $request->get('filter', 'all');
        $now = \Carbon\Carbon::now();

        if ($filter == 'day') {
            $query->whereDate('created_at', $now->today());
        } elseif ($filter == 'week') {
            $query->whereBetween('created_at', [$now->startOfWeek(), $now->endOfWeek()]);
        } elseif ($filter == 'month') {
            $query->whereMonth('created_at', $now->month)
                ->whereYear('created_at', $now->year);
        } elseif ($filter == 'quarter') {
            $query->whereBetween('created_at', [$now->copy()->firstOfQuarter(), $now->copy()->lastOfQuarter()]);
        }

        // Tính toán các con số tổng quan (dựa trên bộ lọc)
        $totalRevenue = $query->sum('total_money');
        $totalOrders = $query->count();

        // Tổng số khách hàng (Lấy tất cả user có role = 0, không bị ảnh hưởng bởi bộ lọc thời gian)
        $totalUsers = \App\Models\User::where('role', 0)->count();

        // Lấy 10 đơn hàng mới nhất
        $recentOrders = Order::orderBy('id', 'desc')->take(10)->get();

        return view('admin.dashboard', compact('totalRevenue', 'totalOrders', 'totalUsers', 'recentOrders', 'filter'));
    }

    // 8. Trang Lịch sử Order
    public function history()
    {
        $orders = Order::with('orderDetails.product')->where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('order-history', compact('orders'));
    }

    // 9. Trang Sản phẩm yêu thích (Lấy các sản phẩm khách đã mua)
    public function favorites()
    {
        // Lấy danh sách ID các sản phẩm người dùng đã mua
        $productIds = OrderDetail::whereHas('order', function ($q) {
            $q->where('user_id', Auth::id());
        })->pluck('product_id')->unique();

        // Lấy thông tin các sản phẩm đó
        $favorites = Product::whereIn('id', $productIds)->get();

        return view('favorites', compact('favorites'));
    }
}
