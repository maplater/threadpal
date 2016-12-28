<?php

namespace App\Repositories;

use App\Token;

use Illuminate\Support\Facades\Log;


class TokenRepository{

    public function __construct()
    {

    }

    /**
     *
     *
     * @return Collection
     */
    public function getToken($provider)
    {
        $tokenCollection = Token::where('provider',$provider)->first();

        return $tokenCollection;
    }

    public function updateToken(Token $tokenCollection, $token)
    {
        $tokenCollection->token = $token;

        $tokenCollection->save();

        return $tokenCollection;
    }

    public function saveToken($provider,$token)
    {
        $tokenCollection = new Token();

        $tokenCollection->provider = $provider;
        $tokenCollection->token = $token;

        $tokenCollection->save();

        return $tokenCollection;
    }

    public function getTokens($provider)
    {
        $tokenCollection = Token::where('provider',$provider)->get();

        return $tokenCollection;
    }

    public function getNotToken($token, $provider)
    {
        /*Log::info($token);
        die();*/
        $tokenCollection = Token::where('provider', $provider)
            ->where('token', '<>', $token)
            ->get();

        return $tokenCollection;
    }
}