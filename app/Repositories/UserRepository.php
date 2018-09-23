<?php

namespace App\Repositories;

use App\Models\User;
use Laravel\Socialite\Two\User as SocialiteUser;

class UserRepository
{
    /**
     * @var User
     */
    public $model;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * If a domain restriction is in place, check the user's email address
     * belongs to that domain
     *
     * @param  SocialiteUser $socialite
     * @return boolean
     */
    public function canLoginOrRegister(SocialiteUser $socialite) : bool
    {
        return !config('black-box.auth.domain_restriction')
            || strpos($socialite->getEmail(), config('black-box.auth.domain_restriction')) !== false;
    }

    /**
     * @param  SocialiteUser $socialite
     * @return User
     */
    public function loginOrRegister(SocialiteUser $socialite) : User
    {
        $user = $this->model->firstOrCreate([
            'name' => $socialite->getName(),
            'email' => $socialite->getEmail(),
        ]);

        auth()->login($user);

        return $user;
    }
}
