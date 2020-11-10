<?php


namespace YiTool\Crypto;


class Rsa
{
    const ENCRYPT_BYTE = 2048;

    /**
     * 获取对应加密位数的最大长度
     * @param int $encryptByte 位数
     * @return float|int
     */
    public static function getEncryptMaxLength($encryptByte)
    {
        return $encryptByte / 8 - 11;
    }

    /**
     * 获取对应解密位数的最大长度
     * @param int $encryptByte 位数
     * @return float|int
     */
    public static function getDecryptMaxLength($encryptByte)
    {
        return $encryptByte / 8;
    }

    /**
     * 获取公钥私钥
     * @param array $config
     * @return array|false
     */
    public static function getPublicKeyAndPrivateKey($config = [])
    {
        $resource = openssl_pkey_new($config);
        if ($resource === FALSE) {
            return FALSE;
        }
        openssl_pkey_export($resource, $privateKey, null, $config);
        $detail = openssl_pkey_get_details($resource);
        return ['public_key' => $detail['key'], 'private_key' => $privateKey];
    }

    /**
     * 公钥加密,明文加密时的长度为[2048bit/8-11]=245,过长会加密失败
     * @param string $plaintext
     * @param string $publicKey
     * @param int $encryptByte 单次最大加密长度
     * @return string
     */
    public static function encrypt($plaintext, $publicKey, $encryptByte = self::ENCRYPT_BYTE)
    {
        $crypto = '';
        if ($plaintext) {
            foreach (str_split($plaintext, self::getEncryptMaxLength($encryptByte)) as $chunk) {
                openssl_public_encrypt($chunk, $encryptData, $publicKey);
                $crypto .= $encryptData;
            }
            $crypto = base64_encode($crypto);
        }
        return $crypto;
    }

    /**
     * 私钥解密
     * @param string $encryptData
     * @param string $privateKey
     * @param int $encryptByte 单次最大解密长度
     * @return string
     */
    public static function decrypt($encryptData, $privateKey, $encryptByte = self::ENCRYPT_BYTE)
    {
        $crypto = '';
        foreach (str_split(base64_decode($encryptData), self::getDecryptMaxLength($encryptByte)) as $chunk) {
            openssl_private_decrypt($chunk, $decryptData, $privateKey);
            $crypto .= $decryptData;
        }
        return $crypto;
    }


    /**
     * 私钥签名
     * @param string $originalStr
     * @param string $privateKey
     * @param int $alg
     * @return string
     */
    public static function sign($originalStr, $privateKey, $alg = OPENSSL_ALGO_SHA1)
    {
        $key = openssl_get_privatekey($privateKey);
        openssl_sign($originalStr, $sign, $key, $alg);
        openssl_free_key($key);
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * 公钥验签
     * @param string $originalStr
     * @param string $sign
     * @param string $publicKey
     * @param int $alg
     * @return boolean
     */
    public static function checkSign($originalStr, $sign, $publicKey, $alg = OPENSSL_ALGO_SHA1)
    {
        $sign = base64_decode($sign);
        $publicKeyResource = openssl_get_publickey($publicKey);
        $result = openssl_verify($originalStr, $sign, $publicKeyResource, $alg);
        openssl_free_key($publicKeyResource);
        return $result === 1 ? TRUE : FALSE;
    }
}