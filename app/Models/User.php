<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ADMIN = 'ADMIN';
    const MANAGER = 'MANAGER';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname','email', 'password', 'phone', 'role', 'gender'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'api_token',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
    * primary key
    */
    protected $primaryKey = "id";

   


    public function __construct(array $attributes = array()) {
         parent::__construct($attributes);
    }

   
    /**
     * Get the posts for the user.
     */

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * Return true if user is an admin
     *
     * @return true
     */
    public function isSuperAdmin()
    {
       
       return $this->role == self::ADMIN;
    }

    /**
     * Return true if user is a manger
     *
     * @return true
     */
    public function isManager()
    {
       return $this->role == self::MANAGER;
    }


  
}
