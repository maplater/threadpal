<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart_Fitness_Profiles extends Model
{
    protected $table = 'chart_fitness_profiles';

    protected $fillable = [
        'report_id',
        'Bodybuilding',
        'Dieting',
        'Meditation',
        'Exercise',
        'Running',
        'Yoga',
        'total'
    ];

    public function report()
    {
        return $this->belongsTo('App\Report');
    }
}