<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_US_Geo extends Model
{
    protected $table = 'chart_US_Geo';

    protected $fillable = [
        'New York',
        'Albuquerque',
        'Atlanta',
        'Austin',
        'Baltimore',
        'Boston',
        'Charlotte',
        'Chicago',
        'Cleveland',
        'Colorado Springs',
        'Columbus',
        'Dallas',
        'Denver',
        'Detroit',
        'El Paso',
        'Fort Worth',
        'Fresno',
        'Houston',
        'Indianapolis',
        'Jacksonville',
        'Kansas City',
        'Las Vegas',
        'Long Beach',
        'Los Angeles',
        'Louisville',
        'Memphis',
        'Mesa',
        'Miami',
        'Milwaukee',
        'Minneapolis',
        'Nashville',
        'New Orleans',
        'Oakland',
        'Oklahoma City',
        'Omaha',
        'Philadelphia',
        'Phoenix',
        'Portland',
        'Raleigh',
        'Sacramento',
        'San Antonio',
        'San Diego',
        'San Francisco',
        'San Jose',
        'Seattle',
        'Tucson',
        'Tulsa',
        'Virginia Beach',
        'Washington',
        'Wichita',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}
