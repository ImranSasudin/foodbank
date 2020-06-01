<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded = ['id'];

    public function foods()
    {
        return $this->hasMany('App\FoodDonation');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    function format_time($time)
    {
        return Carbon::parse($time)->format('h:i A');
    }

    function format_date($date)
    {
        return Carbon::parse($date)->format('d F, Y');
    }
}
