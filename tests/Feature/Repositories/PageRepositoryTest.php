<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Page;
use App\Services\Versioner;
use App\Repositories\PageRepository;
use League\CommonMark\CommonMarkConverter;

class PageRepositoryTest extends TestCase
{
    public function testThatItCanGetPageWithSlug()
    {
        $page = factory(Page::class)->create(['slug' => 'my-page'])->load(['chapter']);
        $page->deleted_at = null;

        $repository = new PageRepository(
            new Page,
            new Versioner,
            new CommonMarkConverter
        );

        $actual = $repository->getBySlug('my-page');

        $this->assertEquals($page->toArray(), $actual->toArray());
    }
}
