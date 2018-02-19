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

    protected $statusCode = 200;

    private function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function responseNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->responseError($message);
    }

    private function responseError($message)
    {
        return $this->response([
            'status' => 'Failed',
            'status_code' => $this->getStatusCode(),
            'message' => $message
        ]);
    }

    public function responseSuccess($data)
    {
        return $this->response([
            'status' => 'Success',
            'status_code' => $this->getStatusCode(),
            'data' => $data
        ]);
    }
    /**
     * API数据返回基础方法
     * @param $data
     * @return mixed
     */
    public function response($data)
    {
        return Response::json($data);
    }

}
