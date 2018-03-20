<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Storage;

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

    public function qiniu(Request $request)
    {
        $file = $request->file('img');
        //文件名
        $filename = 'avatars/'.md5(time()).'.'.$file->getClientOriginalExtension();

        //上传到七牛云

        Storage::disk('qiniu')->writeStream($filename,fopen($file->getRealPath(),'r'));

        Auth::user()->avatar = 'http://'.config('filesystems.disks.qiniu.domain').'/'.$filename;
        Auth::user()->save();

        return response()->json(['url' => Auth::user()->avatar]);
    }

    public function password()
    {
        return view('user.password');
    }

    public function changePassword(PasswordRequest $request)
    {
        $user = Auth::user();
        if (Hash::check($request->get('old_password'), $user->password)) {
            $user->password = bcrypt($request->get('password'));
            $user->save();

            //让用户重新登录
            Auth::logout();
            return redirect('login');

        }else{
            return back();
        }

    }
}
