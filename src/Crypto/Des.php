<?php


namespace YiTool\Crypto;


class Des
{
    /**
     * 3DES加密
     * @param string $data 待加密的数据
     * @param string $key 加密密钥
     * @return string
     */
    public static function encrypt($data, $key)
    {
        return base64_encode(openssl_encrypt($data, Algorithm::ALGORITHM_DES_EDE3, $key));
    }

    /**
     * 3DES解密
     * @param string $data 待解密的数据
     * @param string $key 解密密钥
     * @return string
     */
    public static function decrypt($data, $key)
    {
        return openssl_decrypt(base64_decode($data), Algorithm::ALGORITHM_DES_EDE3, $key);
    }
}