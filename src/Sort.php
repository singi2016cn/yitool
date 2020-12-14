<?php

namespace YiTool;

class Sort
{
    const ASC = 'ASC';
    const DESC = 'DESC';

    const KEY = 'KEY';
    const VALUE = 'VALUE';

    public static function twoDimensionalArray($arr, $key, $value = '', $type = self::ASC)
    {

    }

    public static function twoDimensionalArrayAscSortByKey($arr, $key)
    {

    }

    public static function twoDimensionalArrayDescSortByKey($arr, $key)
    {

    }

    public static function twoDimensionalArrayAscSortByValue($arr, $value)
    {
        $arrCol = array_column($arr, '');
    }

    public static function twoDimensionalArrayDescSortByValue($arr, $value)
    {

    }
}