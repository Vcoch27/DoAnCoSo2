<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong cơ sở dữ liệu.
     */
    protected $table = 'notifications';

    /**
     * Các cột có thể gán dữ liệu hàng loạt.
     */
    protected $fillable = [
        'user_id',
        'title',
        'message',
        'type',
        'is_read',
    ];

    /**
     * Mối quan hệ với bảng User.
     * Mỗi thông báo thuộc về một người dùng.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
