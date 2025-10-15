<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable=['slug','release_date','name','image','description','embed_link','rating','view_count'];
    protected $appends=['rating_no','release_year'];

    public function getRatingNoAttribute(){
        return number_format($this->rating,1);
    }

    public function getReleaseYearAttribute(){
        return date('Y', strtotime($this->release_date));
    }

    public function category(){
        return $this->belongsToMany(Category::class);
    }

    public function comment(){
        return $this->hasMany(movie_comment::class,'movie_id');
    }
}
