<?php

namespace App\Services;

class PasswordService
{
    function generate($size=8)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result),0, $size);
    }


}
