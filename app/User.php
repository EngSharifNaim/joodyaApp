<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




        
    public static function getUserInfo($id) 
    { 
		return User::find($id);
	}

    public static function getUserFullname($id) 
    { 
        $userinfo=User::find($id);

        return $userinfo->first_name.' '.$userinfo->last_name;
    }
    
    public static function getTotalUsers() 
    { 
        return User::where('usertype', '=', 'User')->count(); 
    }  
    
}
