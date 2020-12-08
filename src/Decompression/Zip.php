<?php


namespace YiTool\Decompression;

use Exception;
use RuntimeException;
use YiTool\IO\Dir;
use ZipArchive;

class Zip
{
    /**
     * 压缩文件和内容
     * @param string $zipLocation 'a.zip'
     * @param array $fileNames ['b.php', 'c.txt', ...]
     * @param array $data [['zip_local_name' => 'a.log', 'content' => 'this is content'], ...]
     * @throws RuntimeException
     */
    public static function compress($zipLocation, $fileNames = [], $data = [])
    {
        $zip = new ZipArchive();
        if ($zip->open($zipLocation, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException("cannot open {$zipLocation}");
        }

        if (!empty($fileNames)) {
            foreach ($fileNames as $fileName) {
                $zipFileName = pathinfo($fileName, PATHINFO_BASENAME);
                $zip->addFile($fileName, $zipFileName);
            }
        }

        if (!empty($data)) {
            foreach ($data as $item) {
                if (!empty($item)) {
                    $zip->addFromString($item['zip_local_name'] ?? '', $item['content'] ?? '');
                }
            }
        }

        $zip->close();
        return $zip->status;
    }

    /**
     * 压缩某个目录
     * @param string $zipLocation
     * @param string $dir
     * @return mixed
     * @throws Exception
     */
    public static function compressDir($zipLocation, $dir)
    {
        $fileNames = Dir::getFilesFromDir($dir);
        return self::compress($zipLocation, $fileNames);
    }

    /**
     * 压缩多个文件
     * @param string $zipLocation
     * @param array $fileNames
     * @return mixed
     * @throws Exception
     */
    public static function compressFiles($zipLocation, $fileNames)
    {
        return self::compress($zipLocation, $fileNames);
    }

    /**
     * 压缩数据
     * @param string $zipLocation
     * @param array $data
     * @return mixed
     * @throws Exception
     */
    public static function compressData($zipLocation, $data)
    {
        return self::compress($zipLocation, [], $data);
    }
}