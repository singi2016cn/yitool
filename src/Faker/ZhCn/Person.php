<?php


namespace YiTool\Faker\ZhCn;

use UnexpectedValueException;
use YiTool\Common;
use YiTool\Data\Address;
use YiTool\Data\Person as PersonConfig;

class Person
{
    /**
     * 姓名
     * @param int $surnameNum 姓字数
     * @param int $nameNum 名字数
     * @return string
     */
    public static function fullName($surnameNum = 1, $nameNum = 1): string
    {
        return self::surname($surnameNum) . self::name($nameNum);
    }

    /**
     * 姓
     * @param int $num 字数
     * @return string
     * @see \YiTool\Data\Config::surname
     * @see \YiTool\Data\Config::compoundSurname
     */
    public static function surname($num = 1): string
    {
        if (!in_array($num, [1, 2])) {
            throw new UnexpectedValueException('num in 1,2');
        }
        $config = PersonConfig::surname;
        if ($num == 2) {
            $config = PersonConfig::compoundSurname;
        }
        $index = Common::integerDigit(1, 1, count($config) - 1);
        return $config[$index] ?? '';
    }

    /**
     * 名
     * @param int $num 字数
     * @return string
     * @throws UnexpectedValueException
     */
    public static function name($num = 2): string
    {
        if (!in_array($num, [1, 2])) {
            throw new UnexpectedValueException('num in 1,2');
        }
        $res = Character::chinese($num);
        return $res;
    }

    /**
     * 地址
     * 省市区是真实数据，详细地址是虚拟数据
     */
    public static function address(): string
    {
        $province = Address::province();
        $provinceIndex = mt_rand(0, count($province) - 1);
        $provinceItem = $province[$provinceIndex] ?? [];

        $cities = Address::city($provinceItem['code']);
        $citiesIndex = mt_rand(0, count($cities) - 1);
        $citiesItem = $cities[$citiesIndex] ?? [];

        $areas = Address::area($citiesItem['code']);
        $areasIndex = mt_rand(0, count($areas) - 1);
        $areasItem = $areas[$areasIndex] ?? [];

        $detail = sprintf('%s街%s号', Character::chineseRange([2, 3, 4, 5]), Common::integerDigit(1, 1, 1000));

        return $provinceItem['name'] . $citiesItem['name'] . $areasItem['name'] . $detail;
    }

    /**
     * 座机号码
     */
    public static function telephoneNumber(): string
    {
        return Common::integerDigit(3) . '-' . Common::integerDigitRange([7, 8]);
    }

    /**
     * 电话号码
     */
    public static function mobileNumber(): string
    {
        return '1' . Common::integerDigit(10);
    }
}