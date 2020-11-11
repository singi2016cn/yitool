<?php


namespace YiTool\IO;


class Csv
{
    /**
     * @param string $fileName
     * @return array
     */
    public static function get($fileName)
    {
        $row = 1;
        $res = [];
        if (($handle = fopen($fileName, "rb")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $row++;
                $item = [];
                $num = count($data);
                for ($c = 0; $c < $num; $c++) {
                    $item[] = $data[$c];
                }
                $res[] = $item;
            }
            fclose($handle);
        }
        return $res;
    }

    /**
     * @param array $list
     * @param string $fileName
     * @return bool
     */
    public static function set($list, $fileName)
    {
        if (empty($list)) {
            return false;
        }
        if (empty($fileName)) {
            return false;
        }
        $fp = fopen($fileName, 'w+b');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        return true;
    }
}