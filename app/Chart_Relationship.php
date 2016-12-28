<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Relationship extends Model
{
    protected $table = 'chart_relationship';

    protected $fillable = [
        'report_id',
        'Single',
        'In a Relationship',
        'Married',
        'Engaged',
        'In a Civil Union',
        'In a Domestic Partnership',
        'In an Open Relationship',
        'Separated',
        'Divorced',
        'Widowed',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
