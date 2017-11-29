<?php
/**
 * Created by PhpStorm.
 * User: foxit
 * Date: 10.11.2017
 * Time: 11:59
 */

namespace frontend\components;

class StringHelper
{

    public static function dateFormmat($string)
    {
        $pos=mb_strpos($string, 'T');
        $string=mb_substr($string,0,$pos);
        $string=preg_replace('#(\d+)-(\d+)-(\d+)#','$3/$2/$1', $string);
        return $string;
    }

    public static function companyName($string)
    {
        return preg_replace('#([a-zа-яё]+)([\s\.]+)([a-z\sа-яё]+)#iu','$1',$string);
    }


}