<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-5-1
 * Time: 下午8:21
 */
class SiteAction extends CommonAction
{
    public function editSite(){
        if(IS_POST){
           if(M('site')->where(array('id'=>1))->save($_POST)){
               $this->success(L('edit_success'),U(GROUP_NAME . '/Site/editSite'));
           }
        }
        $this->result = M('site')->getById(1);
        $this->display();
    }
}