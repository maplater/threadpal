<?php

namespace App\Services;


use Illuminate\Support\Facades\Auth;
use App\Repositories\TokenRepository;
use App\Token;



class TokenService{


protected $tokenRepository;


    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     *
     *
     * @return Collection
     */
    public function getToken($provider)
    {
        return $this->tokenRepository->getToken($provider);
    }

    public function updateToken(Token $tokenCollection, $token)
    {
        return $this->tokenRepository->updateToken($tokenCollection, $token);
    }

    public function saveToken($provider, $token)
    {
        return $this->tokenRepository->saveToken($provider, $token);
    }

    public function getTokens($provider)
    {
        return $this->tokenRepository->getTokens($provider);
    }

    public function getRandomToken($provider)
    {
        $tokens = $this->getTokens($provider);

        $token = $tokens->random();

        return $token;

    }

    public function getNotToken($token, $provider)
    {
        $tokens = $this->tokenRepository->getNotToken($token, $provider);

        $token = $tokens->random();

        return $token;
    }
}