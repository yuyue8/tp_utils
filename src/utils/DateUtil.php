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

    /**
     * 获取指定月份开始和结束时间戳
     *
     * @param integer $year
     * @param integer $month
     * @return array
     */
    public function getMonthTimestamps(int $year, int $month)
    {
        $start = strtotime("{$year}-{$month}-01 00:00:00");
        $end   = strtotime(date("Y-m-t 23:59:59", $start));
        return [$start, $end];
    }

    /**
     * 获取指定年份开始和结束时间戳
     *
     * @param integer $year
     * @return array
     */
    public function getYearTimestamps(int $year)
    {
        $start = strtotime("{$year}-01-01 00:00:00");
        $year += 1;
        $end = strtotime("{$year}-01-01 00:00:00") - 1;
        return [$start, $end];
    }

    /**
     * 获取指定季度的开始和结束时间戳
     *
     * @param integer $year
     * @param integer $type
     * @return array
     */
    public function getQuarterTimestamps(int $year, int $type)
    {
        switch ($type) {
            case 1:
                return [strtotime("{$year}-01-01 00:00:00"), strtotime("{$year}-04-01 00:00:00") - 1];
                break;
            case 2:
                return [strtotime("{$year}-04-01 00:00:00"), strtotime("{$year}-07-01 00:00:00") - 1];
                break;
            case 3:
                return [strtotime("{$year}-07-01 00:00:00"), strtotime("{$year}-10-01 00:00:00") - 1];
                break;
            case 4:
                $next_year = $year + 1;
                return [strtotime("{$year}-10-01 00:00:00"), strtotime("{$next_year}-01-01 00:00:00") - 1];
                break;
            default:
                return [0, 0];
                break;
        }
    }

    /**
     * 获取指定月份指定周的开始和结束时间戳
     *
     * @param integer $year
     * @param integer $month
     * @param integer $week
     * @return array
     */
    public function getWeekTimestamps(int $year, int $month, int $week)
    {
        $month_start_time = strtotime("{$year}-{$month}-01");
        $month_end_time   = strtotime(date('Y-m-t 23:59:59', $month_start_time));

        // 1号是周几
        $startWeek = date('N', $month_start_time);

        //第一周结束时间
        $oneWeekEndTime = $month_start_time + 86400 * (8 - $startWeek);

        $diff_time = ($week - 1) * 604800;

        $start_time = $oneWeekEndTime - 604800 + $diff_time;
        $end_time   = $oneWeekEndTime - 1 + $diff_time;

        if ($start_time > $month_end_time || $end_time < $month_start_time) {
            return [0, 0];
        }

        $start_time = $start_time < $month_start_time ? $month_start_time : $start_time;
        $end_time   = $end_time > $month_end_time ? $month_end_time : $end_time;

        return [$start_time, $end_time];
    }
}
