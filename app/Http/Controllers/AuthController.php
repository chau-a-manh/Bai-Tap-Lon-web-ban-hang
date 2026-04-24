<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Xử lý Đăng ký
    public function register(Request $request)
    {
        // Tạo user mới vào CSDL
        $user = User::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'username' => $request->email, // Ở form bạn dùng Email làm tài khoản
            'password' => Hash::make($request->password), // Mã hóa mật khẩu
            'role' => 0 // Mặc định là khách hàng
        ]);

        // Đăng nhập luôn sau khi đăng ký thành công
        Auth::login($user);

        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }

    // 2. Xử lý Đăng nhập
    public function login(Request $request)
    {
        // Kiểm tra thông tin đăng nhập
        $credentials = [
            'username' => $request->login_id, // Lấy từ input 'Nhập email hoặc Tên đăng nhập'
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->back()->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->back()->with('error', 'Sai tên đăng nhập hoặc mật khẩu!');
    }

    // 3. Xử lý Đăng xuất
    public function logout()
    {
        Auth::logout();

        // Sửa lệnh redirect()->back() thành redirect('/') để về luôn trang chủ
        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công!');
    }
}
