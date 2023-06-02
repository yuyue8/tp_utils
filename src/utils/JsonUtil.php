<?php
namespace Yuyue8\TpUtils\utils;

use think\Response;

/**
 * Json输出类
 * Class Json
 * @package Yuyue8\TpUtils\utils
 */
class JsonUtil
{
    private $code = 200;

    public function code(int $code): self
    {
        $this->code = $code;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param integer $code
     * @param string $msg
     * @param array|null $data
     * @return Response
     */
    public function make(int $code, string $msg, object|array|null $data = null): Response
    {
        $res = compact('code', 'msg','data');

        return Response::create($res, 'json', $this->code);
    }

    public function success($msg = 'ok', ?array $data = null): Response
    {
        if (is_array($msg) || is_object($msg) || $msg == null) {
            $data = $msg;
            $msg = '成功';
        }

        return $this->make(200, $msg, $data);
    }

    public function fail($msg = 'fail', ?array $data = null): Response
    {
        if (is_array($msg)) {
            $data = $msg;
            $msg = '失败';
        }

        return $this->make(400, $msg, $data);
    }
}
