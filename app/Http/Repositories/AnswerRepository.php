<?php


namespace App\Http\Repositories;


use App\Answer;

class AnswerRepository
{
    public function create(array $attribtes)
    {
        return Answer::create($attribtes);
    }

    public function byId($id)
    {
        return Answer::find($id);
    }
}