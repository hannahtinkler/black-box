<?php

namespace App\Http\Controllers;

use App\Models\User;

class ChapterController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('home.index');
    }
}
