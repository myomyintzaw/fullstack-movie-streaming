<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieLike extends Model
{
    protected $fillable=['movie_id','user_id'];
}
