<?php


namespace YiTool\Crypto;


class Aes
{
    /**
     * 加密
     * @param string $plainText 待加密文本
     * @param string $key 秘钥
     * @param string $method 算法
     * @return string
     */
    public static function encrypt($plainText, $key, $method = Algorithm::ALGORITHM_AES_256_CBC)
    {
        $ivLen = openssl_cipher_iv_length($method);
        $iv = openssl_random_pseudo_bytes($ivLen);
        $cipherTextRaw = openssl_encrypt($plainText, $method, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac(Algorithm::ALGORITHM_SHA256, $cipherTextRaw, $key, TRUE);
        return base64_encode($iv . $hmac . $cipherTextRaw);
    }

    /**
     * 解密
     * @param string $cipherText 待解密文本
     * @param string $key 秘钥
     * @param string $method 算法
     * @return string|bool
     */
    public static function decrypt($cipherText, $key, $method = Algorithm::ALGORITHM_AES_256_CBC)
    {
        $c = base64_decode($cipherText);
        $ivLen = openssl_cipher_iv_length($method);
        $iv = substr($c, 0, $ivLen);
        $hmac = substr($c, $ivLen, $sha2len = 32);
        $cipherTextRaw = substr($c, $ivLen + $sha2len);
        $originalPlainText = openssl_decrypt($cipherTextRaw, $method, $key, OPENSSL_RAW_DATA, $iv);
        $calCmac = hash_hmac(Algorithm::ALGORITHM_SHA256, $cipherTextRaw, $key, TRUE);
        if (function_exists('hash_equals')) {
            if (hash_equals($hmac, $calCmac)) {
                return $originalPlainText;
            } else {
                return false;
            }
        } else {
            if ($hmac === $calCmac) {
                return $originalPlainText;
            } else {
                return false;
            }
        }
    }
}