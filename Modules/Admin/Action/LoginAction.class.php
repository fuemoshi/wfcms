<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-25
 * Time: 上午10:55
 */
class LoginAction extends Action{

    function index(){
        $this->display();
    }

    function login(){

        if(!IS_POST) halt(L('page_error'));

        $verify   = I('verify','','md5');

        if($verify != session('verify')){
            $this->error(L('verify_error'));
        }
        $user = M('admin_user')->where(array('username'=>I('username')))->find();

        if(!$user || $user['password'] != I('password','','md5')){
            $this->error(L('user_or_pwd_error'));
        }

        $login_date = date('Y-m-d H:i:s');

        $data = array(
            'id' => $user['id'],
            'last_login_date' => $login_date,
            'last_login_ip' => get_client_ip()
        );
        M('admin_user')->save($data);

        session(C('USER_AUTH_KEY'),$user['id']);
        session('username',$user['username']);
        session('last_login_date',$login_date);
        session('last_login_ip',get_client_ip());

        if($user['username'] == C('RBAC_SUPERADMIN')){
            session(C('ADMIN_AUTH_KEY'),true);
        }
        import('ORG.Util.RBAC');

        RBAC::saveAccessList();

        uLog();

        redirect(U(GROUP_NAME . '/Index/index'));
    }
}
