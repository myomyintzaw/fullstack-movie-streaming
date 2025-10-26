<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRemainDay extends Model
{
    protected $fillable=[
        'user_id',
        'expire_date',
    ];
}
