<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovieSave extends Model
{
    protected $fillable=['movie_id','user_id'];

    public function movie(){
        return $this->belongsTo(Movie::class,'movie_id','id');
    }   

}
