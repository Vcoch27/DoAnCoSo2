<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicRequest extends Model
{
    use HasFactory;

    protected $fillable = ['package_id', 'requested_by', 'status'];

    /**
     * Liên kết với model QuestionPackage.
     */
    public function package()
    {
        return $this->belongsTo(QuestionPackage::class, 'package_id');
    }

    /**
     * Liên kết với model User (người yêu cầu public).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
