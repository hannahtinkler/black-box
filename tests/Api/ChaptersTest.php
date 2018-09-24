<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Chapters;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
