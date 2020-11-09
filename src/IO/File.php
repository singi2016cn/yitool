<?php


namespace YiTool\IO;


use CURLFile;

class File
{
    const TEMPNAM_PREFIX = 'prefix';
    const APPLICATION_OCTET_STREAM = 'application/octet-stream';

    /**
     * 获取本地临时文件路径
     * @return bool|string
     */
    public static function getLocalFile()
    {
        return tempnam(sys_get_temp_dir(), self::TEMPNAM_PREFIX);
    }

    /**
     * 从 URL 返回本地文件地址
     * @param string $url
     * @return bool|string
     */
    public static function getLocalFileFromUrl($url)
    {
        $localFile = self::getLocalFile();
        file_put_contents($localFile, file_get_contents($url));
        return $localFile;
    }

    /**
     * 从 URL 返回表单文件格式数组
     * @param string $url
     * @return array
     */
    public static function getFormFileFromUrl($url)
    {
        $localFile = self::getLocalFileFromUrl($url);
        $mimeType = self::getFileMimeTypeFormFileName($localFile);
        $formFile['type'] = $mimeType;
        $formFile['size'] = filesize($localFile);
        $formFile['temp_name'] = $localFile;
        $formFile['error'] = UPLOAD_ERR_OK;
        return $formFile;
    }

    /**
     * 从 URL 获取 CURLFile
     * @param string $url
     * @return CURLFile
     */
    public static function getCurlFileFromUrl($url)
    {
        $localFile = self::getLocalFileFromUrl($url);
        $mimeType = self::getFileMimeTypeFormFileName($localFile);
        $postName = pathinfo($localFile, PATHINFO_BASENAME);
        return curl_file_create($localFile, $mimeType, $postName);
    }

    /**
     * 从本地文件获取文件 mimeType 类型
     * @param string $localFile
     * @return mixed|string
     */
    public static function getFileMimeTypeFormFileName($localFile)
    {
        $mimeType = self::APPLICATION_OCTET_STREAM;
        if (function_exists('finfo_file')) {
            $mimeType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $localFile);
        }
        return $mimeType;
    }

    /**
     * 文件转 base64
     * @param string $fileName
     * @param string $mimeType
     * @return string
     */
    public static function file2Base64($fileName, $mimeType = '')
    {
        $base64Template = 'data:%s;base64,%s';
        if (empty($mimeType)){
            $mimeType = self::getFileMimeTypeFormFileName($fileName) ?: self::APPLICATION_OCTET_STREAM;
        }
        $base64 = base64_encode(file_get_contents($fileName));
        return sprintf($base64Template, $mimeType, $base64);
    }

    /**
     * base64 转文件
     * @param string $base64
     * @param string $fileName
     * @return bool|int
     */
    public static function base642File($base64, $fileName = '')
    {
        $fileName = $fileName ?: self::getLocalFile();
        $res = file_put_contents($fileName, base64_decode(explode(',', $base64)[1]));
        return $res !== FALSE ? $fileName : FALSE;
    }

}