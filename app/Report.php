<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';

    protected $fillable = [
        'type',
        'name',
        'keywords',
        'slug'
    ];

    public function Chart_Gender()
    {
        return $this->hasOne('App\Chart_Gender');
    }
    public function Chart_Age()
    {
        return $this->hasOne('App\Chart_Age');
    }
    public function Chart_Income()
    {
        return $this->hasOne('App\Chart_Income');
    }
    public function Chart_Ethnicity()
    {
        return $this->hasOne('App\Chart_Ethnicity');
    }
    public function Chart_Education()
    {
        return $this->hasOne('App\Chart_Education');
    }
    public function Chart_Relationship()
    {
        return $this->hasOne('App\Chart_Relationship');
    }
    public function Chart_US_Geo()
    {
        return $this->hasOne('App\Chart_US_Geo');
    }
    public function Chart_Sexuality()
    {
        return $this->hasOne('App\Chart_Sexuality');
    }
    public function Chart_Home_Ownership()
    {
        return $this->hasOne('App\Chart_Home_Ownership');
    }

    public function Chart_Parents()
    {
        return $this->hasOne('App\Chart_Parents');
    }
    public function Chart_Politics()
    {
        return $this->hasOne('App\Chart_Politics');
    }
    public function Chart_Mobile_OS()
    {
        return $this->hasOne('App\Chart_Mobile_OS');
    }
    public function Chart_Buyer_Profiles()
    {
        return $this->hasOne('App\Chart_Buyer_Profiles');
    }
    public function Chart_Store_Type()
    {
        return $this->hasOne('App\Chart_Store_Type');
    }
    public function Chart_Travel_Profiles()
    {
        return $this->hasOne('App\Chart_Travel_Profiles');
    }
    public function Chart_Entertainment_Profiles()
    {
        return $this->hasOne('App\Chart_Entertainment_Profiles');
    }
    public function Chart_Fitness_Profiles()
    {
        return $this->hasOne('App\Chart_Fitness_Profiles');
    }
    public function Chart_Food_Profiles()
    {
        return $this->hasOne('App\Chart_Food_Profiles');
    }
    public function Chart_Sports_Profiles()
    {
        return $this->hasOne('App\Chart_Sports_Profiles');
    }
}
