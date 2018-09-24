<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;

class ChaptersTest extends TestCase
{
    public function testThatItCanGetChapters()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/api/chapters')
            ->assertStatus(200)
            ->assertJson([
                [
                    'id' => 1,
                    'title' => 'Sample',
                ]
            ]);
    }
}
