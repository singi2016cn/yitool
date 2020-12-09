<?php

namespace YiTool;

use UnexpectedValueException;

class Time
{
    const SECONDS_OF_DAY = 86400;
    const SECONDS_OF_HOUR = 3600;
    const SECONDS_OF_MINUTES = 60;

    const MINUTES_OF_DAY = 1440;
    const MINUTES_OF_HOUR = 60;

    const HOURS_OF_DAY = 24;

    public static function format($seconds)
    {
        $leftSeconds = $seconds;
        if ($leftSeconds > self::SECONDS_OF_DAY) {
            $days = self::seconds2Days($leftSeconds);
            $leftSeconds -= (self::SECONDS_OF_DAY * $days);
        }
        if ($leftSeconds > self::SECONDS_OF_HOUR) {
            $hours = self::seconds2Hours($leftSeconds);
            $leftSeconds -= (self::SECONDS_OF_HOUR * $hours);
        }
        if ($leftSeconds > self::SECONDS_OF_MINUTES) {
            $minutes = self::seconds2minutes($leftSeconds);
            $leftSeconds -= (self::SECONDS_OF_MINUTES * $minutes);
        }
        return (empty($days) ? '' : $days . '天') . (empty($hours) ? '' : $hours . '时') . (empty($minutes) ? '' : $minutes . '分') . $leftSeconds . '秒';
    }

    public static function seconds2Days($seconds, $isDecimal = false)
    {
        if ($seconds < 0) {
            throw new UnexpectedValueException('seconds must >= 0');
        }
        $days = $seconds / self::SECONDS_OF_DAY;
        $res = intval($days);
        if ($isDecimal) {
            $res = round($days, 2);
        }
        return $res;
    }

    public static function seconds2Hours($seconds, $isDecimal = false)
    {
        if ($seconds < 0) {
            throw new UnexpectedValueException('seconds must >= 0');
        }
        $hours = $seconds / self::SECONDS_OF_HOUR;
        $res = intval($hours);
        if ($isDecimal) {
            $res = round($hours, 2);
        }
        return $res;
    }

    public static function seconds2minutes($seconds, $isDecimal = false)
    {
        if ($seconds < 0) {
            throw new UnexpectedValueException('seconds must >= 0');
        }
        $minutes = $seconds / self::SECONDS_OF_MINUTES;
        $res = intval($minutes);
        if ($isDecimal) {
            $res = round($minutes, 2);
        }
        return $res;
    }

    public static function minutes2Hours($minutes, $isDecimal = false)
    {
        if ($minutes < 0) {
            throw new UnexpectedValueException('minutes must >= 0');
        }
        $hours = $minutes / self::MINUTES_OF_HOUR;
        $res = intval($hours);
        if ($isDecimal) {
            $res = round($hours, 2);
        }
        return $res;
    }

    public static function minutes2Days($minutes, $isDecimal = false)
    {
        if ($minutes < 0) {
            throw new UnexpectedValueException('minutes must >= 0');
        }
        $days = $minutes / self::MINUTES_OF_DAY;
        $res = intval($days);
        if ($isDecimal) {
            $res = round($days, 2);
        }
        return $res;
    }

    public static function hours2Days($hours, $isDecimal = false)
    {
        if ($hours < 0) {
            throw new UnexpectedValueException('hours must >= 0');
        }
        $days = $hours / self::HOURS_OF_DAY;
        $res = intval($days);
        if ($isDecimal) {
            $res = round($days, 2);
        }
        return $res;
    }
}