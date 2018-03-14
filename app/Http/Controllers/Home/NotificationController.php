<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('notifications.index', compact('user'));
    }

    public function all()
    {
        $user = Auth::user();
        return view('notifications.all', compact('user'));
    }

    public function show(DatabaseNotification $notification)
    {
        //标记为已读
        $notification->markAsRead();

        return back();
    }
}
