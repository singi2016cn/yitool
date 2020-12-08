<?php


namespace YiTool\Faker\ZhCn;


use UnexpectedValueException;

class Character
{
    /**
     * 生成N个随机汉字
     * @param int $num 个数
     * @return string
     */
    public static function chinese($num = 1): string
    {
        $res = '';
        for ($i = 0; $i < $num; $i++) {
            $GB2312 = chr(mt_rand(0xB0, 0xD0)) . chr(mt_rand(0xA1, 0xF0));
            $res .= iconv('GB2312', 'UTF-8', $GB2312);
        }
        return $res;
    }

    /**
     * 生成[...]个随机汉字
     * @param array $numRange
     * @return string
     */
    public static function chineseRange($numRange = [1]): string
    {
        if (empty($numRange)) {
            throw new UnexpectedValueException('numRange required');
        }
        $num = $numRange[array_rand($numRange)];
        return self::chinese($num);
    }
}