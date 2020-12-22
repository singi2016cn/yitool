<?php

namespace YiTool;

use UnexpectedValueException;

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

    /**
     * 根据二维数组的key正序
     * @param array $arr
     * @param string $rowKey
     * @param int $flag
     * @return array
     * @throws UnexpectedValueException
     */
    public static function sortByValue($arr, $rowKey, $flag = SORT_REGULAR)
    {
        $arrCol = array_column($arr, $rowKey);
        if (empty($arrCol)) {
            throw new UnexpectedValueException('rowKey not exist');
        }
        sort($arrCol, $flag);
        $res = [];
        foreach ($arrCol as $arrColItem) {
            foreach ($arr as $item) {
                if ($arrColItem == $item[$rowKey]) {
                    $res[] = $item;
                    break;
                }
            }
        }
        return $res;
    }
}