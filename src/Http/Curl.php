<?php


namespace YiTool\Http;


use Exception;

class Curl
{
    const REQUEST_TIMEOUT = 10;
    const CONTENT_TYPE_APPLICATION_JSON = 'Content-Type: application/json';

    /**
     * @param string $url
     * @param array $data
     * @return bool|string
     * @throws Exception
     */
    public static function get($url, $data = [])
    {
        return self::request($url, http_build_query($data), [], false);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @param array $headers
     * @param bool $isPost
     * @param int $timeout
     * @param bool $isVerifyHttps
     * @param string $sslCert
     * @param string $sslCertPwd
     * @param string $sslKey
     * @return bool|string
     * @throws Exception
     */
    public static function request(
        $url,
        $data = '',
        $headers = [],
        $isPost = true,
        $timeout = self::REQUEST_TIMEOUT,
        $isVerifyHttps = false,
        $sslCert = 'cert.crt',
        $sslCertPwd = '',
        $sslKey = 'rsa.key'
    )
    {
        $ch = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $timeout,
        ];
        if ($isPost) {
            $options[CURLOPT_POST] = true;
        }
        if (!empty($headers)) {
            $options[CURLOPT_HTTPHEADER] = $headers;
        }
        if ($isVerifyHttps) {
            $options[CURLOPT_SSL_VERIFYPEER] = true;
            $options[CURLOPT_SSL_VERIFYHOST] = 2;
            $options[CURLOPT_SSLCERTTYPE] = 'PEM';
            $options[CURLOPT_SSLCERT] = $sslCert;
            $options[CURLOPT_SSLCERTPASSWD] = $sslCertPwd;
            $options[CURLOPT_SSLKEYTYPE] = 'PEM';
            $options[CURLOPT_SSLKEY] = $sslKey;
        } else {
            $options[CURLOPT_SSL_VERIFYPEER] = false;
            $options[CURLOPT_SSL_VERIFYHOST] = false;
        }
        curl_setopt_array($ch, $options);
        $output = curl_exec($ch);
        if ($output === false) {
            throw new Exception(sprintf("%s[%s]", curl_errno($ch), curl_error($ch)));
        }
        curl_close($ch);
        return $output;
    }

    /**
     * @param string $url
     * @param array $data
     * @return bool|string
     * @throws Exception
     */
    public static function postMultipartFormData($url, $data)
    {
        return self::post($url, $data);
    }

    /**
     * @param string $url
     * @param mixed $data
     * @param array $headers
     * @return bool|string
     * @throws Exception
     */
    public static function post($url, $data, $headers = [])
    {
        return self::request($url, $data, $headers);
    }

    /**
     * @param string $url
     * @param array $data
     * @return bool|string
     * @throws Exception
     */
    public static function postApplicationXWwwFormUrlencoded($url, $data)
    {
        return self::post($url, http_build_query($data));
    }

    /**
     * @param string $url
     * @param array $data
     * @return bool|string
     * @throws Exception
     */
    public static function postApplicationJson($url, $data)
    {
        return self::post($url, json_encode($data), [self::CONTENT_TYPE_APPLICATION_JSON]);
    }

    /**
     * @param string $url
     * @param array $data
     * @param $localFile
     * @return bool|string
     * @throws Exception
     */
    public static function postFile($url, $data, $localFile)
    {
        $data['file'] = curl_file_create($localFile);
        return self::post($url, $data);
    }

    /**
     * @param string $url
     * @param array $data
     * @param $localFiles
     * @return bool|string
     * @throws Exception
     */
    public static function postFiles($url, $data, $localFiles)
    {
        if (!empty($localFiles)) {
            foreach ($localFiles as $localFile) {
                $data['files'][] = curl_file_create($localFile);
            }
        }
        return self::post($url, $data);
    }
}