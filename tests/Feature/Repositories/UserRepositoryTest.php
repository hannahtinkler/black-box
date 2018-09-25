<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Repositories\UserRepository;
use Laravel\Socialite\Two\User as SocialiteUser;

class UserRepositoryTest extends TestCase
{
    public function testThatItLogsInExistingUser()
    {
        $user = factory(User::class)->create();

        $socialite = $this->mock(SocialiteUser::class, function ($mock) use ($user) {
            $mock->getEmail()
                ->willReturn($user->email)
                ->shouldBeCalled();

            $mock->getName()
                ->willReturn($user->name)
                ->shouldBeCalled();
        });

        $repository = new UserRepository(new User);

        $repository->loginOrRegister($socialite);

        $actual = auth()->user();

        $this->assertEquals($user->toArray(), $actual->toArray());
    }

    public function testThatItRegistersAndLogsInNewUser()
    {
        $user = factory(User::class)->make();

        $socialite = $this->mock(SocialiteUser::class, function ($mock) use ($user) {
            $mock->getEmail()
                ->willReturn($user->email)
                ->shouldBeCalled();

            $mock->getName()
                ->willReturn($user->name)
                ->shouldBeCalled();
        });

        $repository = new UserRepository(new User);

        $expected = $repository->loginOrRegister($socialite);
        $actual = auth()->user();

        $this->assertEquals($expected->toArray(), $actual->toArray());

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
