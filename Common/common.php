<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-25
 * Time: 下午4:49
 */

function p($arr){
    echo '<pre>'.print_r($arr,true).'</pre>';
}

function substr_f($str,$separator=','){
    if(!strstr($str,$separator)){
        return $str;
    }
    $tmp = explode($separator,$str);
    return $tmp[0];
}