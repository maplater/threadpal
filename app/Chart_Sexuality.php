<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Sexuality extends Model
{
    protected $table = 'chart_sexuality';

    protected $fillable = [
        'report_id',
        'Straight Men',
        'Straight Women',
        'Gay Men',
        'Gay Women',
        'Bisexual Men',
        'Bisexual Women',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}