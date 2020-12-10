<?php

namespace YiTool;

class Validate
{
    /**
     * 是否是26个大小写字母
     * @param string $val
     * @return bool
     */
    public static function isLetter($val)
    {
        return preg_match("/^[a-zA-Z]+$/", $val, $res) === 1 ? true : false;
    }

    /**
     * 是否是26个小写字母
     * @param string $val
     * @return bool
     */
    public static function isLowercaseLetter($val)
    {
        return preg_match("/^[a-z]+$/", $val, $res) === 1 ? true : false;
    }

    /**
     * 是否是26个小写字母
     * @param string $val
     * @return bool
     */
    public static function isUppercaseLetter($val)
    {
        return preg_match("/^[A-Z]+$/", $val, $res) === 1 ? true : false;
    }

    /**
     * 是否是汉字
     * @param string $val
     * @return bool
     */
    public static function isChineseChar($val)
    {
        return preg_match("/^[\x7f-\xff]+$/", $val) === 1 ? true : false;
    }
}