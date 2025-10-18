<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{

    protected $fillable = ['slug', 'release_date', 'name', 'image', 'description', 'embed_link', 'rating', 'view_count'];
    protected $appends = ['rating_no', 'release_year', 'embed_player'];

    public function getEmbedPlayerAttribute()
    {
        return 'https://davioad.com/e/' . $this->embed_link;
    }

    public function getRatingNoAttribute()
    {
        return number_format($this->rating, 1);
    }

    public function getReleaseYearAttribute()
    {
        return date('Y', strtotime($this->release_date));
    }

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

    public function comment()
    {
        return $this->hasMany(movie_comment::class, 'movie_id');
    }

    public function like()
    {
        return $this->hasMany(MovieLike::class);
    }

    public function movieSave()
    {
        return $this->hasMany(MovieSave::class);
    }
}
