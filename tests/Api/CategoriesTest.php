<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoriesTest extends TestCase
{
    public function testThatItCanGetCategories()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/api/categories')
            ->assertStatus(200)
            ->assertJson([
                [
                    'id' => 1,
                    'title' => 'General',
                ]
            ]);
    }
}
