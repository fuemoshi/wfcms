<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-26
 * Time: 下午6:34
 */

/*
 * 合并成多维数组
 * */
function node_merge($node,$access = null, $pid = 0){
    $arr = array();

    foreach($node as $v){
        if(is_array($access)){
            $v['access'] = in_array($v['id'],$access) ? 1 : 0;
        }
        if($v['pid'] == $pid){
            $v['child'] = node_merge($node, $access , $v['id']);
            $arr[] = $v;
        }
    }

    return $arr;
}

/*
 * 深度遍历多叉无限分类树
 * */
function traverseTree(&$node,$fn,$deep=0,&$ar=null,$before_fn=null,$after_fn=null){
    if(!is_array($node) || empty($node))  return;

    if(!isset($node['child'])){
        foreach($node as $v){
            traverseTree($v,$fn,$deep,$ar,$before_fn,$after_fn);
        }
    }else{
        if($before_fn) $before_fn($node,$deep);

        $fn($node,$deep,$ar);
        foreach($node['child'] as $v){
            traverseTree($v,$fn,$deep+1,$ar,$before_fn,$after_fn);
        }
    }

    if($after_fn) $after_fn();
}

function beforeLeft(&$node,$deep){
    $datatree = '';
    if(isset($node['child']) && empty($node['child'])){
        $datatree = 'data-jstree=\'{ "icon" : "jstree-file" }\'';
    }else{
        $datatree = 'data-jstree=\'{"opened":true}\'';
    }
    echo '<ul><li '.$datatree.'id="'.$node['id'].'">';
}

function afterLeft(&$node,$deep){
    echo '</li></ul>';
}

function contentLeft(&$node,$deep,&$ar=null){
    if(isset($node['child']) && !empty($node['child'])){
        echo $node['name'];
    }else{
        $url = U(GROUP_NAME.'/Pattern/index',array('parent_id'=>$node['id'],'type'=>$node['type'],'model_table'=>$node['model_table']),true,false,true);
        echo '<a target="right" href="'.$url.'" class="leafNode" onclick="javascript:window.parent.right.location.href=\''.$url.'\'">'.$node['name'].'</a>';
    }
}

function selector(&$node,$deep,&$ar=null){
    if($deep<=1){
        $str = str_repeat('&nbsp;├ ',$deep);
    }else{
        $str = str_repeat('&nbsp;&nbsp;&nbsp;',$deep).'├ ';
    }
    echo '<option value="'.$node['id'].'">'.$str.$node['name'].'</option>';
}

function saveToList($node,$deep,&$ar){
    unset($node['child']);
    $node['deep'] = $deep;
    $ar[] = $node;
}

/*
 * 将菜单配置转换为可用的JSON格式
 * */
function transToAccessMenu($arr){

    import('ORG.Util.RBAC');
    $accessList = RBAC::getAccessList($_SESSION[C('USER_AUTH_KEY')]);

    $id = 1;
    $result = array();
    $topMenu = array();
    $notAuthModuleStr = C('NOT_AUTH_MODULE');
    $notAuthModule = explode(',',$notAuthModuleStr);
    foreach($notAuthModule as $k => $v){
        $notAuthModule[$v] = $v;
    }
    foreach($arr as $topKey => $topInfo){
        $tmp = array();
        $tmp['id'] = $id++;
        foreach($topInfo as $subKey => $subInfo){
            $subTmp = array();
            $subTmp['text'] = $subKey;
            foreach($subInfo as $thirdInfo){

                $urlTmp = explode('/',$thirdInfo[1]);

                //根据权限显示菜单
                if( session('username') == C("RBAC_SUPERADMIN") ||
                    (
                        isset($accessList[strtoupper(GROUP_NAME)])
                        && isset($accessList[strtoupper(GROUP_NAME)][strtoupper($urlTmp[0])])
                        && isset($accessList[strtoupper(GROUP_NAME)][strtoupper($urlTmp[0])][strtoupper($urlTmp[1])])
                    )||
                    isset($notAuthModule[$urlTmp[0]])
                ){

                    $href = U(GROUP_NAME .'/'. $thirdInfo[1]);
                    $subTmp['items'][] = array(
                        'id' => $id++,
                        'text' => $thirdInfo[0],
                        'href' => $href
                    );
                }
            }
            empty($subTmp['items']) || $tmp['menu'][] = $subTmp;
        }
        empty($tmp['menu']) || $result[] = $tmp;
        empty($tmp['menu']) || $topMenu[] = $topKey;

    }
    return array('jsonMenu'=>json_encode($result),'topMenu'=>$topMenu);
}

/*
 * 将数据转化为键值映射
 * */
function arrToMap(&$arr,$key='id'){
    $map = array();
    foreach($arr as $v){
        $map[$v[$key]] = $v;
    }
    return $map;
}

/*操作日志*/
function uLog($info=''){
    $data = array(
        'created_date' => date('Y-m-d H:i:s'),
        'ip' => get_client_ip(),
        'username' => session('username'),
        'uid' => session(C('USER_AUTH_KEY')),
        'action' => ACTION_NAME,
        'module' => MODULE_NAME,
        'info' => $info
    );
    return M('opt_log')->add($data);
}

/**
 * 导出数据为excel表格
 *@param $data    一个二维数组,结构如同从数据库查出来的数组
 *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
 *@param $filename 下载的文件名
 *@examlpe
$stu = M ('User');
$arr = $stu -> select();
exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */
function exportexcel($data=array(),$title=array(),$filename='report'){
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=".$filename.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    //导出xls 开始
    if (!empty($title)){
        foreach ($title as $k => $v) {
            //$title[$k]=iconv("UTF-8", "GB2312",$v);
            $title[$k]=$v;
        }
        $title= implode("\t", $title);
        echo "$title\n";
    }
    if (!empty($data)){
        foreach($data as $key=>$val){
            foreach ($val as $ck => $cv) {
                //$data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
                $data[$key][$ck]=$cv;
            }
            $data[$key]=implode("\t", $data[$key]);

        }
        echo implode("\n",$data);
    }
}
