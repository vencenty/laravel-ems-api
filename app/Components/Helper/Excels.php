<?php

namespace App\Components\Helper;

use Closure;

class Excels
{

    /**
     * 生成Excel下载文件名
     *
     * @param $filename
     * @param string $ext
     * @return string
     */
    public static function generateFileName($filename, $ext = '.xlsx')
    {
        $hash = uniqid(md5(microtime()));
        return $filename . "_" . $hash . $ext;
    }


    /**
     * 根据身份证生成密码
     *
     * @param $identity
     * @param int $passwordLength
     * @return string
     */
    public static function generatePasswordByIdentity($identity, $passwordLength = -6)
    {
        return bcrypt(mb_substr($identity, $passwordLength));
    }

    /**
     * 格式化Excel里面的时间
     *
     * @param $excelDateString
     * @param string $format
     * @return false|string
     */
    public static function formatDate($excelDateString, $format = 'Y-m-d H:i:s')
    {
        return date($format, ($excelDateString - 25569) * 24 * 3600);
    }

}
