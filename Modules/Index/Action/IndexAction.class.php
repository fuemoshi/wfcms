<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-26
 * Time: 下午1:17
 */

class IndexAction extends Action{

    protected $_siteInfo;

    public function __construct(){
        parent::__construct();
        $this->_siteInfo = M('site')->getById(1);
        $this->title = $this->_siteInfo['site_name'];
        $this->keywords = $this->_siteInfo['keywords'];
        $this->description = $this->_siteInfo['description'];
        $this->qq_online = $this->_siteInfo['qq_online'];
        $this->hot_line = $this->_siteInfo['hot_line'];
    }

    public function index(){
        //p($this->_siteInfo);
        $this->flashImgs = M('advertise')->field('id,title,url,images')->where(array('position'=>1))->order('sort asc')->select();
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    protected function getCategory($pid=0){
        $data = M('category')->field('id,name,type,images')->where(array('parent_id'=>$pid))->order('sort asc,id desc')->select();
        $result = array();
        foreach($data as $v){
            $result[$v['id']] = $v;
        }
        return $result;
    }

    public function about(){
        $this->category = $this->getCategory(9);
        $type = I('type',1);
        if($type == 1){
            $firstCategory = current($this->category);
            $pid = I('pid',$firstCategory['id']);
            $this->title .= '-' . $this->category[$pid]['name'];
            $this->result = M('news')->where(array('parent_id'=>$pid))->limit(1)->find();
        }
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    public function news(){
        $this->category = $this->getCategory(19);
        $map['status'] = 1;
        $firstCategory = current($this->category);
        $pid = I('pid',$firstCategory['id']);
        $map['parent_id'] = $pid;
        $this->title .= '-' . $this->category[$pid]['name'];

        $this->result = M('news')->where($map)->order('sort asc,id desc')->select();
        $this->actionName = ACTION_NAME;
        $this->parent_id = I('pid',0);

        if(I('pid')){
            $this->display('news_list');
        }else{
            $this->display();
        }
    }

    public function news_show(){
        $this->category = $this->getCategory(19);
        $this->result = M('news')->where(array('id'=>I('id')))->find();
        $this->title .= '-' . $this->result['title'];
        $this->actionName = 'news';
        $this->display();
    }

    public function products(){
        $this->category = $this->getCategory(14);
        $type = I('type',0);
        if($type == 0){
            $firstCategory = current($this->category);
            $this->parent_id = I('pid',$firstCategory['id']);
            if(I('title')){
                $map['title'] = array('like','%'.I('title').'%');
                $map['parent_id'] = array('in',array_keys($this->category));
            }else{
                $map['parent_id'] = $this->parent_id;
            }
            !I('class1') || $map['class1'] = I('class1');
            !I('class2') || $map['class2'] = I('class2');
            $this->result = M('product')->where($map)->order('sort asc,id desc')->select();
            $this->proClass = C('PRODUCT_CLASS');
            $this->class1 = I('class1',0);
            $this->class2 = I('class2',0);
            $this->title .= '-' . $this->category[$this->parent_id]['name'];
        }
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    public function products_show(){
        $this->category = $this->getCategory(14);
        $this->result = M('product')->where(array('id'=>I('id')))->find();
        $this->images = explode(',',$this->result['images']);
        $this->actionName = 'products';
        $this->title .= '-' . $this->result['title'];
        $this->display();
    }

    public function sellers(){
        $this->category = $this->getCategory(26);
        $first = current($this->category);
        $last = array_pop($this->category);
        $this->result1 = M('product')->where(array('parent_id'=>$first['id']))->select();
        $this->result2 = M('product')->where(array('parent_id'=>$last['id']))->select();
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    public function new_products(){
        $this->result = M('product')->where(array('parent_id'=>29))->select();
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    public function article(){
        $this->category = $this->getCategory(31);
        $type = I('type',1);
        if($type == 1){
            $firstCategory = current($this->category);
            $this->result = M('news')->where(array('parent_id'=>I('pid',$firstCategory['id'])))->limit(1)->find();
        }
        $this->actionName = ACTION_NAME;
        $this->display();
    }

    public function check(){
        $this->category = $this->getCategory(9);
        $this->actionName = 'about';
        $this->display();
    }

    public function sitemap(){

    }

    public function contact(){
        $this->category = $this->getCategory(9);
        $this->actionName = 'about';
        $this->contact = $this->_siteInfo['contact'];
        $this->display();
    }
}