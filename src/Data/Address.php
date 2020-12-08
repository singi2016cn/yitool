<?php


namespace YiTool\Data;


class Address
{
    const DATA_PATH = __DIR__ . DIRECTORY_SEPARATOR;

    /**
     * 获取省
     * @return array
     */
    public static function province()
    {
        $json = file_get_contents(self::DATA_PATH . 'json/province.json');
        return json_decode($json, true);
    }

    /**
     * 市
     * @param string $provinceCode 省编码
     * @return array
     */
    public static function city($provinceCode = '')
    {
        $json = file_get_contents(self::DATA_PATH . 'json/city.json');
        $cities = json_decode($json, true);
        $res = [];
        if (!empty($cities)) {
            foreach ($cities as $k => $city) {
                if (in_array($city['name'], ['市辖区'])) {
                    continue;
                }
                if (!empty($provinceCode)) {
                    if ($city['provinceCode'] != $provinceCode) {
                        continue;
                    }
                }
                $res[] = $city;
            }
        }
        return $res;
    }

    /**
     * 区
     * @param string $cityCode 市编码
     * @return array
     */
    public static function area($cityCode = '')
    {
        $json = file_get_contents(self::DATA_PATH . 'json/area.json');
        $areas = json_decode($json, true);
        $res = [];
        if (!empty($areas)) {
            foreach ($areas as $k => $area) {
                if (!empty($cityCode)) {
                    if ($area['cityCode'] != $cityCode) {
                        continue;
                    }
                }
                $res[] = $area;
            }
        }
        return $res;
    }
}