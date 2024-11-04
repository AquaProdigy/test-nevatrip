<?php

namespace App\Helpers;

class BarCode
{

    /**
     * Return a random bar code value
     * @return int
     */
    public static function generateBarCode(): int
    {
        return mt_rand(10000000, 99999999);
    }
}
