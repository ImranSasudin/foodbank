<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'employee_id', 'name', 'place', 'time', 'date'
    ];

    public function foods()
    {
        return $this->hasMany('App\RquiredFood');
    }
}
