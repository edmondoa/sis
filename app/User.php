<?php

namespace App;
use App\Models\UserLevel;
use App\Models\Branch;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //protected $connection = 'domain';
   // protected $this->getConnection();
    protected $table = 'user';
    protected $primaryKey = 'user_id';

     protected $appends = ['domain_name'];
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

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch');
    }

    public function domain()
    {
        return $this->belongsTo('App\Models\Domain');
    }

    // public function userLevel()
    // {
    //     return $this->belongsTo('App\Model\UserLevel');
    // }

    public function getDomainNameAttribute()
    {
        
        return "domain".$this->domain_id;
       
    }
}
