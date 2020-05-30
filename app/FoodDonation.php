<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodDonation extends Model
{
    protected $table = 'food_donations';

    protected $guarded = ['id'];

    public function food()
    {
        return $this->belongsTo('App\Food','food_id','id');

    }

    public function transaction()
    {
        return $this->belongsTo('App\Transaction','transaction_id','id');

    }
}
