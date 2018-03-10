<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Repositories\MessageRepository;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{

    protected $messageRepository;

    /**
     * MessageController constructor.
     * @param $messageRepository
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }


    public function store()
    {
        $message = $this->messageRepository->create([
            'from_user_id' => Auth::guard('api')->user()->id,
            'to_user_id' => request('user'),
            'body' => request('body')
        ]);

        if ($message) {
            return response()->json(['status' => true]);
        }

        return response()->json(['status' => false]);

    }

}
