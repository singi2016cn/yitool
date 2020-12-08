<?php

namespace YiTool;

use UnexpectedValueException;

class Common
{
    /**
     * 获取N位数
     * @param int $digit
     * @param int $min
     * @param int $max
     * @return string
     * @throws UnexpectedValueException
     */
    public static function integerDigit($digit = 1, $min = 0, $max = 9): string
    {
        if ($digit < 1) {
            throw new UnexpectedValueException('digit must gt 0');
        }
        $res = '';
        for ($i = 0; $i < $digit; $i++) {
            $res .= mt_rand($min, $max);
        }
        return $res;
    }

    /**
     * 获取[...]范围中的位数
     * @param array $digitRange
     * @param int $min
     * @param int $max
     * @return string
     * @throws UnexpectedValueException
     */
    public static function integerDigitRange($digitRange = [1], $min = 0, $max = 9): string
    {
        if (empty($digitRange)) {
            throw new UnexpectedValueException('digitRange required');
        }
        if (is_array($digitRange) === false) {
            throw new UnexpectedValueException('digitRange must be array');
        }
        $res = '';
        $digit = $digitRange[array_rand($digitRange)];
        for ($i = 0; $i < $digit; $i++) {
            $res .= mt_rand($min, $max);
        }
        return $res;
    }
}