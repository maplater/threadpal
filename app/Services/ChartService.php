<?php

namespace App\Services;


use Khill\Lavacharts\Lavacharts;


class ChartService
{


    protected $chartGraph = array(
        'Chart_Gender' => array(
            'type' =>'PieChart',
            'percent_id' => 'chart_gender_percent',
            'index_id' => 'chart_gender_index',
            'title' => 'Gender',
            'options' => array(
                'title' => 'Gender',
                'height' => 300,
            ),
        ),
        'Chart_Age' => array(
            'type' =>'ColumnChart',
            'percent_id' => 'chart_age_percent',
            'index_id' => 'chart_age_index',
            'title' => 'Age',
            'options' => array(
                'title' => 'Age',
                'height' => 300,
            ),
        ),
        'Chart_Income' => array(
            'type' =>'ColumnChart',
            'percent_id' => 'chart_income_percent',
            'index_id' => 'chart_income_index',
            'title' => 'Household Income',
            'options' => array(
                'title' => 'Household Income',
                'height' => 300,
            ),
        ),
        'Chart_Ethnicity' => array(
            'type' =>'DonutChart',
            'percent_id' => 'chart_ethnicity_percent',
            'index_id' => 'chart_ethnicity_index',
            'title' => 'Minority Report',
            'options' => array(
                'title' => 'Minority Report',
                'height' => 300,
            ),
        ),
        'Chart_Education' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_education_percent',
            'index_id' => 'chart_education_index',
            'title' => 'Education',
            'options' => array(
                'title' => 'Education',
                'height' => 300,
            ),
        ),
        'Chart_Relationship' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_relationship_percent',
            'index_id' => 'chart_relationship_index',
            'title' => 'Relationships',
            'options' => array(
                'title' => 'Relationships',
                'height' => 300,
            ),
        ),
        'Chart_Sexuality' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_sexuality_percent',
            'index_id' => 'chart_sexuality_index',
            'title' => 'Sexuality',
            'options' => array(
                'title' => 'Sexuality',
                'height' => 300,
            ),
        ),
        'Chart_Home_Ownership' => array(
            'type' =>'PieChart',
            'percent_id' => 'chart_home_ownership_percent',
            'index_id' => 'chart_home_ownership_index',
            'title' => 'Home Ownership',
            'options' => array(
                'title' => 'Home Ownership',
                'height' => 300,
            ),
        ),
        'Chart_Parents' => array(
            'type' =>'ColumnChart',
            'percent_id' => 'chart_parents_percent',
            'index_id' => 'chart_parents_index',
            'title' => 'Parents',
            'options' => array(
                'title' => 'Parents',
                'height' => 300,
            ),
        ),
        'Chart_Politics' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_politics_percent',
            'index_id' => 'chart_politics_index',
            'title' => 'Politics',
            'options' => array(
                'title' => 'Politics',
                'height' => 300,
            ),
        ),
        'Chart_Mobile_OS' => array(
            'type' =>'PieChart',
            'percent_id' => 'chart_mobile_os_percent',
            'index_id' => 'chart_mobile_os_index',
            'title' => 'Mobile Operating System',
            'options' => array(
                'title' => 'OS',
                'height' => 300,
            ),
        ),
        'Chart_US_Geo' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_us_geo_percent',
            'index_id' => 'chart_us_geo_index',
            'title' => 'US Map',
            'options' => array(
                'title' => 'US Map',
                'height' => 2000,

            ),
        ),
        'Chart_Buyer_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_buyer_profiles_percent',
            'index_id' => 'chart_buyer_profiles_index',
            'title' => 'Buyer Profiles',
            'options' => array(
                'title' => 'Buyer Profiles',
                'height' => 300,
            ),
        ),
        'Chart_Store_Type' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_store_type_percent',
            'index_id' => 'chart_store_type_index',
            'title' => 'Store Type',
            'options' => array(
                'title' => 'Store Type',
                'height' => 300,
            ),
        ),
        'Chart_Travel_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_travel_profiles_percent',
            'index_id' => 'chart_travel_profiles_index',
            'title' => 'Travel Profiles',
            'options' => array(
                'title' => 'Travel Profiles',
                'height' => 300,
            ),
        ),
        'Chart_Entertainment_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_entertainment_profiles_percent',
            'index_id' => 'chart_entertainment_profiles_index',
            'title' => 'Entertainment Profiles',
            'options' => array(
                'title' => 'Entertainment Profiles',
                'height' => 300,
            ),
        ),
        'Chart_Fitness_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_fitness_profiles_percent',
            'index_id' => 'chart_fitness_profiles_index',
            'title' => 'Fitness Profiles',
            'options' => array(
                'title' => 'Fitness Profiles',
                'height' => 300,
            ),
        ),
        'Chart_Food_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_food_profiles_percent',
            'index_id' => 'chart_food_profiles_index',
            'title' => 'Food & Drink Profiles',
            'options' => array(
                'title' => 'Food & Drink Profiles',
                'height' => 300,
            ),
        ),
        'Chart_Sports_Profiles' => array(
            'type' =>'BarChart',
            'percent_id' => 'chart_sports_profiles_percent',
            'index_id' => 'chart_sports_profiles_index',
            'title' => 'Sports Profiles',
            'options' => array(
                'title' => 'Sports Profiles',
                'height' => 300,
            ),
        )

    );



    public function getCharts($data)
    {

        foreach($data as $chartName => $dataTypeArray)
        {

            foreach($dataTypeArray as $dataType => $traits)
            {
                /*if($chartName == 'Chart_US_Geo')
                {
                    if($dataType == 'index') {
                        $charts[$chartName][$dataType] = $this->getgeoChart($chartName, $traits);
                    }

                }else{

                    $function = 'get' . $dataType . 'Chart';

                    $charts[$chartName][$dataType] = $this->$function($chartName, $traits);

                }*/

                $function = 'get' . $dataType . 'Chart';

                $charts[$chartName][$dataType] = $this->$function($chartName, $traits);



            }
        }

        return $charts;
    }

    public function getgeoChart($chartName, $traits)
    {
        //$lava = new Lavacharts();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartName)
            ->addNumberColumn('Index');

        foreach($traits as $trait => $value)
        {
            $table->addRow([$trait, $value]);
        }

        \Lava::BarChart($this->chartGraph[$chartName]['index_id'],$table,[

            'title' => 'Over / Under Index',
            'legend' => [
                'position' => 'none'
            ],
            'height' => $this->chartGraph[$chartName]['options']['height'],
        ]);

        $render = \Lava::render('BarChart',$this->chartGraph[$chartName]['index_id'],$this->chartGraph[$chartName]['index_id']);

        return $render;

    }

    public function getgeoChart2($chartName, $dataTypeArray)
    {


        $rows[0] = array();
        $percentArray = array();
        $indexArray = array();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartName)
            ->addNumberColumn('Population')
            ->addNumberColumn('Index');

        foreach($dataTypeArray as $dataType => $traits)
        {
            $count = 0;

            foreach($traits as $trait => $value)
            {

                if($dataType == 'percent')
                {

                    $percentArray[] = $value;
                    $rows[$count] = array($trait, $value);
                    $count++;

                }else{

                    $indexArray[] = $value;
                    array_push($rows[$count],$value);
                    $count++;

                }

            }

        }

        foreach($rows as $row)
        {
            $table->addRow($row);
        }

        \Lava::Geochart($this->chartGraph[$chartName]['index_id'],$table,[
            'title' => 'US City Chart',
            'legend' => [
                'position' => 'none'
            ],
            'height' => 600,
            'options' => array(
                'sizeAxis' => array(
                    'minValue' => min($indexArray),
                    'maxValue' => max($indexArray)
                ),
                'displayMode' => 'markers',
                'colorAxis' => array(
                    'colors' => array(
                        'blue',
                        'red'
                    )
                ),

            ),
        ]);

        $render = \Lava::render('GeoChart',$this->chartGraph[$chartName]['index_id'],$this->chartGraph[$chartName]['index_id']);

        return $render;

    }

    public function getpercentChart($chartName, $traits)
    {
        //$lava = new Lavacharts();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartName)
            ->addNumberColumn($this->chartGraph[$chartName]['title']);

        foreach($traits as $trait => $value)
        {
            $table->addRow([$trait, $value]);
        }

        $type = $this->chartGraph[$chartName]['type'];

        \Lava::$type($this->chartGraph[$chartName]['percent_id'],$table, $this->chartGraph[$chartName]['options']);

        return \Lava::render($this->chartGraph[$chartName]['type'],$this->chartGraph[$chartName]['percent_id'],$this->chartGraph[$chartName]['percent_id']);
    }



    public function getindexChart($chartName, $traits)
    {
        //$lava = new Lavacharts();

        $table = \Lava::DataTable();

        $table->addStringColumn($chartName)
            ->addNumberColumn('Index');

        foreach($traits as $trait => $value)
        {
            $table->addRow([$trait, $value]);
        }

        \Lava::BarChart($this->chartGraph[$chartName]['index_id'],$table,[

            'title' => 'Over / Under Index',
            'legend' => [
                'position' => 'none'
            ],
            'height' => $this->chartGraph[$chartName]['options']['height'],
        ]);

        $render = \Lava::render('BarChart',$this->chartGraph[$chartName]['index_id'],$this->chartGraph[$chartName]['index_id']);

        return $render;

    }

}