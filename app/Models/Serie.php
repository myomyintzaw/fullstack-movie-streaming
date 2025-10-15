<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'slug',
        'release_date',
        'name',
        'image',
        'description',
        'rating',
        'view_count',
    ];

    protected $appends=['rating_no'];

    public function getRatingNoAttribute(){
        return number_format($this->rating,1);
    }

    public function category()
    {
        // return $this->belongsToMany(Category::class,'category_serie');

        return $this->belongsToMany(Category::class, 'category_series', 'series_id', 'category_id');
    }

    public function episode(){
        return $this->hasMany(SerieEpisode::class,'series_id');
    }


    public function comment(){
        return $this->hasMany(SerieComment::class,'series_id');
    }
}
