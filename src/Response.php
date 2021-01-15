<?php

namespace Hexolus\Api\Oauth;

use Hexolus\Api\Oauth\Contracts\Response as OAuthResponseInterface;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class Response implements OAuthResponseInterface
{
    /**
     * Access Token
     * 
     * @var string
     */
    public $access_token;

    /**
     * Token Type
     * 
     * @var string
     */
    public $token_type;

    /**
     * Expires In
     * 
     * @var int
     */
    public $expires_in;

    /**
     * Refresh Token
     * 
     * @var string
     */
    public $refresh_token;

    /**
     * Scope
     * 
     * @var string
     */
    public $scope;

    public function __construct(GuzzleResponse $response)
    {
        $response = json_decode($response->getBody()->getContents(), true);

        foreach($response as $key => $value) {
            $this->$key = $value;
        }
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function getTokenType()
    {
        return $this->token_type;
    }

    public function getExpiresIn()
    {
        return $this->expires_in;
    }

    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    public function getScope()
    {
        return $this->scope;
    }
}
