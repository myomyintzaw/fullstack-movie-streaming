<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','slug'];

    public function movie(){
        return $this->belongsToMany(Movie::class);
    }

    public function serie(){
        // return $this->belongsToMany(Serie::class,'category_series');

        return $this->belongsToMany(Serie::class,'category_series','category_id','series_id');
    }
}
