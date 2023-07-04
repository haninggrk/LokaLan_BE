<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRantau extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'username', 'password', 'profile_picture'];

}
