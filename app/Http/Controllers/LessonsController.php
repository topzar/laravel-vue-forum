<?php

namespace App\Http\Controllers;

use App\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class LessonsController extends Controller
{

    public function index()
    {

        /**
         * 1.要有状态码和提示信息
         * 2.不要暴露数据库字段
         */
        $lessons = Lesson::all();
        return Response::json([
            'code' => 200,
            'message' => 'success',
            'data' => $this->transformCollection($lessons)
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        //dd($lesson);
        return Response::json([
            'code' => 200,
            'message' => 'success',
            'data' => $this->transform($lesson)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * API字段映射，处理Collection数据
     * @param $lessons
     * @return array
     */
    private function transformCollection($lessons)
    {
        return array_map([$this, 'transform'], $lessons->toArray());
    }

    /**
     * API字段映射，避免暴露数据库真是字段
     * @param $lesson
     * @return array
     */
    private function transform($lesson)
    {
        //这里只返回映射后的字段，原来的字段都被隐藏掉
        return [
            'lesson_title' => $lesson['title'],
            'content' => $lesson['body'],
            // (boolean) 强制返回boolean类型数据
            'is_free' => (boolean) $lesson['free']
        ];
    }
}
