<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionPackage extends Model
{
    use HasFactory;

    protected $table = 'question_packages';

    protected $fillable = [
        'title',
        'author_id',
        'question_count',
        'images',
        'description',
        'rating',
        'attempt_count',
        'public',
    ];

    protected $casts = [
        'rating' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'public' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    // Trong model QuestionPackage
    public function user()
    {
        return $this->belongsTo(User::class);  // Liên kết với bảng user
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'package_tag', 'package_id', 'tag_id');
    }
    public function publicRequests()
    {
        return $this->hasMany(PublicRequest::class, 'package_id');
    }
}
