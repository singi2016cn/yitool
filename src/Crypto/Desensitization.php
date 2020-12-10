<?php


namespace YiTool\Crypto;


use YiTool\Faker\ZhCn\Character;
use YiTool\Validate;

class Desensitization
{
    const ENCRYPT_CHAR = '*';

    const ALL = 1;//全部
    const PART = 2;//部分

    /**
     * 无效化，用特殊字符（*等）代替真值
     * @param string $val
     * @param int $type
     * @param int $start
     * @param int $len
     * @param string $encryptChar
     * @return string
     */
    public static function invalidation($val, $type = self::ALL, $start = 0, $len = 1, $encryptChar = self::ENCRYPT_CHAR)
    {
        if (empty($val)) {
            throw new \UnexpectedValueException('val required');
        }
        if (!in_array($type, [self::ALL, self::PART])) {
            throw new \UnexpectedValueException(sprintf('type must in %s,%s', self::ALL, self::PART));
        }

        if ($type == self::ALL) {
            $resArr = array_fill(0, mb_strlen($val), $encryptChar);
            $res = implode('', $resArr);
        } else {
            $res = $val;
            $resLen = mb_strlen($res);
            $k = 0;
            for ($i = 0; $i < $resLen; $i++) {
                if ($i >= $start) {
                    if ($len > $k) {
                        $res[$i] = $encryptChar;
                        $k++;
                    }
                }
            }
        }

        return $res;
    }

    /**
     * 随机值，字母变为随机字母，数字变为随机数字，文字随机替换文字
     * @param string $val
     * @return string
     */
    public static function random($val)
    {
        if (empty($val)) {
            throw new \UnexpectedValueException('val required');
        }
        $res = '';
        for ($i = 0; $i < mb_strlen($val); $i++) {
            $valItem = mb_substr($val, $i, 1);
            $res .= $valItem;
            if (Validate::isUppercaseLetter($valItem)) {
                $res .= Character::uppercaseLetter();
            } elseif (Validate::isLowercaseLetter($valItem)) {
                $res .= Character::lowercaseLetter();
            } elseif (is_numeric($valItem)) {
                $res .= mt_rand(0, 9);
            } elseif (Validate::isChineseChar($valItem)) {
                $res .= Character::chinese();
            }
        }
        return $res;
    }

    /**
     * 平均值
     * @param array $arrVal
     * @param int $offset
     * @return array
     */
    public static function average($arrVal, $offset = 0)
    {
        if (empty($arrVal)) {
            throw new \UnexpectedValueException('arrVal required');
        }

        $count = count($arrVal);
        $sum = array_sum($arrVal);
        $average = round($sum / $count, 2);

        $res = [];
        $left = $sum;
        $isZero = false;
        for ($i = 0; $i < count($arrVal); $i++) {
            if ($isZero) {
                $res[] = 0;
                continue;
            }
            $tmp = mt_rand($average * 100, ($average + $offset) * 100) / 100;
            if ($left < $tmp) {
                $res[] = $left;
                $isZero = true;
                continue;
            }
            $left -= $tmp;
            $res[] = $tmp;
        }

        return $res;
    }
}