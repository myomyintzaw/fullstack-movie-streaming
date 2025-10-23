<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuyPackage extends Model
{
    protected $fillable=[
        'payment_name',
        'payment_no',
        'payment_image',
        'package_total_day',
        'package_price',
        'package_name',
        'status',
    ];
}
