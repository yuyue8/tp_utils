<?php

namespace Yuyue8\TpUtils\utils;

class TimeUtil
{

    /**
     * 字符串转为时间戳
     *
     * @return void
     */
    public function strToTimestamp($value)
    {
        if (empty($value)) {
            return 0;
        }

        if (is_numeric($value)) {
            return (int)$value;
        }

        $timestamp = strtotime($value);
        if ($timestamp === false) {
            return 0;
        } else {
            return $timestamp;
        }
    }

    /**
     * 时间戳转日期字符串
     *
     * @param integer $timestamp
     * @param boolean $is_date
     * @return string
     */
    public function timestampToStr(int $timestamp, bool $is_date = false)
    {
        if (empty($timestamp)) {
            return '';
        }
        if ($is_date) {
            return date('Y-m-d', $timestamp);
        }
        return date('Y-m-d H:i:s', $timestamp);
    }

    /**
     * 获取时间戳所处状态
     *
     * @param integer $timestamp
     * @param integer $start_time
     * @param integer $end_time
     * @return int
     */
    public function getTimeStatus(int $timestamp, int $start_time, int $end_time)
    {
        if ($timestamp < $start_time) {
            return 1;
        } elseif ($timestamp > $end_time) {
            return 3;
        } else {
            return 2;
        }
    }

    /**
     * 判断是否为顺序排列的H:i:s格式时间数组
     *
     * @param array $data
     * @return boolean
     */
    public function isOrderTimeFormatArray(array $data)
    {
        $start = 0;
        foreach ($data as $value) {
            if(!$this->isValidTimeFormat($value, 'H:i:s')){
                return false;
            }
            $time = strtotime($value);
            if($time <= $start){
                return false;
            }
            $start = $time;
        }
        return true;
    }

    /**
     * 判断字符串是否为指定的格式时间
     *
     * @param string $timeStr
     * @param string $format
     * @return boolean
     */
    public function isValidTimeFormat(string $timeStr, string $format): bool
    {
        $dateTime = \DateTime::createFromFormat($format, $timeStr);
        return $dateTime && $dateTime->format($format) === $timeStr;
    }

    /**
     * 判断结束时间是否大于开始时间
     *
     * @param integer|string $start_time
     * @param integer|string $end_time
     * @return boolean
     */
    public function isEndTimeGtStartTime(int|string $start_time, int|string $end_time)
    {
        return $this->strToTimestamp($end_time) > $this->strToTimestamp($start_time);
    }

    /**
     * 判断字符串是否为日期段
     * 2023-01-01 - 2023-05-15
     *
     * @param string $dateRange
     * @return boolean
     */
    public function isDateRange(string $dateRange, bool $is_empty = true)
    {
        if ($is_empty && empty($dateRange)) {
            return true;
        }
        $dates = explode(' - ', $dateRange);

        if (count($dates) != 2) {
            return false;
        }

        if (!$this->isValidTimeFormat($dates[0], 'Y-m-d') || !$this->isValidTimeFormat($dates[1], 'Y-m-d')) {
            return false;
        }

        $start_date = strtotime($dates[0]);
        $end_date = strtotime($dates[1]);

        if (!$start_date || !$end_date) {
            return false;
        }

        if ($start_date >= $end_date) {
            return false;
        }

        return true;
    }

    /**
     * 时间段字符串转为数组
     *
     * @param string $dateRange
     * @return array
     */
    public function getDateRangeToArray(string $dateRange) : array
    {
        [$start_time, $end_time] = explode(' - ', $dateRange);

        return [strtotime($start_time . ' 00:00:00'), strtotime($end_time . ' 23:59:59')];
    }

    /**
     * 获取时间戳间隔天数
     *
     * @param integer $time1
     * @param integer $time2
     * @return int
     */
    public function getTimestampSpaceDays(int $time1, int $time2)
    {
        return floor(abs($time2 - $time1) / 86400);
    }
}