<?php

namespace Tests\Support\Traits;

use Prophecy\Prophet;

trait HasMocks
{
    /**
     * @var Prophet
     */
    public $prophet;

    public function __construct()
    {
        parent::__construct();

        $this->prophet = new Prophet;
    }

    public function mock(string $class)
    {
        return $this->prophet->prophesize($class);
    }

    public function assertMethodsCalled()
    {
        $this->prophet->checkPredictions();
    }
}
