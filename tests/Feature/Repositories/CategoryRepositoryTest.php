<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryRepositoryTest extends TestCase
{
    public function testThatItCanGetAllCategories()
    {
        $repository = new CategoryRepository(new Category);

        $expected = Category::orderBy('order')->get();

        $actual = $repository->all();

        $this->assertEquals($expected, $actual);
    }

    public function testThatItCanResolveAnExistingCategoryByTitle()
    {
        $repository = new CategoryRepository(new Category);

        $expected = Category::find(1);

        $actual = $repository->resolve('General');

        $this->assertEquals($expected, $actual);
    }

    public function testThatItCanResolveAnNewCategoryByTitle()
    {
        $repository = new CategoryRepository(new Category);

        $repository->resolve('Development');

        $this->assertDatabaseHas('categories', [
            'title' => 'Development',
            'slug' => 'development',
        ]);
    }
}
