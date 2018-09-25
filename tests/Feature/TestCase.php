<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use Tests\Support\Traits\HasMocks;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, HasMocks;
}
