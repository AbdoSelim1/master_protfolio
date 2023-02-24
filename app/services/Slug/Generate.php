<?php

namespace App\services\Slug;

class Generate
{

    public static function generate(string $key): string
    {
        return str_replace(' ', '-', $key) . "protfolio" . rand(1, 999);
    }
}
