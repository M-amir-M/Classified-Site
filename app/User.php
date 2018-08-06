<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'email', 'password', 'phone', 'token'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function owns($relation)
    {
        return $relation->user_id == $this->id;
    }
    
}
