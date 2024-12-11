<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'premium_plan_id',
        'app_trans_id',
        'amount',
        'payment_status',
        'zp_trans_token',
        'order_url',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function premiumPlan()
    {
        return $this->belongsTo(PremiumPlan::class);
    }
    public function userPremiumSubscription()
    {
        return $this->hasOne(UserPremiumSubscription::class, 'payment_id');
    }
}
