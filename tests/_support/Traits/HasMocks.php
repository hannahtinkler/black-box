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

    public function mock(string $class, callable $actions = null)
    {
        $mock = $this->prophet->prophesize($class);

        if ($actions) {
            $actions($mock);
        }

        return $mock->reveal();
    }

    public function assertMethodsCalled()
    {
        $this->prophet->checkPredictions();
    }
}
