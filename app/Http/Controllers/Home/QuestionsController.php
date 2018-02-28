<?php

namespace App\Http\Controllers\Home;

use Auth;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{

    public function index()
    {
        return 'question.index';
    }


    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {

        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = Question::create($data);

        return redirect()->route('question.show',$question->id);
    }


    public function show($id)
    {
        return Question::findOrFail($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
