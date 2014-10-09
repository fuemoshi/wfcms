<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-25
 * Time: 上午10:50
 */
class CommonAction extends Action{

    protected $_userId = '';

    function _initialize(){
        if(!isset($_SESSION[C('USER_AUTH_KEY')])){
            $this->redirect( GROUP_NAME . '/Login/index');
        }

        if(C('USER_AUTH_ON')){
            import('ORG.Util.RBAC');
            RBAC::AccessDecision(GROUP_NAME) || $this->error(L('not_permission'));
        }

        $this->_userId = session(C('USER_AUTH_KEY'));
    }

}