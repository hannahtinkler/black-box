<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Tymon\JWTAuth\Facades\JWTAuth;

trait ApiRequests
{
    private $token;
    private $language;
    private $currency;

    /**
     * Wrapper for json test function.
     *
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $files
     * @param array $headers
     * @return TestResponse
     */
    public function apiCall(string $method, string $url, $data = [], $files = [], $headers = [])
    {
        $content = json_encode($data);

        $headers = array_merge($headers, [
            'Accept' => 'application/json',
            'CONTENT_LENGTH' => mb_strlen($content, '8bit'),
            'CONTENT_TYPE' => 'application/json',
        ]);

        if ($this->token !== null) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }

        $response = $this->call(
            $method,
            $url,
            [],
            [],
            $files,
            $this->transformHeadersToServerVars($headers),
            $content
        );

        $this->token = null;
        $this->language = null;
        $this->currency = null;

        return $response;
    }

    /**
     * Create a new user then use its token when making API calls.
     *
     * @param array $data
     * @return $this
     */
    public function withNewUser(array $data = [])
    {
        $user = factory(User::class)->create($data);
        $this->token = JWTAuth::fromUser($user);
        return $this;
    }

    /**
     * Create a token for an existing user and uses it for subsequent requests.
     *
     * @param User $user
     * @return $this
     */
    public function withUser(User $user)
    {
        $this->token = JWTAuth::fromUser($user);
        return $this;
    }
}
