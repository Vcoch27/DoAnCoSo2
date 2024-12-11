<?php
// app/Models/UserResult.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_package_id',
        'cumulative_points',
        'percent',
        'user_choices',
        'completed_at',
    ];

    // Tạo mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tạo mối quan hệ với bảng QuestionPackage
    public function questionPackage()
    {
        return $this->belongsTo(QuestionPackage::class);
    }
}
