<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-28
 * Time: 下午5:53
 */ 
class AdvertiseAction extends CommonAction{
    
    protected $_posMap = array(
        0 => '默认',
        1 => '首页轮播',
        2 => '友情链接',
    );
    
    public function index(){
        import('ORG.Util.Page');

        ! I('title') || $map['title'] = array('like','%'.I('title').'%');
        ! I('position') || $map['position'] = I('position');
        $count = M('advertise')->where($map)->count();
        $Page = new Page($count);

        $Page->parameter .= 'title='.urlencode(I('title')).'&';
        $Page->parameter .= 'position='.urlencode(I('position')).'&';
        $this->posMap = $this->_posMap;
        $this->position = I('position',0);
        $this->show = $Page->show();
        $this->result = M('advertise')->where($map)->limit($Page->firstRow,$Page->listRows)->order('sort asc,id desc')->select();

        $this->display();
    }
    
    public function addAdvertise(){
        if(IS_POST){
            import('ORG.Net.UploadFile');
            $upload = new UploadFile(C('UPLOAD_IMAGE'));// 实例化上传类
            if(!$upload->upload() && $upload->errorNo !=4 ) {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            }else{// 上传成功
                $info = $upload->getUploadFileInfo();
            }
            $saveName = array();
            foreach($info as $v){
                $saveName[] = $v['savename'];
            }
            $rules = array(
                array('title','require',L('title_require'),1),
            );
            $data = array(
                'title' => I('title'),
                'sort' => I('sort'),
                'images' => implode(',',$saveName),
                'url' => I('url'),
                'position' => I('position'),
                'created_date' => date('Y-m-d H:i:s'),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('advertise')->validate($rules)->create($_POST)){
                $this->error(M('advertise')->getError());
            }else{
                if($id = M('advertise')->add($data)){
                    if(I('type')){
                        $this->success(L('add_success'),U(GROUP_NAME . '/Advertise/editAdvertise',array('id'=>$id,'parent_id'=>I('parent_id'))));
                    }else{
                        $this->success(L('add_success'),U(GROUP_NAME . '/Advertise/index',array('parent_id'=>I('parent_id'))));
                    }
                }else{
                    $this->error(L('add_error'));
                }
            }
        }else{
            $this->posMap = $this->_posMap;
            $this->display();
        }
    }
    
    public function editAdvertise(){
        $uploadConfig = C('UPLOAD_IMAGE');
        if(IS_POST){
            //这里后期应该写一个上传图片的插件，不用每次提交都要检测上传
            import('ORG.Net.UploadFile');
            $upload = new UploadFile($uploadConfig);
            if(!$upload->upload() && $upload->errorNo !=4 ) {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            }else{// 上传成功
                $info = $upload->getUploadFileInfo();
            }
            $oldData = M('advertise')->getById(I('id'));
            $oldImgs = explode(',',$oldData['images']);

            $images = I('images',array());
            $saveName = array();
            if($info){
                foreach($info as $v){
                    $saveName[] = $v['savename'];
                }
            }
            $newImgs = array_merge($images,$saveName);
            $delImgs = array_diff($oldImgs,$newImgs);

            if($delImgs){
                foreach($delImgs as $v){
                    if($v){
                        @unlink($uploadConfig['savePath'].$v);
                        @unlink($uploadConfig['savePath'].'thumb_'.$v);
                    }
                }
            }

            $rules = array(
                array('title','require',L('title_require'),1),
            );
            $data = array(
                'id' => I('id'),
                'title' => I('title'),
                'sort' => I('sort'),
                'images' => implode(',',$newImgs),
                'url' => I('url'),
                'position' => I('position'),
                'created_date' => date('Y-m-d H:i:s'),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('advertise')->validate($rules)->create($_POST)){
                $this->error(M('advertise')->getError());
            }else{
                if(M('advertise')->save($data)){
                    if(I('type')){
                        $this->success(L('edit_success'),U(GROUP_NAME . '/Advertise/editAdvertise',array('id'=>I('id'),'type'=>I('type'))));
                    }else{
                        $this->success(L('edit_success'),U(GROUP_NAME . '/Advertise/index',array('parent_id'=>I('parent_id'),'type'=>I('type'))));
                    }
                }else{
                    $this->error(L('edit_error'));
                }
            }
        }else{
            $this->result = M('advertise')->getById(I('id'));
            $this->images = explode(',',$this->result['images']);
            $this->path = $uploadConfig['savePath'];
            $this->posMap = $this->_posMap;
            $this->display();
        }
    }
    
    public function delAdvertise(){
        if(I('id')){
            $data = M('advertise')->getById(I('id'));

            if(M('advertise')->where(array('id'=>I('id')))->delete()){
                $uploadConfig = C('UPLOAD_IMAGE');
                $images = explode(',',$data['images']);
                foreach($images as $v){
                    if($v){
                        @unlink($uploadConfig['savePath'].$v);
                        @unlink($uploadConfig['savePath'].'thumb_'.$v);
                    }
                }
                $this->success(L('del_success'),U(GROUP_NAME . '/Advertise/index',array('type'=>0,'parent_id'=>I('parent_id'))));
            }
            else
                $this->error(L('del_error'));
        }
    }
}