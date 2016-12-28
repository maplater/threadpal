<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Entertainment_Profiles extends Model
{
    protected $table = 'chart_entertainment_profiles';

    protected $fillable = [
        'report_id',
        'Video Games',
        'Live events',
        'Movies',
        'Music',
        'Reading',
        'TV',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}