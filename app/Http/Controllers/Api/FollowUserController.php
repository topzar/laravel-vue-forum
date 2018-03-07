<?php

namespace App\Http\Controllers\Api;

use App\Notifications\UserFollowNotification;
use Auth;
use App\Http\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FollowUserController extends Controller
{

    protected $userRepository;

    /**
     * FollowUserController constructor.
     * @param $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function followed($id)
    {
        $userInfo = $this->userRepository->byId($id);

        $followers = $userInfo->followersUser()->pluck('follower_id')->toArray();

        if ( in_array(Auth::guard('api')->user()->id, $followers) ) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);
    }

    public function follow(Request $request)
    {
        //被关注者
        $userToFollow = $this->userRepository->byId($request->get('user'));

        //关注操作
        $follow = Auth::guard('api')->user()->followThisUser($userToFollow->id);

        if (count($follow['detached'])  > 0) {

            //TODO 发送站内通知
            $userToFollow->notify(new UserFollowNotification());

            $userToFollow->decrement('followers_count');
            return response()->json(['followed' => false]);
        }

        $userToFollow->increment('followers_count');
        return response()->json(['followed' => true]);
    }
}
