<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    public function testThatItCanAccessTheApiWhenAuthenticated()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/api/categories')
            ->assertStatus(200);
    }

    public function testThatItCanAccessTheApiWhenNowAuthenticated()
    {
        $response = $this->get('/api/categories')->assertStatus(401);
    }
}
