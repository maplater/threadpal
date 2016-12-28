<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Store_Type extends Model
{
    protected $table = 'chart_store_type';

    protected $fillable = [
        'report_id',
        'Low-end department store',
        'High-end retail',
        'Department stores',
        'Luxury Store',
        'Gyms and fitness clubs',
        'Gift shops',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}