<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Repositories\TopicRepository;

class TopicController extends Controller
{

    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    public function show($id)
    {
        $topic = $this->topicRepository->topicWithQuestionsBy($id);
        return view('topics.show', compact('topic'));
    }
}
