<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-27
 * Time: 上午10:15
 */
class ProductAction extends CommonAction{

    protected $_proClass = array();

    public function __construct(){
        parent::__construct();
        $this->_proClass = C('PRODUCT_CLASS');
    }
    public function index(){
        if(I('type')==1){
            $data = M('product')->field('id')->where(array('parent_id'=>I('parent_id')))->limit(1)->find();
            if($data){
                $url = U(GROUP_NAME.'/Product/editProduct',array('id'=>$data['id'],'parent_id'=>I('parent_id'),'type'=>I('type')));
            }else{
                $url = U(GROUP_NAME .'/Product/addProduct',array('parent_id'=>I('parent_id'),'type'=>I('type')));
            }
            $this->redirect($url);
        }else{
            import('ORG.Util.Page');

            ! I('title') || $map['title'] = array('like','%'.I('title').'%');
            ! I('parent_id') || $map['parent_id'] = I('parent_id');
            ! I('class1') || $map['class1'] = I('class1');
            ! I('class2') || $map['class2'] = I('class2');
            $count = M('product')->where($map)->count();
            $Page = new Page($count);

            $Page->parameter .= 'title='.urlencode(I('title')).'&';
            $Page->parameter .= 'parent_id='.urlencode(I('parent_id')).'&';
            $Page->parameter .= 'class1='.urlencode(I('class1')).'&';
            $Page->parameter .= 'class2='.urlencode(I('class2')).'&';
            $this->proClass = $this->_proClass;
            $this->show = $Page->show();
            $this->result = M('product')->where($map)->limit($Page->firstRow,$Page->listRows)->order('sort asc,id desc')->select();
            $this->class1 = I('class1',0);
            $this->class2 = I('class2',0);

            $this->display();
        }
    }

    public function editProduct(){
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
            $oldData = M('product')->getById(I('id'));
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
                'title_en' => I('title_en'),
                'content' => I('content'),
                'desc' => I('desc'),
                'usage' => I('usage'),
                'parent_id' => I('parent_id'),
                'class1' => I('class1'),
                'class2' => I('class2'),
                'argv1' => I('argv1'),
                'argv2' => I('argv2'),
                'sort' => I('sort'),
                'images' => implode(',',$newImgs),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('product')->validate($rules)->create($_POST)){
                $this->error(M('product')->getError());
            }else{
                if(M('product')->save($data)){
                    if(I('type')){
                        $this->success(L('edit_success'),U(GROUP_NAME . '/Product/editProduct',array('id'=>I('id'),'type'=>I('type'))));
                    }else{
                        $this->success(L('edit_success'),U(GROUP_NAME . '/Product/index',array('parent_id'=>I('parent_id'),'type'=>I('type'))));
                    }
                }else{
                    $this->error(L('edit_error'));
                }
            }
        }else{
            $this->result = M('product')->getById(I('id'));
            $this->images = explode(',',$this->result['images']);
            $this->path = $uploadConfig['savePath'];
            $this->proClass = $this->_proClass;
            $this->display();
        }
    }

    public function addProduct(){
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
                'title_en' => I('title_en'),
                'content' => I('content'),
                'desc' => I('desc'),
                'usage' => I('usage'),
                'parent_id' => I('parent_id'),
                'class1' => I('class1'),
                'class2' => I('class2'),
                'argv1' => I('argv1'),
                'argv2' => I('argv2'),
                'sort' => I('sort'),
                'images' => implode(',',$saveName),
                'created_date' => date('Y-m-d H:i:s'),
                'last_modified_date' => date('Y-m-d H:i:s'),
            );
            if(!M('product')->validate($rules)->create($_POST)){
                $this->error(M('product')->getError());
            }else{
                if($id = M('product')->add($data)){
                    if(I('type')){
                        $this->success(L('add_success'),U(GROUP_NAME . '/Product/editProduct',array('id'=>$id,'parent_id'=>I('parent_id'))));
                    }else{
                        $this->success(L('add_success'),U(GROUP_NAME . '/Product/index',array('parent_id'=>I('parent_id'))));
                    }
                }else{
                    $this->error(L('add_error'));
                }
            }
        }else{
            $this->proClass = $this->_proClass;
            $this->display();
        }
    }

    public function delProduct(){
        if(I('id')){
            $data = M('product')->getById(I('id'));

            if(M('product')->where(array('id'=>I('id')))->delete()){
                $uploadConfig = C('UPLOAD_IMAGE');
                $images = explode(',',$data['images']);
                foreach($images as $v){
                    if($v){
                        @unlink($uploadConfig['savePath'].$v);
                        @unlink($uploadConfig['savePath'].'thumb_'.$v);
                    }
                }
                $this->success(L('del_success'),U(GROUP_NAME . '/Product/index',array('type'=>0,'parent_id'=>I('parent_id'))));
            }
            else
                $this->error(L('del_error'));
        }
    }

}