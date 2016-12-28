<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Buyer_Profiles extends Model
{
    protected $table = 'chart_buyer_profiles';

    protected $fillable = [
        'report_id',
        'Coupon Users',
        'DIYers',
        'Fashionistas',
        'Gamers',
        'Healthy and fit',
        'Foodies',
        'Outdoor enthusiasts',
        'Gadget enthusiast',
        'Trendy homemakers',
        'Sportsmen',
        'Green living',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}