<?php


namespace App\Http\Repositories;


use App\Message;

class MessageRepository
{
    public function create($attributes)
    {
        return Message::create($attributes);
    }
}