<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-24
 * Time: 下午4:43
 */
class IndexAction extends CommonAction {

    public function index(){

        $this->assign('username',session('username'));
        $menu = C('menu');
        $accessMenu = transToAccessMenu($menu);
        $this->topMenu = $accessMenu['topMenu'];
        $this->jsonMenu = $accessMenu['jsonMenu'];

        $this->display();
    }

    public function logout(){
        uLog();
        session_unset();
        session_destroy();
        redirect(U(GROUP_NAME.'/Index/index'));
    }

}
