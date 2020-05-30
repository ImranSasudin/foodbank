<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded = ['id'];

    public function foods()
    {
        return $this->hasMany('App\FoodDonation');
    }
}
