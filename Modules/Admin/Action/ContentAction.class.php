<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-25
 * Time: 下午11:07
 */
class ContentAction extends CommonAction
{
    public function content(){
        $this->display();
    }

    public function left(){
        $category = M('category')->field('id,name,parent_id pid,type,model_table,sort')->order('sort asc,id desc')->select();
        $this->category = node_merge($category);

        $this->display();
    }

    public function right(){
    }
}
