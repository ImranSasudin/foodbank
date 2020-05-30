<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods';

    protected $fillable = [
        'name', 'preferable'
    ];

    public function campaigns()
    {
        return $this->hasMany('App\RquiredFood');
    }

    public function transactions()
    {
        return $this->hasMany('App\FoodDonation');
    }
}

