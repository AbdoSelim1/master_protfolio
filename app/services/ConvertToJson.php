<?php
namespace App\services;

class ConvertToJson
{
    public static function convert(array $arr)
    {
        foreach ($arr as $index => $value) {
            if (is_null($value)) {
                unset($arr[$index]);
            }
        }
        return json_encode($arr);
    }
}
