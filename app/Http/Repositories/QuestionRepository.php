<?php


namespace App\Http\Repositories;


use App\Question;
use App\Topic;

class QuestionRepository
{

    public function create(array $data)
    {
        return Question::create($data);
    }

    /** 问题和话题
     * @param $id 问题id
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function byIdWithTopics($id)
    {
        return Question::where('id', $id)->with('topics')->first();
    }

    /**
     * collection操作
     * @param $topics
     * @return array
     */
    public function normalizeTopics($topics)
    {
        return collect($topics)->map(function ($topic) {

            //更新该话题的问题总数
            Topic::find($topic)->increment('questions_count');
            return $topic;

        })->toArray();
    }
}