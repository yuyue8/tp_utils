<?php

namespace Yuyue8\TpUtils\utils;

class DateUtil
{
    /**
     * 获取当天时间段
     *
     * @return array
     */
    public function getToday()
    {
        return [
            strtotime('today'),
            strtotime('tomorrow') - 1
        ];
    }

    /**
     * 获取昨天时间段
     *
     * @return array
     */
    public function getYesterday()
    {
        return [
            strtotime('yesterday'),
            strtotime('today') - 1,
        ];
    }

    /**
     * 获取上周时间段
     *
     * @return array
     */
    public function getLastWeek()
    {
        return [
            strtotime('last week monday'),
            strtotime('this week monday') - 1,
        ];
    }

    /**
     * 获取本周时间段
     *
     * @return array
     */
    public function getThisWeek()
    {
        return [
            strtotime('this week monday'),
            strtotime('next week monday') - 1,
        ];
    }

    /**
     * 获取上月时间段
     *
     * @return array
     */
    public function getLastMonth()
    {
        return [
            strtotime('first day of last month 00:00:00'),
            strtotime('last day of last month 23:59:59'),
        ];
    }

    /**
     * 获取本月时间段
     *
     * @return array
     */
    public function getThisMonth()
    {
        return [
            strtotime('first day of this month 00:00:00'),
            strtotime('last day of this month 23:59:59'),
        ];
    }

    /**
     * 获取几天前0点的时间戳
     *
     * @param integer $days
     * @return int
     */
    public function getTimestampDaysAgo(int $days) {
        return strtotime('today') - ($days * 86400);
    }

    
}
