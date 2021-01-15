<?php

namespace Hexolus\Api\Oauth;

use Carbon\Carbon;
use GuzzleHttp\Client;

class Request {

    /**
     * OAuth Response
     * 
     * @var Response|null
     */
    protected $response = null;
    protected $url;
    protected $headers;
    protected $refreshTokenUrl;
    protected $mustRequestAgainOn;

    public function __construct($url, $headers = [], $refreshTokenUrl = null)
    {
      $this->url = $url;
      $this->headers = $headers;
      $this->refreshTokenUrl = $refreshTokenUrl;
    }

    public function requestAccessToken($additionalHeaders = [], $body = '')
    {
        if(!($this->response instanceof Response)) {
            return $this->doRequest($this->url, $additionalHeaders, $body);
        }

        if(Carbon::now()->isBefore($this->mustRequestAgainOn)) {
            return $this->response->access_token;
        } else {
            if(!$this->refreshTokenUrl) {
                return $this->doRequest($this->url, $additionalHeaders, $body);
            } else {
                // TODO: Refetch Access Token With Refresh Token
                return $this->doRequest($this->url, $additionalHeaders, $body);
            }
        }
        
    }

    public function getOAuth() {
        return $this->response;
    }

    private function doRequest($url, $additionalHeaders = [], $body = '') {
        $client = new Client();
            
        $this->response = new Response(
            $client->post($url, [
                'headers' => array_merge($this->headers, $additionalHeaders),
                'body' => $body
            ])
        );

        $this->mustRequestAgainOn = Carbon::now()->addSeconds($this->response->expires_in);

        return $this->response->access_token;
    }
    
}