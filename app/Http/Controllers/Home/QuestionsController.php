<?php

namespace App\Http\Controllers\Home;

use App\Http\Repositories\QuestionRepository;
use App\Http\Requests\StoreQuestion;
use App\Topic;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{

    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        //定义中间件 except这些方法将不受中间件约束
        $this->middleware('auth')->except(['index', 'show']);

        $this->questionRepository = $questionRepository;
    }

    public function index()
    {
        $questions = $this->questionRepository->getAllQuestions();
        return view('question.index', compact('questions'));
    }


    public function create()
    {
        $topics = Topic::select('id','name')->orderBy('id','desc')->get();

        return view('question.create',compact('topics'));
    }

    public function store(StoreQuestion $request)
    {
        $topics = $this->questionRepository->normalizeTopics($request->get('topics'));

        $data = [
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'user_id' => Auth::id()
        ];

        $question = $this->questionRepository->create($data);

        //操作问题和话题的关联表 attach()
        $question->topics()->attach($topics);

        return redirect()->route('question.show',$question->id);
    }


    public function show($id)
    {
        //$question = Question::findOrFail($id);
        $question = $this->questionRepository->byIdWithTopics($id);

        return view('question.show',compact('question'));
    }


    public function edit($id)
    {
        $question = $this->questionRepository->byIdWithTopics($id);
        //dd($question);
        $questionTopics = $this->questionRepository->questionTopicIdsBy($question->topics);
        //dd($questionTopics);
        //dd($question->topics->select('id')->get());
        $topics = Topic::select('id','name')->orderBy('id','desc')->get();

        return view('question.edit',compact('question','questionTopics', 'topics'));
    }


    public function update(Request $request, $id)
    {
        $question = $this->questionRepository->byId($id);
        $topics = $this->questionRepository->normalizeTopics($request->get('topics'));

        $question->update([
            'title' => $request->get('title'),
            'body' => $request->get('body')
        ]);

        //更新关联表
        $question->topics()->sync($topics);

        return redirect()->route('question.show', $question->id);
    }


    public function destroy($id)
    {
        //
    }

}
