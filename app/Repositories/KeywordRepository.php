<?php

namespace App\Repositories;

use FacebookAds\Api;
use App\Services\ConnectionService;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\ReachEstimateFields;
use FacebookAds\Object\Values\OptimizationGoals;
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;
use GuzzleHttp\Client;


class KeywordRepository{




    public function search($keyword, $tokenCollection)
    {
        $autocomplete = NULL;

        $count = 0;
        $limit = 10;

        $keyword_array = array($keyword);

        Api::init($tokenCollection->client_id, $tokenCollection->client_secret, $tokenCollection->token);

        $api = Api::instance();



        $account = new AdAccount($tokenCollection->ad_account_id);

        $results = TargetingSearch::search(
            TargetingSearchTypes::INTEREST,
            null,
            $keyword);

        /*$result = $results[0]->getData();
        print_r($result['id']);*/

        foreach ($results as $result)
        {
            $r = $result->getData();
            $autocomplete[$count]['id'] = $r['id'];
            $autocomplete[$count]['name'] = $r['name'];
            $autocomplete[$count]['reach'] = number_format($r['audience_size']);
            $autocomplete[$count]['url'] = '/r/' . $r['id'];
            $count++;
            if($count == $limit){break;}

        }

        return $autocomplete;

        //return associative array of values for total and subtraits
    }

    public function getKeywordNamebyId($id, $tokenCollection)
    {
        $url = 'https://graph.facebook.com/v2.8/search';

        $urlparams = [
            'access_token' => $tokenCollection->token,
            'type' => 'adinterestvalid',
            'interest_fbid_list' => [$id]
        ];

        $client = new \GuzzleHttp\Client;

        $response = $client->get($url, ['query' => $urlparams]);

        $response = json_decode($response->getBody(),true);

        return $response;
    }

}