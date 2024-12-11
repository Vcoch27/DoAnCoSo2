<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Mối quan hệ belongs-to-many với QuestionPackage.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questionPackages()
    {
        return $this->belongsToMany(QuestionPackage::class, 'package_tag', 'tag_id', 'package_id');
    }
}
