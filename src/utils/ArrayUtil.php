<?php

namespace Yuyue8\TpUtils\utils;

class ArrayUtil
{
    /**
     * 将传入的数组转为以逗号分隔的字符串
     *
     * @param mixed $param
     * @return string
     */
    public function arrayToString(mixed $param): string
    {
        if (empty($param)) {
            return '';
        }

        if (is_array($param)) {
            return implode(',', $param);
        }

        return (string)$param;
    }

    /**
     * 将传入的字符串以逗号分隔为数组
     *
     * @param mixed $param
     * @param array $default
     * @return array
     */
    public function stringToArray(mixed $param, array $default = []): array
    {
        if (empty($param)) {
            return $default;
        }
        if (is_array($param)) {
            return $param;
        }
        return explode(',', $param);
    }

    /**
     * 数组转为json
     *
     * @param array|string $data
     * @return string
     */
    public function arrayToJson(array|string $data): string
    {
        if (!is_array($data)) {
            $data = json_decode($data, true);
        }

        if (is_array($data)) {
            return json_encode($data);
        } else {
            return '';
        }
    }

    /**
     * json转为数组
     *
     * @param mixed $value
     * @return array
     */
    public function jsonToArray(mixed $value): array
    {
        if (empty($value)) {
            return [];
        }
        if (is_array($value)) {
            return $value;
        }
        if (is_string($value)) {
            $output = json_decode($value, true);
            if (is_array($output)) {
                return $output;
            }
            return [$value];
        }
        return [];
    }

    /**
     * 无重复的非负整数数组
     *
     * @param array $arr
     * @return boolean
     */
    public function isUniqueIntegerArray(array $arr)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);
        foreach ($arr as $value) {
            if (!$strUtil->isInteger($value)) {
                return false;
            }
        }

        if (count(array_unique($arr)) === count($arr)) {
            return true;
        }

        return false;
    }

    /**
     * 验证是否为非负整数数组
     *
     * @param array $arr
     * @return boolean
     */
    public function isIntegerArray(array $arr)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);
        foreach ($arr as $value) {
            if (!$strUtil->isInteger($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 无重复的正整数数组
     *
     * @param array $arr
     * @return boolean
     */
    public function isUniquePositiveIntegerArray(array $arr)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);
        foreach ($arr as $value) {
            if (!$strUtil->isPositiveInteger($value)) {
                return false;
            }
        }

        if (count(array_unique($arr)) === count($arr)) {
            return true;
        }

        return false;
    }

    /**
     * 正整数数组
     *
     * @param array $arr
     * @return boolean
     */
    public function isPositiveIntegerArray(array $arr)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);
        foreach ($arr as $value) {
            if (!$strUtil->isPositiveInteger($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * 递增数字
     * [1,20,60,80]
     *
     * @param array $data
     * @return boolean
     */
    public function incNumberArray(array $data)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);
        foreach ($data as $key => $value) {
            if (!$strUtil->isInteger($value)) {
                return false;
            }
            if ($key != 0 && $value <= $data[$key - 1]) {
                return false;
            }
        }
        return true;
    }

    /**
     * 验证阶段取值数组格式
     *  [0,10,1],
     *  [10,20,2]
     * 
     * @param array $data
     * @param string|integer $start_field
     * @param string|integer $end_field
     * @param string|integer $value_field
     * @param bool $is_scale
     * @return boolean
     */
    public function isStageValueArray(array $data, string|int $start_field, string|int $end_field, string|int $value_field, bool $is_scale = false, bool $value_is_decimal = false)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);

        foreach ($data as $key => $value) {
            if (!isset($value[$start_field]) || !isset($value[$end_field]) || !isset($value[$value_field])) {
                return false;
            }
            if (!$strUtil->isInteger($value[$start_field]) || !$strUtil->isInteger($value[$end_field])) {
                return false;
            }
            if ($value_is_decimal) {
                if (!$strUtil->is2DecimalPlaces($value[$value_field])) {
                    return false;
                }
            } else {
                if (!$strUtil->isInteger($value[$value_field])) {
                    return false;
                }
            }
            if ($is_scale && $value[$value_field] > 100) {
                return false;
            }
            if ($key == 0) {
                if ($value[$end_field] <= $value[$start_field]) {
                    return false;
                }
            } else {
                if ($value[$start_field] != $data[$key - 1][$end_field] || $value[$end_field] <= $value[$start_field] || $value[$value_field] <= $data[$key - 1][$value_field]) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 验证阶段取值数组格式
     * [1, 10],
     * [2, 15],
     *
     * @param array $data
     * @param string|integer $field
     * @param string|integer $value_field
     * @param boolean $is_scale
     * @return boolean
     */
    public function isValueArray(array $data, string|int $field, string|int $value_field, bool $is_scale = false, bool $value_is_decimal = false)
    {
        /** @var StrUtil $strUtil */
        $strUtil = app(StrUtil::class);

        $start = 0;
        $start_value = 0;
        foreach ($data as $value) {
            if (!isset($value[$field]) || !isset($value[$value_field])) {
                return false;
            }
            if (!$strUtil->isInteger($value[$field])) {
                return false;
            }
            if ($value_is_decimal) {
                if (!$strUtil->is2DecimalPlaces($value[$value_field])) {
                    return false;
                }
            } else {
                if (!$strUtil->isInteger($value[$value_field])) {
                    return false;
                }
            }
            if ($value[$field] <= $start) {
                return false;
            }
            if ($value[$value_field] < $start_value) {
                return false;
            }
            if ($is_scale && $value[$value_field] > 100) {
                return false;
            }
            $start = $value[$field];
            $start_value = $value[$value_field];
        }
        return true;
    }
}
