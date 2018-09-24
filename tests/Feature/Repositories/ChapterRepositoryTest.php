<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Chapter;
use App\Models\Category;
use App\Repositories\ChapterRepository;

class ChapterRepositoryTest extends TestCase
{
    public function testThatItCanGetAllCategories()
    {
        $repository = new ChapterRepository(new Chapter);

        $expected = Chapter::orderBy('order')->get();

        $actual = $repository->all();

        $this->assertEquals($expected, $actual);
    }

    public function testThatItCanResolveAnExistingChapterByTitle()
    {
        $repository = new ChapterRepository(new Chapter);

        $chapter = Chapter::find(1);

        $expected = $chapter;

        $actual = $repository->resolve($chapter->category, 'Sample');

        $this->assertEquals($expected, $actual);
    }

    public function testThatItCanResolveAnNewChapterByTitle()
    {
        $repository = new ChapterRepository(new Chapter);

        $category = factory(Category::class)->create();

        $repository->resolve($category, 'Packages');

        $this->assertDatabaseHas('chapters', [
            'title' => 'Packages',
            'slug' => 'packages',
        ]);
    }
}
