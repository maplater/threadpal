<?php

namespace App\Services;





class ReachService
{

    public function Chart_Gender($keywordName = NULL, $keywordId = NULL)
    {
        $traits = array(
            'total'=> array(1,2),
            'male' => array(1),
            'female' => array(2)
        );

        foreach ($traits as $key => $value) {

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'genders' =>
                    $value
            ,
                'age_min' => 13,

            );

            if (isset($keywordId)) {
                $targeting_spec['interests'] = array(array(
                    'id' => $keywordId,
                    'name' => $keywordName,
                ));
            }
        }
    }
}