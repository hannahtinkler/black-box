<?php

namespace Tests\Unit;

use Tests\Unit\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use \App\Models\User;
use App\Policies\UserPolicy;
use App\Services\Api\BitbucketApiService;

class UserPolicyTest extends TestCase
{
    public function testItAllowsAccessIfUserInTeam()
    {
        $bitbucketMock = $this->mock(BitbucketApiService::class);

        $bitbucketMock->teams()->willReturn([
            (object) ['username' => 'e3creative'],
            (object) ['username' => 'no-team'],
        ])->shouldBeCalled();

        $policy = new UserPolicy($bitbucketMock->reveal());

        $actual = $policy->access(new User);

        $this->assertTrue($actual);
    }

    public function testItDoesNotAllowAccessIfUserNotInTeam()
    {
        $bitbucketMock = $this->mock(BitbucketApiService::class);

        $bitbucketMock->teams()->willReturn([
            (object) ['username' => 'no-team'],
        ])->shouldBeCalled();

        $policy = new UserPolicy($bitbucketMock->reveal());

        $actual = $policy->access(new User);

        $this->assertFalse($actual);
    }
}
