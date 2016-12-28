<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Politics extends Model
{
    protected $table = 'chart_politics';

    protected $fillable = [
        'report_id',
        'Very Liberal',
        'Liberal',
        'Moderate',
        'Conservative',
        'Very Conservative',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}