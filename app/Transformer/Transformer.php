<?php

namespace App\Transformer;


abstract class Transformer
{
    /** 字段映射处理基础类
     * @param $items
     * @return array
     */
    public function transformCollection($items)
    {
        return array_map([$this, 'transform'], $items);
    }

    /**
     * 字段映射处理基础方法，组要子类当中实现
     * @param $item
     * @return mixed
     */
    public abstract function transform($item);

}