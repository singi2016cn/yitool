<?php


namespace YiTool\Crypto;


class Des
{
    /**
     * 3DES加密
     * @param string $plainText 待加密的数据
     * @param string $key 加密密钥
     * @param string $method 算法
     * @return string
     */
    public static function encrypt($plainText, $key, $method = Algorithm::ALGORITHM_DES_EDE3)
    {
        return base64_encode(openssl_encrypt($plainText, $method, $key));
    }

    /**
     * 3DES解密
     * @param string $cipherText 待解密的数据
     * @param string $key 解密密钥
     * @param string $method 算法
     * @return string
     */
    public static function decrypt($cipherText, $key, $method = Algorithm::ALGORITHM_DES_EDE3)
    {
        return openssl_decrypt(base64_decode($cipherText), $method, $key);
    }
}