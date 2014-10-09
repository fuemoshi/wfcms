<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-28
 * Time: 下午3:09
 */
class PersonalAction extends CommonAction{

    public function editProfile(){
        $uid = $_SESSION[C('USER_AUTH_KEY')];
        if(IS_POST){
            $rules = array();
            if(!isset($_POST['state'])){

                if($_POST['password'] == '' ){
                    unset($_POST['password']);
                }else{
                    $_POST['password'] = md5($_POST['password']);
                }
                $rules = array(
                    array('email','email',L('email_format_error'),2),
                    array('phone','number',L('phone_format_error'),2),
                    array('id',$uid,L('illegal_submit'),1,'equal')
                );
            }else{
                $_POST['state'] = 0;
            }
            $User = M('admin_user');
            if(!$User->validate($rules)->create($_POST)){
                $this->error($User->getError());
            }else{
                if($User->save()){
                    $this->success(L('edit_success'),U(GROUP_NAME . '/Personal/editProfile'));
                }else{
                    $this->error(L('edit_error'));
                }
            }
        }else{
            $this->user = M('admin_user')->where(array('id'=>$uid))->find();
            $this->display();
        }
    }

}