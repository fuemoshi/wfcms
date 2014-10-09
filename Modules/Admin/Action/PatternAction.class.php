<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-26
 * Time: 下午10:05
 */
class PatternAction extends CommonAction{

    /*
     * 目前每种模式的功能差不多，后期应该考虑整合
     * */
    public function index(){
        if($model_table = I('model_table')){
            $url = U(GROUP_NAME . '/' .ucfirst($model_table) . '/index',$_REQUEST);
            $this->redirect($url);
        }
    }

}