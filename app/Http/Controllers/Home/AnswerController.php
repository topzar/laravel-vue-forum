<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\AnswerRepository;
use App\Http\Requests\AnswerRequest;
use App\Http\Controllers\Controller;
use Auth;

class AnswerController extends Controller
{

    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    public function store(AnswerRequest $request, $question)
    {

        $answer = $this->answerRepository->create([
            'body' => $request->get('body'),
            'question_id' => $question,
            'user_id' => Auth::id(),
        ]);

        //更新该问题的答案数
        $answer->question()->increment('answers_count');
        //更新用户的答案数
        $answer->user()->increment('answers_count');

        return back();
    }
}
