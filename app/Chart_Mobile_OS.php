<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Mobile_OS extends Model
{
    protected $table = 'chart_mobile_os';

    protected $fillable = [
        'report_id',
        'iOS',
        'Android',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}