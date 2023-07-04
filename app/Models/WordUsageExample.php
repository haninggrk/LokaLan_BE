<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordUsageExample extends Model
{
    use HasFactory;
    protected $fillable = ['example', 'word_id'];

    public function word()
    {
        return $this->belongsTo(Word::class);
    }
}
