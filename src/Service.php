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
        $config = include(__DIR__ . '/config/tp_config.php');

        $tp_config = Config::get('tp_config');

        $config = ($tp_config['util_register'] ?? []) + $config['util_register'];

        $tp_config['util_register'] = $config;

        Config::set($tp_config, 'tp_config');

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
