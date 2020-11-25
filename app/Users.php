<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users extends Model
{
    use Notifiable;
    
    protected $table = 'users';
    
    protected $fillable = ['username','name'];
    
    protected $hidden = ['api_token'];
    
}
