<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-25
 * Time: 下午5:41
 */
class SelectorTreeWidget extends Widget
{
    public function render($data){
        echo '<select name="parent_id" id="parent_id"><option value="0">≡ 作为一级栏目 ≡</option>';
        traverseTree($data,'selector');
        echo '</select>';
    }
}