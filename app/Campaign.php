<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Campaign extends Model
{
    protected $table = 'campaigns';

    protected $fillable = [
        'employee_id', 'name', 'place', 'time', 'date'
    ];

    public function foods()
    {
        return $this->hasMany('App\RequiredFood');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'employee_id', 'id');
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
