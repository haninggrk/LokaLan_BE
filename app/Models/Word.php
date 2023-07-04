<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $fillable = [
        'word',
        'meaning',
        'description',
        'audio_path',
        'upvote',
        'downvote',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(UserRantau::class);
    }

    public function usageExamples()
    {
        return $this->hasMany(WordUsageExample::class);
    }
}
