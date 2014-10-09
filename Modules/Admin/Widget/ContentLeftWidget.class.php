<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-25
 * Time: 下午5:41
 */
class ContentLeftWidget extends Widget
{
    public function render($data){
        $categoryList = array();
        traverseTree($data,"contentLeft",0,$categoryList,'beforeLeft','afterLeft');
    }
}