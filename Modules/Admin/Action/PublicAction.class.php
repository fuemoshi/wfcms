<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-25
 * Time: 下午4:58
 */
class PublicAction extends Action{
    public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify(4,1,'png',42,24);
    }
}