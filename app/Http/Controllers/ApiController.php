<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

/**
 * APIC基础类
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{

    /**
     * API数据返回基础方法
     * @param $data
     * @return mixed
     */
    public function response($data)
    {
        //dd($data);
        return Response::json([
            'data' => $data
        ]);
    }

}
