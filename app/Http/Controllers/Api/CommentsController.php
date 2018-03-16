<?php

namespace App\Http\Controllers\Api;

use App\Answer;
use App\Comment;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentsController extends Controller
{
    public function answer($id)
    {
        $comments = Answer::with('comments', 'comments.user')->where('id', $id)->first();
        return $comments->comments;
    }

    public function question($id)
    {
        $comments = Question::with('comments', 'comments.user')->where('id', $id)->first();
        return $comments->comments;
    }

    public function store()
    {
        $commentType = $this->getCommentTypeNameBy(request('type'));

        $comment = Comment::create([
            'user_id' => \Auth::user()->id,
            'body' => request('body'),
            'commentable_id' => request('id'),
            'commentable_type' => $commentType
        ]);

        return $comment;
    }

    private function getCommentTypeNameBy($type)
    {
        return $type === 'question' ? 'App\Question' : 'App\Answer';
    }
}
