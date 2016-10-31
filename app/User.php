<?php

namespace App;
use App\Models\UserLevel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $connection = 'domain';
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    // protected $appends = ['user_level'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'username', 'lastname', 'firstname','middlename','notes',
        'email','password','level_id','lock'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // public function userLevel()
    // {
    //     return $this->belongsTo('App\Model\UserLevel');
    // }

    // public function getUserLevelAttribute()
    // {
    //     if(!is_null($this->userLevel))
    //         return $this->userLevel->level_name;
    //     return "";
    // }
}
