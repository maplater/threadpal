<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Home_Ownership extends Model
{
    protected $table = 'chart_home_ownership';

    protected $fillable = [
        'report_id',
        'Renters',
        'Homeowners',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
