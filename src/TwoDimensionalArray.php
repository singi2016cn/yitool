<?php

namespace YiTool;

class TwoDimensionalArray
{
    /**
     * 返回下标0的keys
     * @param array $arr 二维数组
     * @return array
     */
    public static function index0Keys($arr)
    {
        return array_keys(($arr[0] ?? []) ?: []);
    }
}