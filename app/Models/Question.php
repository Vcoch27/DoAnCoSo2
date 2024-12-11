<?php

namespace App\Models;

use App\Events\QuestionCountUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'question_package_id',
        'question_text',
    ];

    public function questionPackage()
    {
        return $this->belongsTo(QuestionPackage::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    protected static function booted()
    {
        static::created(function ($question) {
            event(new QuestionCountUpdated($question->questionPackage));
        });

        static::deleted(function ($question) {
            event(new QuestionCountUpdated($question->questionPackage));
        });
    }
}
