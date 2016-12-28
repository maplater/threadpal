<?php

namespace App\Repositories;

use FacebookAds\Api;
use App\Services\ConnectionService;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\ReachEstimateFields;
use FacebookAds\Object\Values\OptimizationGoals;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use App\Services\TokenService;

use Illuminate\Support\Facades\Log;

class ChartRepository{

    protected $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function getChartData($reportId, $chart)
    {
        $chart = strtolower($chart);

        return DB::table($chart)->where('report_id',$reportId)->first();
    }




    public function Chart_Gender($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(1,2),
            'male' => array(1),
            'female' => array(2)
        );

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'genders' =>
                    $value
                ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                'id'=> $keywordId,
                ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection);

        return $reach;
    }

    public function Chart_Gender2($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(1,2),
            'male' => array(1),
            'female' => array(2)
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'genders' =>
                    $value
            ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec['interests'] = array(array(
                    'id'=> $keywordId,
                    'name'=> $keywordName,
                ));
            }

            $reach_estimate = $account->getReachEstimate(
                array(),
                array(
                    'currency' => 'USD',
                    'optimize_for' => OptimizationGoals::OFFSITE_CONVERSIONS,
                    'targeting_spec' => $targeting_spec,
                ))->getData();

            $reach[$key] = $reach_estimate['users'];

        }
        return $reach;
    }



    public function Chart_Age($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            '13 to 19' => array('min' => 13, 'max' => 19),
            '20 to 24' => array('min' => 20, 'max' => 24),
            '25 to 29' => array('min' => 25, 'max' => 29),
            '30 to 34' => array('min' => 30, 'max' => 34),
            '35 to 39' => array('min' => 35, 'max' => 39),
            '40 to 44' => array('min' => 40, 'max' => 44),
            '45 to 49' => array('min' => 45, 'max' => 49),
            '50 to 54' => array('min' => 50, 'max' => 54),
            '55 to 59' => array('min' => 55, 'max' => 59),
            '60 to 64' => array('min' => 60, 'max' => 64),
            '65 and older' => array('min' => 65, 'max' => NULL),
            'total' => array('min' => 13, 'max' => NULL)
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => $value['min'],
                'age_max' => $value['max'],

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection);

        return $reach;

    
    }

    public function Chart_Income($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {



        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            '30K to 40K' => array('id' => 6018510070532, 'name' => '$30,000 - $40,000'),
            '40K to 50K' => array('id' => 6018510087532, 'name' => '$40,000 - $50,000'),
            '50K to 75K' => array('id' => 6018510122932, 'name' => '$50,000 - $75,000'),
            '75K to 100K' => array('id' => 6018510100332, 'name' => '$75,000 - $100,000'),
            '100K to 125K' => array('id' => 6018510083132, 'name' => '$100,000 - $125,000'),
            '125K to 150K' => array('id' => 6017897162332, 'name' => '$125,000 - $150,000'),
            '150K to 250K' => array('id' => 6017897374132, 'name' => '$150,000 - $250,000'),
            '250K to 350K' => array('id' => 6017897397132, 'name' => '$250,000 - $350,000'),
            '350K to 500K' => array('id' => 6017897416732, 'name' => '$350,000 - $500,000'),
            'Over 500K' => array('id' => 6017897439932, 'name' => 'Over $500,000')
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'income' => array(
                    'id'=> $value['id']

                ),

            );


            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Ethnicity($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {

        $total_reach = 0;
        $other = 0;

        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Hispanic' => array('id' => 6003133212372, 'name' => 'Hispanic (US - All)'),
            'Asian American' => array('id' => 6021722613183, 'name' => 'Asian American (US)'),
            'African American' => array('id' => 6018745176183, 'name' => 'African American (US)'),
            'Other' => NULL,
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );
            if(isset($value))
            {
                $targeting_spec = $targeting_spec + array(
                        'ethnic_affinity' => array(
                    'id' => $value['id'],

                ));
            }

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1,'Other');

        return $reach;
    }

    public function Chart_Education($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(13,1,4,5,2,3,8,7,9,10,11),
            'Some High School' => array(13),
            'In High School' => array(1),
            'High School Grad' => array(4),
            'Some College' => array(5),
            'In College' => array(2),
            'College Graduate' => array(3),
            'Some Grad School' => array(8),
            'In Grad School' => array(7),
            'Master Degree' => array(9),
            'Professional Degree' => array(10),
            'Doctorate Degree' => array(11)

        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'education_statuses' =>
                    $value
                ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection);

        return $reach;
    }

    public function Chart_Relationship($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'total'=> array(1,2,3,4,7,8,9,11,12,13),
            'Single' => array(1),
            'In a Relationship' => array(2),
            'Married' => array(3),
            'Engaged' => array(4),
            'In a Civil Union' => array(7),
            'In a Domestic Partnership' => array(8),
            'In an Open Relationship' => array(9),
            'Separated' => array(11),
            'Divorced' => array(12),
            'Widowed' => array(13)
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),
                'relationship_statuses' =>
                    $value
            ,
                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection);

        return $reach;
    }

    public function Chart_Sexuality($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Straight Men'=> array('genders' => [1], 'interested_in' => [2]),
            'Straight Women' => array('genders' => [2], 'interested_in' => [1]),
            'Gay Men'=> array('genders' => [1], 'interested_in' => [1]),
            'Gay Women' => array('genders' => [2], 'interested_in' => [2]),
            'Bisexual Men'=> array('genders' => [1], 'interested_in' => [3]),
            'Bisexual Women' => array('genders' => [2], 'interested_in' => [3])
        );

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                "geo_locations" => array(
                    "countries" => ["US"],
                ),


                "age_min" => 13,

            ) + $value;

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection,1);

        return $reach;
    }

    public function Chart_Home_Ownership($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Renters' => array('id' => 6006371327132, 'name' => 'Renters'),
            'Homeowners' => array('id' => 6009989303132, 'name' => 'Homeowners'),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'home_ownership' => array(
                    'id'=> $value['id']

                ),

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Parents($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {

        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Parents' => array('id' => 6002714398372, 'name' => 'Parents (All)'),
            'Not Parents' => NULL,
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );
            if(isset($value))
            {
                $targeting_spec = $targeting_spec + array(
                        'family_statuses' => array(
                            'id' => $value['id'],

                        ));
            }

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Politics($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Very Liberal' => array('id' => 6015759997983, 'name' => 'Very Liberal'),
            'Liberal' => array('id' => 6015760027783, 'name' => 'Liberal'),
            'Moderate' => array('id' => 6015760036783, 'name' => 'Moderate'),
            'Conservative' => array('id' => 6015760532183, 'name' => 'Conservative'),
            'Very Conservative' => array('id' => 6015762142783, 'name' => 'Very Conservative'),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'politics' => array(
                    'id'=> $value['id']

                ),

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Mobile_OS($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'iOS' => array('iOS'),
            'Android' => array('Android'),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'user_os' =>
                    $value,

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Buyer_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Coupon Users' => array('id' => 6031038615282, 'name' => 'Coupon Users'),
            'DIYers' => array('id' => 6006520980825, 'name' => 'DIYers'),
            'Fashionistas' => array('id' => 6006520991825, 'name' => 'Fashionistas'),
            'Gamers' => array('id' => 6006096691825, 'name' => 'Gamers'),
            'Healthy and fit' => array('id' => 6006520977625, 'name' => 'Healthy and fit'),
            'Foodies' => array('id' => 6006520978625, 'name' => 'Coupon Users'),
            'Outdoor enthusiasts' => array('id' => 6006520999225, 'name' => 'Outdoor enthusiasts'),
            'Gadget enthusiast' => array('id' => 6006521021425, 'name' => 'Gadget enthusiast'),
            'Trendy homemakers' => array('id' => 6006521021825, 'name' => 'Trendy homemakers'),
            'Sportsmen' => array('id' => 6006521022825, 'name' => 'Sportsmen'),
            'Green living' => array('id' => 6010085119732, 'name' => 'Green living'),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'behaviors' => array(
                    'id'=> $value['id']

                ),

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }
    public function Chart_Store_Type($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Low-end department store' => array('id' => 6006371376932),
            'High-end retail' => array('id' => 6006371378532),
            'Department stores' => array('id' => 6029152103625),
            'Luxury Store' => array('id' => 6030640264082),
            'Gyms and fitness clubs' => array('id' => 6037141606025),
            'Gift shops' => array('id' => 6039761529825),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'behaviors' => array(
                    'id'=> $value['id']

                ),

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Travel_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Frequent travelers' => array('id' => 6002714895372),
            'Frequent flyers' => array('id' => 6006299712225),
            'Business travelers' => array('id' => 6007101597783),
            'Commuters' => array('id' => 6013516370183),
            'International Travelers' => array('id' => 6006299711025),
            'Domestic Travel' => array('id' => 6006299711225),
            'Cruises' => array('id' => 6006299711825),
            'Family vacations' => array('id' => 6006299712025),
            'Timeshares' => array('id' => 6006299712425),
            'Leisure travelers' => array('id' => 6006521036425),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,
                'behaviors' => array(
                    'id'=> $value['id']

                ),

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Entertainment_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Video Games' => array('id' => 6003940339466),
            'Live events' => array('id' => 6010924093432),
            'Movies' => array('id' => 6003139266461),
            'Music' => array('id' => 6003020834693),
            'Reading' => array('id' => 6002991736368),
            'TV' => array('id' => 6003172932634),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );

            if(isset($keywordId))
            {
                $valueId = $value['id'];

                $valueId = "$valueId";

                $interest_spec = array(
                    'flexible_spec' => array(
                        array(
                            'interests' => array(
                                array(
                                'id' => (int)$valueId,
                                ),
                            )
                        ),
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$keywordId,
                                ),
                            )
                        )

                    )
                );


                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));

            }else{

                $interest_spec = array(
                    'interests' => array(
                        'id'=> $value['id'],
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }

        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Fitness_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Bodybuilding' => array('id' => 6003648059946),
            'Dieting' => array('id' => 6003327856180),
            'Meditation' => array('id' => 6003012185129),
            'Exercise' => array('id' => 6004115167424),
            'Running' => array('id' => 6003397496347),
            'Yoga' => array('id' => 6003306084421),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );

            if(isset($keywordId))
            {
                $valueId = $value['id'];

                $valueId = "$valueId";

                $interest_spec = array(
                    'flexible_spec' => array(
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$valueId,
                                ),
                            )
                        ),
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$keywordId,
                                ),
                            )
                        )

                    )
                );


                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));

            }else{

                $interest_spec = array(
                    'interests' => array(
                        'id'=> $value['id'],
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_Food_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Beer' => array('id' => 6003012461997),
            'Distilled Spirits' => array('id' => 6003146729229),
            'Wine' => array('id' => 6003148544265),
            'Coffee' => array('id' => 6003626773307),
            'Cooking' => array('id' => 6003659420716),
            'Vegetarian' => array('id' => 6003155333705),
            'Vegan' => array('id' => 6003641846820),
            'Fast Food' => array('id' => 6004037400009),
            'Organic Food' => array('id' => 6002868910910),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );

            if(isset($keywordId))
            {
                $valueId = $value['id'];

                $valueId = "$valueId";

                $interest_spec = array(
                    'flexible_spec' => array(
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$valueId,
                                ),
                            )
                        ),
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$keywordId,
                                ),
                            )
                        )

                    )
                );


                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));

            }else{

                $interest_spec = array(
                    'interests' => array(
                        'id'=> $value['id'],
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }
    public function Chart_Sports_Profiles($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {


        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'Football' => array('id' => 6003376089674),
            'Soccer' => array('id' => 6003107902433),
            'Baseball' => array('id' => 6003087413192),
            'Basketball' => array('id' => 6003369240775),
            'Golf' => array('id' => 6003510075864),
            'Skiing' => array('id' => 6003324287371),
            'Tennis' => array('id' => 6003397425735),
            'Mixed Martial Arts' => array('id' => 6003110460645),
            'Auto Racing' => array('id' => 6003146718552),
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => array(
                    'countries' => ['US'],
                ),

                'age_min' => 13,


            );

            if(isset($keywordId))
            {
                $valueId = $value['id'];

                $valueId = "$valueId";

                $interest_spec = array(
                    'flexible_spec' => array(
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$valueId,
                                ),
                            )
                        ),
                        array(
                            'interests' => array(
                                array(
                                    'id' => (int)$keywordId,
                                ),
                            )
                        )

                    )
                );


                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));

            }else{

                $interest_spec = array(
                    'interests' => array(
                        'id'=> $value['id'],
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $interest_spec));
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection, 1);

        return $reach;
    }

    public function Chart_US_Geo($tokenCollection,$keywordName = NULL, $keywordId = NULL)
    {
        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();

        $traits = array(
            'New York' => array('key' => '2490299','radius' => 10, 'distance_unit' => 'mile'),
            'Albuquerque' => array('key' => '2485415','radius' => 10, 'distance_unit' => 'mile'),
            'Atlanta' => array('key' => '2430536','radius' => 10, 'distance_unit' => 'mile'),
            'Austin' => array('key' => '2525495','radius' => 10, 'distance_unit' => 'mile'),
            'Baltimore' => array('key' => '2457691','radius' => 10, 'distance_unit' => 'mile'),
            'Boston' => array('key' => 2464828,'radius' => 10, 'distance_unit' => 'mile'),
            'Charlotte' => array('key' => 2493367,'radius' => 10, 'distance_unit' => 'mile'),
            'Chicago' => array('key' => 2438177,'radius' => 10, 'distance_unit' => 'mile'),
            'Cleveland' => array('key' => 2498857,'radius' => 10, 'distance_unit' => 'mile'),
            'Colorado Springs' => array('key' => 2423310,'radius' => 10, 'distance_unit' => 'mile'),
            'Columbus' => array('key' => 2431418,'radius' => 10, 'distance_unit' => 'mile'),
            'Dallas' => array('key' => 2526493,'radius' => 10, 'distance_unit' => 'mile'),
            'Denver' => array('key' => 2423371,'radius' => 10, 'distance_unit' => 'mile'),
            'Detroit' => array('key' => 2467497,'radius' => 10, 'distance_unit' => 'mile'),
            'Fort Worth' => array('key' => 2527052,'radius' => 10, 'distance_unit' => 'mile'),
            'Fresno' => array('key' => 2419347,'radius' => 10, 'distance_unit' => 'mile'),
            'Houston' => array('key' => 2527622,'radius' => 10, 'distance_unit' => 'mile'),
            'Indianapolis' => array('key' => 2442569,'radius' => 10, 'distance_unit' => 'mile'),
            'Jacksonville' => array('key' => 2494667,'radius' => 10, 'distance_unit' => 'mile'),
            'Kansas City' => array('key' => 2476632,'radius' => 10, 'distance_unit' => 'mile'),
            'Las Vegas' => array('key' => 2481714,'radius' => 10, 'distance_unit' => 'mile'),
            'Long Beach' => array('key' => 2420359,'radius' => 10, 'distance_unit' => 'mile'),
            'Los Angeles' => array('key' => 2420379,'radius' => 10, 'distance_unit' => 'mile'),
            'Louisville' => array('key' => 2450471,'radius' => 10, 'distance_unit' => 'mile'),
            'Memphis' => array('key' => 2523270,'radius' => 10, 'distance_unit' => 'mile'),
            'Mesa' => array('key' => 2413491,'radius' => 10, 'distance_unit' => 'mile'),
            'Miami' => array('key' => 2428987,'radius' => 10, 'distance_unit' => 'mile'),
            'Milwaukee' => array('key' => 2547917,'radius' => 10, 'distance_unit' => 'mile'),
            'Minneapolis' => array('key' => 2471428,'radius' => 10, 'distance_unit' => 'mile'),
            'Nashville' => array('key' => 2523484,'radius' => 10, 'distance_unit' => 'mile'),
            'New Orleans' => array('key' => 2454320,'radius' => 10, 'distance_unit' => 'mile'),
            'Oakland' => array('key' => 2421044,'radius' => 10, 'distance_unit' => 'mile'),
            'Oklahoma City' => array('key' => 2504080,'radius' => 10, 'distance_unit' => 'mile'),
            'Omaha' => array('key' => 2481022,'radius' => 10, 'distance_unit' => 'mile'),
            'Philadelphia' => array('key' => 2511940,'radius' => 10, 'distance_unit' => 'mile'),
            'Phoenix' => array('key' => 2413713,'radius' => 10, 'distance_unit' => 'mile'),
            'Portland' => array('key' => 2505639,'radius' => 10, 'distance_unit' => 'mile'),
            'Raleigh' => array('key' => 2495894,'radius' => 10, 'distance_unit' => 'mile'),
            'Sacramento' => array('key' => 2421793,'radius' => 10, 'distance_unit' => 'mile'),
            'San Antonio' => array('key' => 2529761,'radius' => 10, 'distance_unit' => 'mile'),
            'San Diego' => array('key' => 2421830,'radius' => 10, 'distance_unit' => 'mile'),
            'San Francisco' => array('key' => 2421836,'radius' => 10, 'distance_unit' => 'mile'),
            'San Jose' => array('key' => 2421846,'radius' => 10, 'distance_unit' => 'mile'),
            'Seattle' => array('key' => 2542527,'radius' => 10, 'distance_unit' => 'mile'),
            'Tucson' => array('key' => 2414228,'radius' => 10, 'distance_unit' => 'mile'),
            'Tulsa' => array('key' => 2504533,'radius' => 10, 'distance_unit' => 'mile'),
            'Virginia Beach' => array('key' => 2540128,'radius' => 10, 'distance_unit' => 'mile'),
            'Washington' => array('key' => 2427178,'radius' => 10, 'distance_unit' => 'mile'),
            'Wichita' => array('key' => 2448103,'radius' => 10, 'distance_unit' => 'mile')
        );

        $account = new AdAccount($tokenCollection->ad_account_id);

        foreach ($traits as $key => $value){

            $targeting_spec = array(
                'geo_locations' => [
                    'cities' =>
                        array($value)
                ],

                'age_min' => 13,

            );

            if(isset($keywordId))
            {
                $targeting_spec_interest = array(
                    'interests' => array(
                        'id'=> $keywordId,
                    ));

                $temp_spec = json_encode(array_merge($targeting_spec, $targeting_spec_interest));
            }else{
                $temp_spec = json_encode($targeting_spec);
            }

            $targeting_specs[] = str_replace('"', "'",$temp_spec);


        }
        $reach = $this->doBatchRequest($targeting_specs, $traits, $tokenCollection,1);

        return $reach;
    }


    public function checkFBTargetIds($tokenCollection)
    {
        $url = 'https://graph.facebook.com/v2.6/search';

        $urlparams = [
            'access_token' => $tokenCollection->token,
            'type' => 'adTargetingCategory',
            'class' => 'income'
        ];

        $client = new \GuzzleHttp\Client;

        $response = $client->get($url, ['query' => $urlparams]);

        $response = json_decode($response->getBody(),true);

        print_r($response);
        die();
    }

    public function doBatchRequest($targeting_specs, $traits, $tokenCollection, $total = NULL, $other = NULL)
    {
        $non_other_reach = 0;
        $total_reach = 0;
        $max_attempts = 5;
        $attempts = 0;



        do {
            $batch = '[';
            foreach($targeting_specs as $spec)
            {
                $batch = $batch .
                    '{ "method": "GET",
                "relative_url":"v2.8/' . $tokenCollection->ad_account_id . '/reachestimate?currency=USD&optimize_for=OFFSITE_CONVERSIONS&targeting_spec=' .
                    $spec . '"
                },';
            }
            $batch = substr($batch, 0, -1);
            $batch = $batch . ']';

            $client = new Client();

            $response = $client->request(
                'POST',
                'https://graph.facebook.com',
                [
                    'form_params' =>
                        [
                            'access_token' => $tokenCollection->token,
                            'batch' => $batch

                        ]
                ]
            );

            $body = json_decode($response->getbody());
            $body_decoded = json_decode($body[0]->body);

            if(!isset($body_decoded->data->users)) {

                $tokenCollection = $this->tokenService->getNotToken($tokenCollection->token,'facebook');
                $attempts++;
                Log::info("Attempt: ". $attempts);
                Log::info("Trait: " . print_r($traits,TRUE));
                Log::info($body[0]->body);
                Log::info("END");

                $sleep = 90 * $attempts;
                sleep($sleep);
            }else{

                break;
            }

        }while($attempts < $max_attempts);
        /*echo $attempts;
        print_r($body[0]->body);*/
        /*$body = json_decode($body[0]->body);
        echo $body->data->users;*/

        $body_count = 0;
        foreach ($traits as $key => $value) {

            $body_decoded = json_decode($body[$body_count]->body);

            if(!isset($body_decoded->data->users)){
                Log::info($key);
                Log::info($body[$body_count]->body);
                print_r($body[$body_count]->body);
                echo "here";
                die();
            }



            $reach[$key] = $body_decoded->data->users;

            $total_reach = $total_reach + $body_decoded->data->users;
            //echo $key . ": " . $body_decoded->data->users . "<br/>";

            if (isset($value)) {
                $non_other_reach = $non_other_reach + $body_decoded->data->users;
            }
            $body_count++;
        }

        if (isset($total)) {
            $reach['total'] = $total_reach;
        }

        if (isset($other)) {
            $reach[$other] = $reach[$other] - $non_other_reach;
        }


        return $reach;
    }

}