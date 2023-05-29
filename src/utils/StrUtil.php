<?php

namespace Yuyue8\TpUtils\utils;

class StrUtil
{
    /**
     * 获取code码
     *
     * @return string
     */
    public function getCode()
    {
        return time() . rand(1000,9999);
    }

    /**
     * 生成指定位数的随机字符串
     *
     * @param integer $length
     * @param string $char
     * @return string
     */
    public function getRandString(int $length = 10, string $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $char_len = strlen($char) - 1;
        $length   = $length < 0 ? 10 : $length;

        $string = '';
        for ($i = $length; $i > 0; $i--) {
            $string .= $char[mt_rand(0, $char_len)];
        }
        return $string;
    }

    /**
     * 判断参数是否为正整数
     *
     * @param mixed $value
     * @return boolean
     */
    public function isPositiveInteger(mixed $value) {
        return is_numeric($value) && intval($value) == $value && $value > 0;
    }

    /**
     * 判断参数是否为非负整数
     *
     * @param mixed $value
     * @return boolean
     */
    public function isInteger(mixed $value) {
        return is_numeric($value) && intval($value) == $value && $value >= 0;
    }

    /**
     * 判断参数是否为整数或最多几位小数
     *
     * @param string|integer|float $number
     * @param integer $bit
     * @return boolean
     */
    public function is2DecimalPlaces(string|int|float $number, int $bit = 2)
    {
        if (!is_numeric($number)) {
            return false;
        }

        $decimal_position = strpos($number, '.');
        if ($decimal_position !== false && strlen(substr($number, $decimal_position + 1)) > $bit) {
            return false;
        }

        return true;
    }

    /**
     * 判断参数是否为手机号
     *
     * @param string $value
     * @return boolean
     */
    public function isMobile(string $value) {
        return preg_match('^1(3|4|5|6|7|8|9)[0-9]\d{8}$^', $value) ? true : false;
    }

    /**
     * 隐藏手机号中间四位
     *
     * @param string $phone
     * @return string
     */
    public function hidePhone(string $phone)
    {
        return substr($phone, 0, 3) . '****' . substr($phone, -4);
    }
}