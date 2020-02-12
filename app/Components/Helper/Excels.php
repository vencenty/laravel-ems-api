<?php

namespace App\Components\Helper;

use Closure;

class Excels
{
    public static function CheckFormat(Closure $validator)
    {
        return $validator();
    }


    public static function generateFileName($filename, $ext = '.xlsx')
    {
        $hash = uniqid(md5(microtime()));
        return $filename . "_" . $hash . $ext;
    }


}
