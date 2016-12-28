<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Food_Profiles extends Model
{
    protected $table = 'chart_food_profiles';

    protected $fillable = [
        'report_id',
        'Beer',
        'Distilled Spirits',
        'Wine',
        'Coffee',
        'Cooking',
        'Vegetarian',
        'Vegan',
        'Fast Food',
        'Organic Food',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}