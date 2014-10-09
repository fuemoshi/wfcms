<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-27
 * Time: 上午10:15
 */
class NewsAction extends CommonAction{

    public function index(){
        if(I('type')==1){
            $data = M('news')->field('id')->where(array('parent_id'=>I('parent_id')))->limit(1)->find();
            if($data){
                $url = U(GROUP_NAME.'/News/editNews',array('id'=>$data['id'],'parent_id'=>I('parent_id'),'type'=>I('type')));
            }else{
                $url = U(GROUP_NAME .'/News/addNews',array('parent_id'=>I('parent_id'),'type'=>I('type')));
            }
            $this->redirect($url);
        }else{
            import('ORG.Util.Page');

            I('title','') == '' || $map['title'] = array('like','%'.I('title').'%');
            I('parent_id',-1) == -1 || $map['parent_id'] = I('parent_id');

            $count = M('news')->where($map)->count();
            $Page = new Page($count);

            $Page->parameter .= 'title='.urlencode(I('title')).'&';
            $Page->parameter .= 'parent_id='.urlencode(I('parent_id')).'&';

            $this->show = $Page->show();
            $this->result = M('news')->where($map)->limit($Page->firstRow,$Page->listRows)->order('sort asc,id desc')->select();

            $this->display();
        }
    }

    public function editNews(){
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
            $oldData = M('news')->getById(I('id'));
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
                'content' => I('content'),
                'sort' => I('sort'),
                'images' => implode(',',$newImgs),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('news')->validate($rules)->create($_POST)){
                $this->error(M('news')->getError());
            }else{
                if(M('news')->save($data)){
                    if(I('type')){
                        $this->success(L('edit_success'),U(GROUP_NAME . '/News/editNews',array('id'=>I('id'),'type'=>I('type'))));
                    }else{
                        $this->success(L('edit_success'),U(GROUP_NAME . '/News/index',array('parent_id'=>I('parent_id'),'type'=>I('type'))));
                    }
                }else{
                    $this->error(L('edit_error'));
                }
            }
        }else{
            $this->result = M('news')->getById(I('id'));
            $this->images = explode(',',$this->result['images']);
            $this->path = $uploadConfig['savePath'];
            $this->display();
        }
    }

    public function addNews(){
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
                'content' => I('content'),
                'parent_id' => I('parent_id'),
                'sort' => I('sort'),
                'images' => implode(',',$saveName),
                'created_date' => date('Y-m-d H:i:s'),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('news')->validate($rules)->create($_POST)){
                $this->error(M('news')->getError());
            }else{
                if($id = M('news')->add($data)){
                    if(I('type')){
                        $this->success(L('add_success'),U(GROUP_NAME . '/News/editNews',array('id'=>$id,'parent_id'=>I('parent_id'))));
                    }else{
                        $this->success(L('add_success'),U(GROUP_NAME . '/News/index',array('parent_id'=>I('parent_id'))));
                    }
                }else{
                    $this->error(L('add_error'));
                }
            }
        }else{
            $this->display();
        }
    }

    public function delNews(){
        if(I('id')){
            $data = M('news')->getById(I('id'));

            if(M('news')->where(array('id'=>I('id')))->delete()){
                $uploadConfig = C('UPLOAD_IMAGE');
                $images = explode(',',$data['images']);
                foreach($images as $v){
                    if($v){
                        @unlink($uploadConfig['savePath'].$v);
                        @unlink($uploadConfig['savePath'].'thumb_'.$v);
                    }
                }
                $this->success(L('del_success'),U(GROUP_NAME . '/News/index',array('type'=>0,'parent_id'=>I('parent_id'))));
            }
            else
                $this->error(L('del_error'));
        }
    }

}