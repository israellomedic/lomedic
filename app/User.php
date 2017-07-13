<?php

<<<<<<< HEAD
namespace abisa;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $guard = 'abisa';
    
    protected $table = 'adm_usuario';
    
    /** The attributes that are mass assignable. **/
    protected $fillable = ['name', 'email', 'password', 'job_title',];
    
    /** The attributes that should be hidden for arrays. **/ 
    protected $hidden = ['password', 'remember_token',];
=======
namespace App;

use Illuminate\Notifications\Notifiable;
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
>>>>>>> branch 'develop' of https://github.com/israellomedic/lomedic
}
