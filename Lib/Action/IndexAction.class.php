<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-26
 * Time: 下午1:17
 */

class IndexAction extends Action{
    function index(){
        echo C("APP_GROUP_PATH");
    }
}