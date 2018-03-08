<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\Http\Repositories\AnswerRepository;
use App\Http\Controllers\Controller;

class VotesController extends Controller
{

    protected $answerRepository;

    /**
     * VotesController constructor.
     * @param $answerRepository
     */
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }


    /**
     * 是否点赞了某一个问题
     * @param $answer
     * @return \Illuminate\Http\JsonResponse
     */
    public function voted($answer)
    {
        if (Auth::user()->hasVotedForThis($answer)) {
            return response()->json(['voted' => true]);
        }
        return response()->json(['voted' => false]);
    }

    /**
     * 点赞(投票)
     * @return \Illuminate\Http\JsonResponse
     */
    public function vote()
    {

        $voted = Auth::user()->voteFor(request('answer'));

        $answer = $this->answerRepository->byId(request('answer'));

        if (count($voted['attached']) > 0) {

            //TODO 这里可以给用户发送站内通知

            $answer->increment('votes_count');
            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');
        return response()->json(['voted' => false]);

    }
}
