<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Các trường cho phép thêm dữ liệu hàng loạt (Fix lỗi MassAssignmentException)
     */
    protected $fillable = [
        'username',
        'password',
        'full_name',
        'phone',
        'address',
        'role',
    ];

    /**
     * Các trường cần được ẩn đi khi truy vấn (Bảo mật mật khẩu)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tự động ép kiểu dữ liệu (Mã hóa mật khẩu)
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Mối quan hệ: Một người dùng có nhiều đơn hàng
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
