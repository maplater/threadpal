<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Parents extends Model
{
    protected $table = 'chart_parents';

    protected $fillable = [
        'report_id',
        'Parents',
        'Not Parents',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}