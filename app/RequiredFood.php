<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Food;
use App\Campaign;
use DB;

class RequiredFood extends Model
{
    protected $table = 'required_food';

    protected $guarded = ['id'];

    // protected $attributes = ['status'];

    public function food()
    {
        return $this->belongsTo('App\Food','food_id','id');

    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign','campaign_id','id');

    }

    public function getStatusAttribute($value) {

        $food = Food::find($this->food_id);
        $requiredFood = DB::table('required_food')
                        ->join('campaigns', 'required_food.campaign_id', '=', 'campaigns.id')
                        ->where('food_id', $this->food_id)
                        ->where('campaigns.date', '<=', $this->campaign()->first()->date)
                        ->sum('required_quantity');

        $balanceFood = $food->quantity - $requiredFood;

        if($balanceFood >= 0){
            $status = 'enough';
        } else{
            $status = 'notEnough';
        }
        
        return $status;
     }
}
