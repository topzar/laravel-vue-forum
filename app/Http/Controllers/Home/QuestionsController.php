<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\StoreQuestion;
use App\Topic;
use Auth;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{

    public function __construct()
    {
        //定义中间件 except这些方法将不受中间件约束
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        return 'question.index';
    }


    public function create()
    {
        $topics = Topic::select('id','name')->orderBy('id','desc')->get();

        return view('question.create',compact('topics'));
    }

    public function store(StoreQuestion $request)
    {
        $topics = $this->normalizeTopics($request->get('topics'));

        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = Question::create($data);

        //操作问题和话题的关联表 attach()
        $question->topics()->attach($topics);

        return redirect()->route('question.show',$question->id);
    }


    public function show($id)
    {
        //$question = Question::findOrFail($id);
        $question = Question::where('id', $id)->with('topics')->first();

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

    private function normalizeTopics($topics)
    {
        return collect($topics)->map(function ($topic) {

            //更新该话题的问题总数
            Topic::find($topic)->increment('questions_count');
            return $topic;

        })->toArray();
    }
}
