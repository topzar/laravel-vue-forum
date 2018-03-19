<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

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

    public function avatar()
    {
        return view('user.avatar');
    }

    public function setAvatar(Request $request)
    {
        $file = $request->file('img');
        //文件名
        $filename = md5(time()).'.'.$file->getClientOriginalExtension();
        //上传
        $file->move(public_path('avatars'), $filename);

        Auth::user()->avatar = '/avatars/'.$filename;
        Auth::user()->save();

        return response()->json(['url' => '/avatars/'.$filename]);
    }
}
