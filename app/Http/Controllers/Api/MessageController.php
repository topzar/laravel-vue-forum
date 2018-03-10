<?php

namespace App\Http\Controllers\Api;

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
        dd(request()->all());
    }

}
