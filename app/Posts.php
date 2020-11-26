<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    
    protected $table = 'posts';
    
    protected $fillable = ['title','slug','content','is_published','user_id'];
    
    public function comments(){
        return $this->hasMany(Comments::class);
    }
}
