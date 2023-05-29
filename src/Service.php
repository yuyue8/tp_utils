<?php

namespace Yuyue8\TpUtils;

use think\facade\Config;

class Service extends \think\Service
{

    /**
     * 服务注册
     *
     * @return void
     */
    public function register()
    {
        $config = include(__DIR__ . '/config/tpUtils.php');
        $config = Config::get('tpUtils') + $config;
        Config::set($config, 'tpUtils');

        $this->app->bind($config);
    }

    /**
     * 服务启动
     *
     * @return void
     */
    public function boot()
    {
        
    }

}
