<?php

namespace Yuyue8\TpUtils\utils;

class TreeUtil
{
    /**
     * 将数据集格式化成层次结构
     *
     * @param array|\think\Collection $lists
     * @param integer $pid
     * @param integer $max_level
     * @param integer $curr_level
     * @return array
     */
    public function toLayer(array|\think\Collection $lists, int $format_type = 1, int $pid = 0, int $max_level = 0, int $curr_level = 0)
    {
        $trees = [];

        foreach ($lists as $value) {
            $trees[$value['pid']][] = $value;
        }

        if($format_type == 1){
            return $this->formatTreeList($trees, $pid, $max_level, $curr_level);
        }else{
            return $this->formatList($trees, $pid, $max_level, $curr_level);
        }
    }

    /**
     * 递归获取下级数据集
     *
     * @param array $array
     * @param integer $pid
     * @param integer $max_level
     * @param integer $curr_level
     * @param array $data
     * @return array
     */
    public function formatTreeList(array $array, int $pid = 0, int $max_level = 0, int $curr_level = 0)
    {
        if(isset($array[$pid])){
            if($max_level > 0 && $curr_level >= $max_level){
                return $array[$pid];
            }

            foreach ($array[$pid] as $key => $value) {
                $child = $this->formatTreeList($array, $value['id'], $max_level, $curr_level+1);
                if(!empty($child)){
                    $array[$pid][$key]['child'] = $child;
                }
            }

            return $array[$pid];
        }

        return [];
    }

    /**
     * 递归重新排序
     *
     * @param array $array
     * @param integer $pid
     * @param integer $max_level
     * @param integer $curr_level
     * @param array $list
     * @return array
     */
    public function formatList(array $array, int $pid = 0, int $max_level = 0, int $curr_level = 0, array $list = [])
    {
        if(isset($array[$pid])){
            if($max_level > 0 && $curr_level >= $max_level){
                return $list;
            }

            foreach ($array[$pid] as $key => $value) {
                $value['prefix'] = str_repeat("&nbsp;", $curr_level * 4) . '┝ ';

                $list[] = $value;

                $list = $this->formatList($array, $value['id'], $max_level, $curr_level+1, $list);
            }
        }

        return $list;
    }
}
