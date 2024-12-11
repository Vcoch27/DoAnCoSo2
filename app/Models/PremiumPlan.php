<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumPlan extends Model
{
    use HasFactory;

    // Các thuộc tính có thể gán
    protected $fillable = [
        'name',
        'price',
        'duration',
    ];

    // Nếu cần, bạn có thể thêm các quan hệ trong đây (ví dụ: giữa PremiumPlan và UserPremiumSubscription)
    public function userPremiumSubscriptions()
    {
        return $this->hasMany(UserPremiumSubscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
