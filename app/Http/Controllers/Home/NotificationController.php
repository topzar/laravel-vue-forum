<?php

namespace App\Http\Controllers\Home;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('notifications.index', compact('user'));
    }
}
