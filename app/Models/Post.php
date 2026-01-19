<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'short_content', 
        'content', 
        'photo'
    ];  //To'ldirilishi mumkin bo'lgan columnlar...

    // protected $guarded = ['id'];  // To'ldirilishi mumkin bo'lmagan columnlar...
}
