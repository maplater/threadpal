<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Sports_Profiles extends Model
{
    protected $table = 'chart_sports_profiles';

    protected $fillable = [
        'report_id',
        'Football',
        'Soccer',
        'Baseball',
        'Basketball',
        'Golf',
        'Skiing',
        'Tennis',
        'Mixed Martial Arts',
        'Auto Racing',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
