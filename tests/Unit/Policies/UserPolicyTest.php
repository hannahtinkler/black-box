<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\Models\User;
use App\Policies\UserPolicy;
use App\Services\Api\BitbucketApiService;

class UserPolicyTest extends TestCase
{
    public function testItAllowsAccessIfUserInTeam()
    {
        $bitbucket = $this->mock(BitbucketApiService::class, function ($mock) {
            $mock->teams()->willReturn([
                (object) ['username' => 'e3creative'],
                (object) ['username' => 'no-team'],
            ])->shouldBeCalled();
        });


        $policy = new UserPolicy($bitbucket);

        $actual = $policy->access(new User);

        $this->assertTrue($actual);
        $this->assertMethodsCalled();
    }

    public function testItDoesNotAllowAccessIfUserNotInTeam()
    {
        $bitbucket = $this->mock(BitbucketApiService::class, function ($mock) {
            $mock->teams()->willReturn([
                (object) ['username' => 'no-team'],
            ])->shouldBeCalled();
        });


        $policy = new UserPolicy($bitbucket);

        $actual = $policy->access(new User);

        $this->assertFalse($actual);
        $this->assertMethodsCalled();
    }
}
