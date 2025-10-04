<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable=['slug','release_date','name','image','description','embed_link','rating','view_count'];

    public function category(){
        return $this->belongsToMany(Category::class);
    }
}
