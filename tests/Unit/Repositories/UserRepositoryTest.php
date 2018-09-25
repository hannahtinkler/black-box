<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Repositories\UserRepository;
use Laravel\Socialite\Two\User as SocialiteUser;

class UserRepositoryTest extends TestCase
{
    public function testThatItDeterminesUserCanLogInIfEmailDomainIsCorrect()
    {
        $socialite = $this->mock(SocialiteUser::class, function ($mock) {
            $mock->getEmail()
                ->willReturn('test@e3creative.co.uk')
                ->shouldBeCalled();
        });

        $repository = new UserRepository(new User);

        $actual = $repository->canLoginOrRegister($socialite);

        $this->assertTrue($actual);
        $this->assertMethodsCalled();
    }

    public function testThatItDeterminesUserCannotLogInIfEmailDomainIsIncorrect()
    {
        $socialite = $this->mock(SocialiteUser::class, function ($mock) {
            $mock->getEmail()
                ->willReturn('test@gmail.co.uk')
                ->shouldBeCalled();
        });

        $repository = new UserRepository(new User);

        $actual = $repository->canLoginOrRegister($socialite);

        $this->assertFalse($actual);
        $this->assertMethodsCalled();
    }
}
