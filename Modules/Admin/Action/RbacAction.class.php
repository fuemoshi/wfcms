<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-26
 * Time: 下午3:32
 */
class RbacAction extends CommonAction{

    public function index(){

    }

    //角色管理
    public function role(){
        $this->role = M('admin_role')->select();
        $this->display();
    }

    public function addRole(){
        $this->display();
    }

    public function addRoleHandler(){
        if(M('admin_role')->create($_POST,1) && M('admin_role')->add()){
            $this->success(L('add_success'),U(GROUP_NAME . '/Rbac/role'));
        }else{
            $this->error(L('add_error'));
        }
    }

    public function editRole(){
        $rid = I('id');
        if(IS_POST && $rid && M('admin_role')->save($_POST)){
               $this->success(L('edit_success'),U(GROUP_NAME . '/Rbac/role'));
        }else{
            $this->role = M('admin_role')->where(array('id'=>$rid))->find();
            $this->display();
        }
    }

    public function delRole(){
        if($rid = I('id')){
            if(M('admin_role_user')->where(array('role_id'=>$rid))->count()){
                $this->error(L('has_role_user'));
            }else{
                M('admin_access')->where(array('role_id'=>$rid))->delete();
                M('admin_role')->where(array('id'=>$rid))->delete();
                $this->success(L('del_success'),U(GROUP_NAME . '/Rbac/role'));
            }
        }else{
            $this->error(L('del_error'));
        }
    }

    //节点管理
    /*
     * node
     *  level smallint 1:应用 2:控制器 3:控制器中的方法
     * */
    public function node(){
        $field = array('id','name','title','pid');
        $node = M('admin_node')->field($field)->order("sort")->select();
        $this->node = node_merge($node);
        $this->display();
    }

    public function addNode(){
        $this->pid = I('pid',0,'intval');
        $this->level = I('level',1,'intval');

        $this->type = $this->level == 1 ? '应用' : ( $this->level == 2 ? '控制器' : ($this->level == 3 ? '动作方法' : '未知'));
        $this->display();
    }

    public function addNodeHandler(){
        if(M('admin_node')->autoCheckToken($_POST) && M('admin_node')->add($_POST)){
            $this->success(L('add_success'),U(GROUP_NAME . '/Rbac/node'));
        }else{
            $this->error(L('add_error'));
        }
    }

    public function editNode(){
        if(IS_POST && I('id') && M('admin_node')->save($_POST)){
            $this->success(L('edit_success'),U(GROUP_NAME . '/Rbac/node'));
        }else{
            $node = M('admin_node')->where(array('id'=>I('id')))->find();
            $this->type = $node['level'] == 1 ? '应用' : ( $node['level'] == 2 ? '控制器' : ($node['level'] == 3 ? '动作方法' : '未知'));
            $this->node = $node;
            $this->display();
        }
    }
    public function delNode(){
        if(I('nid')){
            if(M('admin_node')->where(array('pid'=>I('nid')))->count()){
                $this->error(L('has_child_node'),U(GROUP_NAME . '/Rbac/node'));
            }else{
                M('admin_node')->where(array('id'=>I('nid')))->delete();
                $this->success(L('del_success'),U(GROUP_NAME . '/Rbac/node'));
            }
        }else{
            $this->error(L('del_error'));
        }
    }

    //成员管理
    public function user(){
        import('ORG.Util.Page');

        $map = I('username','') ? array('username' => array('like','%'.I('username').'%')) : '1';
        $UserRelation  = D('UserRelation');
        $count = $UserRelation->where($map)->count();
        $Page = new Page($count);

        $Page->parameter .= 'username='.urlencode(I('username')).'&';

        $this->show = $Page->show();
        $this->result = $UserRelation->where($map)->field('password',true)
                ->order('created_date')->limit($Page->firstRow.','.$Page->listRows)->relation(true)->select();
        $this->display();
    }

    public function addUser(){
        $this->role = M('admin_role')->where(array('status'=>1))->select();
        $this->display();
    }

    public function addUserHandler(){
         $user = array(
             'username' => I('username',''),
             'password' => I('password','','md5'),
             'created_date' => date('Y-m-d H:i:s'),
             'last_login_date' => date('Y-m-d H:i:s'),
             'last_login_ip' => get_client_ip(),
             'status' => 1
         );
        $role = array();
        if(M('admin_user')->autoCheckToken($_POST) && $uid = M('admin_user')->add($user)){
            $role_ids = array_unique($_POST['role_id']);
            foreach($role_ids as $role_id){
                if($role_id){
                    $role[] = array(
                        'role_id' => $role_id,
                        'user_id' => $uid,
                    );
                }
            }
            M('admin_role_user')->addAll($role);
            $this->success(L('add_success'), U(GROUP_NAME . '/Rbac/user') );
        }else{
            $this->error(L('add_user_error'));
        }
    }

    public function delUser(){
        if(I('id')){
            M('admin_user')->where(array('id'=>I('id')))->delete();
            M('admin_role_user')->where(array('user_id'=>I('id')))->delete();
            $this->success('del_success', U(GROUP_NAME . '/Rbac/user'));
        }else{
            $this->error('del_error');
        }
    }

    public function editUser(){
        if(IS_POST){
            $user = array();
            $user['id'] = I('id');
            $user['username'] =  I('username');
            I('password') == '' || $user['password'] = I('password','','md5');
            if(M('admin_user')->save($user) !== false){

                M('admin_role_user')->where(array('user_id'=>I('id')))->delete();
                $role_ids = array_unique($_POST['role_id']);
                foreach($role_ids as $role_id){
                    if($role_id){
                        $role[] = array(
                            'role_id' => $role_id,
                            'user_id' => I('id'),
                        );
                    }
                }
                M('admin_role_user')->addAll($role);
                $this->success(L('edit_success'), U(GROUP_NAME . '/Rbac/user') );
            }else{
                $this->error(L('edit_user_error'));
            }
        }else{
            $this->user = M('admin_user')->where(array('id'=>I('id')))->find();
            $this->role = M('admin_role')->where(array('status'=>1))->select();
            $this->role_user = M('admin_role_user')->where(array('user_id'=>I('id')))->select();
            $this->display();
        }
    }

    //权限
    public function access(){
        $this->rid = I('rid',0,'intval');
        $node = M('admin_node')->order("sort desc")->select();
        $access = M('admin_access')->where(array('role_id'=>$this->rid))->getField('node_id',true);
        $this->node = node_merge($node,$access);
        $this->display();
    }

    public function setAccess(){
        $rid = I('rid', 0, 'intval');
        $db = M('admin_access');

        $db->where(array('role_id'=>$rid))->delete();

        $data = array();
        foreach($_POST['access'] as $v){
            $tmp = explode('_',$v);
            $data[] = array(
                'role_id' => $rid,
                'node_id' => $tmp[0],
                'level' => $tmp[1]
            );
        }

        if($db->autoCheckToken($_POST) && $db->addAll($data)){
            $this->success(L('edit_success'),U(GROUP_NAME . '/Rbac/role'));
        }else{
            $this->error(L('edit_error'));
        }
    }

    public function userLog(){
        import('ORG.Util.Page');
        $map = '';
        I('username','') == '' || $map['username'] = I('username');
        I('start','') == '' || $map['created_date'] = array('egt',I('start'));
        I('end','') == '' || $map['created_date'] = array('elt',I('end'));

        $count = M('opt_log')->where($map)->count();

        $Page = new Page($count);
        foreach($map as $k => $v){
            $Page->parameter .= $k.'='.$v.'&';
        }

        $nodeMap = array();
        $node = M('admin_node')->where(array('status'=>1))->select();
        foreach($node as $v){
            $nodeMap[$v['level']][$v['name']] = $v['title'];
        }

        $nodeMap[2]['Index'] = L('Webmaster');
        $nodeMap[2]['Login'] = L('Webmaster');
        $nodeMap[3]['login'] = L('login');
        $nodeMap[3]['logout'] = L('logout');

        $this->nodeMap = $nodeMap;
        $this->show = $Page->show();
        $this->result = M('opt_log')->where($map)->order('id desc')->limit($Page->firstRow,$Page->listRows)->select();
        $this->display();
    }
}