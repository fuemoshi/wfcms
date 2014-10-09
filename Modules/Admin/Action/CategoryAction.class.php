<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-4-25
 * Time: 上午10:59
 */
class CategoryAction extends CommonAction{

    public function  category(){
        $category = M('category')->field('id,name,parent_id pid,type,model_table,sort')->order('sort asc,id desc')->select();
        $category = node_merge($category);
        $categoryList = array();
        traverseTree($category,"saveToList",0,$categoryList);
        $this->result = $categoryList;
        $this->categoryType = C('CATEGORY_TYPE');
        $this->modelTable = C('MODEL_TABLE');
        $this->display();
    }

    public function addCategory(){
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
            $data = array(
                'model_table' => I('model_table'),
                'name' => I('name',''),
                'type' => I('type',0),
                'images' => implode(',',$saveName),
                'parent_id' => I('parent_id',0),
                'created_date' => date('Y-m-d H:i:s'),
                'last_modified_date' => date('Y-m-d H:i:s')
            );
            if(M('category')->add($data)){
                $this->success(L('add_success'),U(GROUP_NAME.'/Category/category'));
            }else{
                $this->error(L('add_error'));
            }
        }else{
            $this->parent_id = I('id',0);
            $category = M('category')->field('id,name,parent_id pid')->select();
            $this->category = node_merge($category);
            $this->modelTable = C('MODEL_TABLE');
            $this->display();
        }
    }

    public function delCategory(){
        if(M('category')->where(array('parent_id'=>I('id')))->count()){
            $this->error(L('has_child_node'));
            return;
        }
        $data = M('advertise')->getById(I('id'));
        if(M('category')->where(array('id'=>I('id')))->delete()){
            $uploadConfig = C('UPLOAD_IMAGE');
            $images = explode(',',$data['images']);
            foreach($images as $v){
                if($v){
                    @unlink($uploadConfig['savePath'].$v);
                    @unlink($uploadConfig['savePath'].'thumb_'.$v);
                }
            }
            $this->success(L('del_success'),U(GROUP_NAME.'/Category/category'));
        }else{
            $this->error(L('del_error'));
        }
    }

    public function editCategory(){
        $uploadConfig = C('UPLOAD_IMAGE');

        if(IS_POST){
            //后面要对内容进行联动
            if(I('id') == I('parent_id')){
                $this->error(L('edit_error'));
                return;
            }
            import('ORG.Net.UploadFile');
            $upload = new UploadFile($uploadConfig);
            if(!$upload->upload() && $upload->errorNo !=4 ) {// 上传错误提示错误信息
                $this->error($upload->getErrorMsg());
            }else{// 上传成功
                $info = $upload->getUploadFileInfo();
            }
            $oldData = M('category')->getById(I('id'));
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
            $data = array(
                'id' => I('id',0),
                'model_table' => I('model_table'),
                'name' => I('name',''),
                'type' => I('type',0),
                'images' => implode(',',$newImgs),
                'parent_id' => I('parent_id',0),
                'last_modified_date' => date('Y-m-d H:i:s')
            );
            if(M('category')->save($data)){
                $this->success(L('edit_success'),U(GROUP_NAME.'/Category/category'));
            }else{
                $this->error(L('edit_error'));
            }
        }else{
            $this->result = M('category')->getById(I('id'));
            $this->images = explode(',',$this->result['images']);
            $category = M('category')->field('id,name,parent_id pid')->select();
            $this->category = node_merge($category);
            $this->modelTable = C('MODEL_TABLE');
            $this->display();
        }
    }

    public function editSort(){
        foreach($_POST['data'] as $k => $v){
            M('category')->where(array('id'=>$k))->save(array('sort'=>$v));
        }
        $this->success(L('edit_success'),U(GROUP_NAME.'/Category/category'));
    }
}