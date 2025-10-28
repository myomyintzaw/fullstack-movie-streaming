<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
    //  * @var list<string>
     * @var array<int,string>

     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $appends=['is_show_ads'];

    public function getIsShowAdsAttribute(){
       if(Auth::check()){
        $today=date('Y-m-d');
        $user_remain_day=UserRemainDay::where('user_id',Auth::id())->first();
        if($user_remain_day){
            $expire_date=$user_remain_day->expire_date;
            if($expire_date>$today){
                return false;
            }
        }
       }
       return true;
    }

    /**
     * The attributes that should be hidden for serialization.
    //  *@var array<int,string>
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
