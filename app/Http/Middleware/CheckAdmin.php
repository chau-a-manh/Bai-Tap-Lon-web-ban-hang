<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu đã đăng nhập VÀ role == 1 (Admin) thì cho đi tiếp
        if (Auth::check() && Auth::user()->role == 1) {
            return $next($request);
        }

        // Nếu là khách hàng (role 0) thì đuổi về trang chủ kèm thông báo
        return redirect('/')->with('error', 'Bạn không có quyền truy cập khu vực Quản trị!');
    }
}
