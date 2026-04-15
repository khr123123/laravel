<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'level',
        'category',
        'duration',
    ];

    /**
     * 获取该课程的学习进度记录
     */
    public function learningProgress(): HasMany
    {
        return $this->hasMany(LearningProgress::class);
    }
}
