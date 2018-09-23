<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Api\BitbucketApiService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @var BitbucketApiService
     */
    public $bitbucket;

    /**
     * @param BitbucketApiService $bitbucket
     */
    public function __construct(BitbucketApiService $bitbucket)
    {
        $this->bitbucket = $bitbucket;
    }

    /**
     * Determines whether the user is in any of the required Bitbucket teams
     *
     * @param  User   $user
     * @return Boolean
     */
    public function access(User $user) : boolean
    {
        $teams = $this->bitbucket->teams();

        return array_reduce($teams, function ($carry, $team) {
            return in_array($team->username, config('black-box.auth.team_restriction')) ? true : $carry;
        }, false);
    }
}
