<?php


namespace YiTool\IO;

use RuntimeException;
use UnexpectedValueException;

class Dir
{
    const CURRENT_DIR = '.';
    const UPPER_DIR = '..';

    /**
     * 获取某个目录下所有文件
     * @param string $dir
     * @param bool $isFilterCurrentAndUpperDir
     * @return array
     * @throws UnexpectedValueException
     */
    public static function getFilesFromDir($dir = self::CURRENT_DIR, $isFilterCurrentAndUpperDir = true)
    {
        if (is_dir($dir) === false) {
            throw new UnexpectedValueException("{$dir} is not a directory");
        }
        $files = [];
        if ($handle = opendir($dir)) {
            if ($handle === false) {
                throw new RuntimeException("{$dir} open failed");
            }
            while (false !== ($file = readdir($handle))) {
                $isAddFile = false;
                if ($isFilterCurrentAndUpperDir) {
                    if (!in_array($file, [self::CURRENT_DIR, self::UPPER_DIR])) {
                        $isAddFile = true;
                    }
                } else {
                    $isAddFile = true;
                }
                if ($isAddFile) {
                    $files[] = realpath($dir) . DIRECTORY_SEPARATOR . $file;
                }
            }
            closedir($handle);
        }
        return $files;
    }
}