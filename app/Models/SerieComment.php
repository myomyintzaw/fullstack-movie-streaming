<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SerieComment extends Model
{
    protected $fillable=['series_id','comment','user_id'];
    protected $appends=['day_ago'];

    public function getDayAgoAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function user(){
        return $this->belongsTo(User::class);

    }
}
