<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieEpisode extends Model
{
    protected $fillable=['slug','series_id','episode_no','embed_link'];

    public function serie(){
        return $this->belongsTo(Serie::class,'series_id','id',);
    }

}
