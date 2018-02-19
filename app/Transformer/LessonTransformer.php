<?php

namespace App\Transformer;


class LessonTransformer extends Transformer
{

    /**
     * API字段映射，避免暴露数据库真是字段
     * @param $lesson
     * @return array
     */
    public function transform($lesson)
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