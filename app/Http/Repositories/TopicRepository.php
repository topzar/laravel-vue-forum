<?php


namespace App\Http\Repositories;


use App\Topic;

class TopicRepository
{
    public function topicWithQuestionsBy($id)
    {
        return Topic::where('id', $id)->with('questions')->first();
    }
}