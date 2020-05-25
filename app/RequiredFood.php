<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequiredFood extends Model
{
    protected $table = 'required_food';

    protected $guarded = ['id'];

    public function food()
    {
        return $this->belongsTo('App\Food','food_id','id');

    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign','campaign_id','id');

    }
}
