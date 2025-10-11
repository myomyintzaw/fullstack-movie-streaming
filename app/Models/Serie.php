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

    public function category()
    {
        // return $this->belongsToMany(Category::class,'category_serie');

        return $this->belongsToMany(Category::class, 'category_series', 'series_id', 'category_id');
    }

    public function episode(){
        return $this->hasMany(SerieEpisode::class,'series_id');
    }
}
