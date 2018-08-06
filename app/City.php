<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'city',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
