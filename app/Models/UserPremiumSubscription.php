<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPremiumSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'payment_id',
        'premium_plan_id',
        'status',
        'start_date',
        'end_date',
        'amount',
        'app_trans_id'
    ];

    protected $primaryKey = 'id'; // Khóa chính mặc định
    protected $keyType = 'int';    // Chỉ rõ rằng đây là kiểu số nguyên
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function premiumPlan()
    {
        return $this->belongsTo(PremiumPlan::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
