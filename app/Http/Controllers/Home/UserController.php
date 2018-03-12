<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    protected $userRepository;

    /**
     * UserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function home($username)
    {
        $user = $this->userRepository->byName($username);
        return view('user.home', compact('user'));
    }

}
