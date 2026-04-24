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

    // Hiển thị form đổi mật khẩu
    public function changePasswordForm()
    {
        return view('change-password');
    }

    // Xử lý đổi mật khẩu
    public function changePassword(Request $request)
    {
        // 1. Kiểm tra dữ liệu đầu vào
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // confirmed yêu cầu phải có trường new_password_confirmation
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.'
        ]);

        // 2. Kiểm tra mật khẩu cũ có khớp trong database không
        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, \Illuminate\Support\Facades\Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác!');
        }

        // 3. Cập nhật mật khẩu mới
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());
        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Đổi mật khẩu thành công!');
    }

    // Hiển thị form thay đổi thông tin cá nhân
    public function editProfileForm()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('edit-profile', compact('user'));
    }

    // Xử lý Cập nhật thông tin
    public function updateProfile(Request $request)
    {
        $user = \App\Models\User::find(\Illuminate\Support\Facades\Auth::id());

        // Cập nhật dữ liệu từ form vào CSDL
        $user->full_name = $request->full_name;
        $user->phone = $request->phone;
        $user->ngay_sinh = $request->ngay_sinh;
        $user->tinh_thanh_pho = $request->tinh_thanh_pho;
        $user->phuong_xa = $request->phuong_xa;
        $user->dia_chi_chi_tiet = $request->dia_chi_chi_tiet;

        $user->save(); // Lưu lại

        // Chuyển hướng về trang Tài khoản và mang theo thông báo
        return redirect()->route('profile')->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }
}
