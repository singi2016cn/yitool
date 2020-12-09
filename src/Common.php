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
            throw new UnexpectedValueException('digit must > 0');
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

    /**
     * 下划线转驼峰
     * 1.原字符串转小写,原字符串中的分隔符用空格替换,在字符串开头加上分隔符
     * 2.将字符串中每个单词的首字母转换为大写,再去空格,去字符串首部附加的分隔符.
     * @param string $unCamelizeWords 下划线字符串
     * @param string $separator 分隔符
     * @return string
     */
    public static function camelize($unCamelizeWords, $separator = '_')
    {
        $unCamelizeWords = $separator . str_replace($separator, " ", strtolower($unCamelizeWords));
        return ltrim(str_replace(" ", "", ucwords($unCamelizeWords)), $separator);
    }

    /**
     * 驼峰命名转下划线命名
     * 小写和大写紧挨一起的地方,加上分隔符,然后全部转小写
     * @param string $camelCaps 驼峰命名字符串
     * @param string $separator 转换后的分隔符
     * @return string
     */
    public static function unCamelize($camelCaps, $separator = '_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }
}