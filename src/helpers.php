<?php

if (!function_exists('images_path')) {
    /**
     * 获取images路径
     *
     * @return string
     */
    function images_path()
    {
        return DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }
}

if (!function_exists('images_intact_path')) {
    /**
     * 获取images路径
     *
     * @return string
     */
    function images_intact_path()
    {
        return public_path('uploads' . DIRECTORY_SEPARATOR . 'images');
    }
}

if (!function_exists('get_time_util')) {
    /**
     * 获取时间处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\TimeUtil
     */
    function get_time_util()
    {
        return app('time_util');
    }
}

if (!function_exists('get_array_util')) {
    /**
     * 获取数组处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\ArrayUtil
     */
    function get_array_util()
    {
        return app('array_util');
    }
}

if (!function_exists('get_str_util')) {
    /**
     * 获取字符串处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\StrUtil
     */
    function get_str_util()
    {
        return app('str_util');
    }
}

if (!function_exists('get_date_util')) {
    /**
     * 获取日期处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\DateUtil
     */
    function get_date_util()
    {
        return app('date_util');
    }
}

if (!function_exists('get_file_util')) {
    /**
     * 获取日期处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\FileUtil
     */
    function get_file_util()
    {
        return app('file_util');
    }
}

if (!function_exists('get_tree_util')) {
    /**
     * 获取文件处理工具类
     *
     * @return \Yuyue8\TpUtils\utils\TreeUtil
     */
    function get_tree_util()
    {
        return app('tree_util');
    }
}

if (!function_exists('get_json_util')) {
    /**
     * 获取json输出工具类
     *
     * @return \Yuyue8\TpUtils\utils\JsonUtil
     */
    function get_json_util()
    {
        return app('json_util');
    }
}
