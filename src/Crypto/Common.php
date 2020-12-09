<?php


namespace YiTool\Crypto;


class Common
{
    public static function uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * @param int $len 加密长度
     * @return string
     */
    public static function token($len = 32)
    {
        return substr(base64_encode(openssl_random_pseudo_bytes($len)), 0, $len);
    }
}