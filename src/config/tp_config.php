<?php
// +----------------------------------------------------------------------
// | tp_config配置
// +----------------------------------------------------------------------

return [
    'util_register' => [
        'time_util'  => \Yuyue8\TpUtils\utils\TimeUtil::class,
        'array_util' => \Yuyue8\TpUtils\utils\ArrayUtil::class,
        'str_util'   => \Yuyue8\TpUtils\utils\StrUtil::class,
        'date_util'  => \Yuyue8\TpUtils\utils\DateUtil::class,
        'file_util'  => \Yuyue8\TpUtils\utils\FileUtil::class,
        'tree_util'  => \Yuyue8\TpUtils\utils\TreeUtil::class,
    ]
];