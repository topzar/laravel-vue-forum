<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Transformer\LessonTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{

    protected $lessonTransformer;

    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;
    }

    public function index()
    {

        $lessons = Lesson::all();

        return Response::json([
            'code' => 200,
            'message' => 'success',
            'data' => $this->lessonTransformer->transformCollection($lessons->toArray())
        ]);

    }

    
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {

        //这里不能用findOrFail方法，因为无法自定义返回错误信息
        $lesson = Lesson::find($id);

        if (! $lesson) {
            return Response::json([
                'code' => 404,
                'message' => 'Not found lesson',
            ]);
        }

        return Response::json([
            'code' => 200,
            'message' => 'success',
            'data' => $this->lessonTransformer->transform($lesson)
        ]);

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
