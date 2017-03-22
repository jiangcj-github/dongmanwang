<?php

namespace App\Util;


class Encode
{
    public static function encode($code) {
        $code = iconv('UTF-8', 'UCS-2', $code);
        $len=strlen($code);
        $c="";
        for($n=0;$n<$len;$n++){
            $char=ord($code[$n]);
            $b1= (int)($char>>4)+97;
            $b2= (int)($char&15)+97;
            $c.=chr($b1).chr($b2);
        }
        return $c;
    }

    public static function decode($code){
        $len=strlen($code);
        $c="";
        for($n=0;$n<$len;$n+=2){
            $b1=(ord($code[$n])-97)<<4;
            $b2=ord($code[$n+1])-97;
            $c.=chr($b1+$b2);
        }
        $c=iconv("UCS-2","UTF-8",$c);
        return $c;
    }
}
