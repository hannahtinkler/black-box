<?php

namespace Tests\Feature;

use StdClass;
use Tests\TestCase;
use App\Models\Page;
use App\Services\Versioner;

class VersionerTest extends TestCase
{
    public function testThatItCanMakeVersion()
    {
        $this->app->singleton('AuthenticatedUser', function () {
            $user = new StdClass;
            $user->id = 4;

            return $user;
        });

        $page = factory(Page::class)->create();
        $page->updated_by = 4;

        $versioner = new Versioner;

        $versioner->make($page);

        $this->assertDatabaseHas('page_versions', $page->toArray());
    }
}
