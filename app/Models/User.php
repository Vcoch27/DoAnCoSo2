<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table  = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cumulative',
        'is_premium',
        'daily_limit',
        'role',
        'bio',
        'avatar',
        'google_id',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_premium' => 'boolean',
        'daily_limit' => 'integer',
    ];



    /**
     * Kiểm tra xem người dùng có phải là premium hay không.
     *
     * @return bool
     */

    public function getIsPremiumAttribute()
    {
        return $this->attributes['is_premium'] == 1;  // Giả sử is_premium là 1 cho người trả phí
    }

    public function getDailyLimitAttribute()
    {
        return $this->attributes['daily_limit'];
    }


    /**
     * Giảm daily_limit sau mỗi hành động của người dùng (nếu không phải premium).
     *
     * @return void
     */
    public function decrementDailyLimit(): void
    {
        if (!$this->getIsPremiumAttribute() && $this->daily_limit > 0) {
            $this->decrement('daily_limit');
        }
    }

    /**
     * Relationship with QuestionPackage model.
     */
    public function questionPackages()
    {
        return $this->hasMany(QuestionPackage::class, 'author_id'); // Thay 'owner_id' bằng tên cột thực tế
    }

    // app/Models/User.php

    public function premiumSubscriptions()
    {
        return $this->hasMany(UserPremiumSubscription::class);
    }

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }
    public function hasActivePremium(): bool
    {
        return $this->premiumSubscriptions()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->exists();
    }
    public function publicRequests()
    {
        return $this->hasMany(PublicRequest::class, 'requested_by');
    }
}
