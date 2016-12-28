<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Travel_Profiles extends Model
{
    protected $table = 'chart_travel_profiles';

    protected $fillable = [
        'report_id',
        'Frequent travelers',
        'Frequent flyers',
        'Business travelers',
        'Commuters',
        'International Travelers',
        'Domestic Travel',
        'Cruises',
        'Family vacations',
        'Timeshares',
        'Leisure travelers',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}