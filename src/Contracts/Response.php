<?php

namespace Hexolus\Api\Oauth\Contracts;

interface Response {
    /**
     * Get Access Token
     * 
     * @return string 
     */
    public function getAccessToken();

    /**
     * Get Token Type
     * 
     * @return string 
     */
    public function getTokenType();

    /**
     * Get Token Expires In Seconds
     * 
     * @return int 
     */
    public function getExpiresIn();

    /**
     * Get Refresh Token
     * 
     * @return string 
     */
    public function getRefreshToken();

    /**
     * Get Scope
     * 
     * @return string 
     */
    public function getScope();
}