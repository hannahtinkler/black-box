<?php

namespace Tests\Api;

use Tests\TestCase;
use App\Models\User;
use App\Models\PageDraft;

class PageDraftsTest extends TestCase
{
    public function testThatItCanSavePageDraft()
    {
        $user = factory(User::class)->create();

        $draft = factory(PageDraft::class)->make();

        $response = $this->actingAs($user)
            ->post('/api/drafts', $draft->toArray())
            ->assertStatus(200)
            ->assertJson([
                'chapter_id' => $draft->chapter_id,
                'title' => $draft->title,
                'description' => $draft->description,
                'content' => $draft->content,
                'has_resources' => $draft->has_resources,
                'created_by' => $user->id,
            ]);
    }

    public function testThatItCanUpdatePageDraft()
    {
        $user = factory(User::class)->create();

        $original = factory(PageDraft::class)->create(['created_by' => $user->id]);
        $updates = factory(PageDraft::class)->make(['created_by' => $user->id]);

        $newData = array_merge(['id' => $original->id], $updates->toArray());

        $response = $this->actingAs($user)
            ->patch('/api/drafts/' . $original->id, $newData)
            ->assertStatus(200)
            ->assertJson([
                'chapter_id' => $newData['chapter_id'],
                'title' => $newData['title'],
                'description' => $newData['description'],
                'content' => $newData['content'],
                'has_resources' => $newData['has_resources'],
                'created_by' => $user->id,
            ])
            ->assertSee('updated_at_formatted');

        $this->assertDatabaseHas('page_drafts', array_merge(
            $newData,
            ['has_resources' => (int) $newData['has_resources']]
        ));
    }
}
