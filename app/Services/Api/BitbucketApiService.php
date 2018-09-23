<?php

namespace App\Services\Api;

use App\Models\User;
use Bitbucket\API\Teams;
use Bitbucket\API\Http\Listener\OAuth2Listener;

class BitbucketApiService
{
    public $credentials;

    public function __construct()
    {
        $this->credentials = new OAuth2Listener([
            'client_id' => env('BITBUCKET_OAUTH_KEY'),
            'client_secret' => env('BITBUCKET_OAUTH_SECRET'),
        ]);
    }

    /**
     * Returns a list of all teams a user is connected to at any level
     * @return array
     */
    public function teams()
    {
        return $this->transform($this->resource(Teams::class)->all('member'));
    }

    /**
     * Retrieves the core data of the response
     *
     * @return array
     */
    private function transform($resource)
    {
        return json_decode($resource->getContent())->values;
    }

    /**
     * Builds an instance of the resource and applies the Oauth credentials to
     * it so it can authorise requests
     *
     * @param  string $model
     * @return Object
     */
    private function resource(string $class)
    {
        $class = new $class();

        $class->getClient()->addListener($this->credentials);

        return $class;
    }
}
