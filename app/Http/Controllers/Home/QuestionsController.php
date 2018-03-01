<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StoreQuestion;
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

    public function store(StoreQuestion $request)
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
        $question = Question::findOrFail($id);
        return view('question.show',compact('question'));
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
