<?php

namespace Tests\Unit;


use App\Models\Page;
use App\Services\Versioner;
use App\Repositories\PageRepository;
use League\CommonMark\CommonMarkConverter;

use Tests\TestCase;
use Laravel\Socialite\Two\Page as SocialiteUser;

class PageRepositoryTest extends TestCase
{
    public function testThatItConvertsMarkdownPageContentToHtml()
    {
        $page = factory(Page::class)->make([
            'content' => sprintf(
                "# Heading%s## Subheading%s* Hello%s* Goodbye",
                ...array_fill(0, 3, PHP_EOL)
            ),
        ]);

        $repository = new PageRepository(
            new Page,
            new Versioner,
            new CommonMarkConverter
        );


        $expected = clone $page;
        $expected->html = sprintf(
            "<h1>Heading</h1>%s<h2>Subheading</h2>%s<ul>%s<li>Hello</li>%s<li>Goodbye</li>%s</ul>%s",
            ...array_fill(0, 6, PHP_EOL)
        );

        $actual = $repository->transform($page);

        $this->assertEquals($expected, $actual);
    }
}
