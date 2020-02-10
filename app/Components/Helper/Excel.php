<?php

namespace App\Components\Helper;

use Closure;

class Excel
{

    public static function CheckFormat(Closure $validator)
    {
        return $validator();
    }
}
