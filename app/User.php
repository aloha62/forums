<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    protected $table = 'users';
    
    protected $fillable = ['username','name','api_token'];
    
    protected $hidden = ['api_token'];
    
}
