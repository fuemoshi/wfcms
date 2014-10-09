<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>后台管理系统</title>
    <link rel="stylesheet" type="text/css" href="__CSS__/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/bootstrap-responsive.css" />
    <link rel="stylesheet" type="text/css" href="__CSS__/style.css?t=<?php echo time();?>" />
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__JS__/bootstrap.js"></script>
    <script type="text/javascript" src="__JS__/ckform.js"></script>
    <script type="text/javascript" src="__JS__/common.js"></script>
    <script language="javascript" type="text/javascript" src="__JS__/My97DatePicker/WdatePicker.js"></script>
    <style type="text/css">
        ul,li {
            list-style-type : none;
        }
    </style>
</head>
<body>
<div class="definewidth m10">
    <button type="button" class="btn btn-success" id="addnew">添加应用</button>
</div>

<div id="nodeWrap">
    <table class="table table-bordered table-hover definewidth m10">
         <?php if(is_array($node)): foreach($node as $key=>$app): ?><tr>
                 <td>
                    <p>
                     <strong><?php echo ($app["title"]); ?></strong>
                     <a href="<?php echo U(GROUP_NAME . '/Rbac/addNode',array('pid'=> $app['id'],'level'=>2));?>">[ 添加控制器 ]</a>
                      <a href="<?php echo U(GROUP_NAME . '/Rbac/editNode', array('id' => $app['id']));?>">[ 修改 ]</a>
                      <a href="<?php echo U(GROUP_NAME . '/Rbac/delNode', array('nid' => $app['id']));?>">[ 删除 ]</a>
                    </p>

                     <?php if(is_array($app["child"])): foreach($app["child"] as $key=>$action): ?><dl>
                             <dt>
                                 <strong><?php echo ($action["title"]); ?></strong>
                                 <a href="<?php echo U(GROUP_NAME . '/Rbac/addNode',array('pid'=> $action['id'],'level'=>3));?>">[ 添加方法 ]</a>
                                 <a href="<?php echo U(GROUP_NAME . '/Rbac/editNode', array('id' => $action['id']));?>">[ 修改 ]</a>
                                 <a href="<?php echo U(GROUP_NAME . '/Rbac/delNode', array('nid' => $action['id']));?>">[ 删除 ]</a>
                             </dt>

                             <?php if(is_array($action["child"])): foreach($action["child"] as $key=>$method): ?><dd>
                                     <span><?php echo ($method["title"]); ?></span>
                                     <a href="<?php echo U(GROUP_NAME . '/Rbac/editNode', array('id' => $method['id']));?>">[ 修改 ]</a>
                                     <a href="<?php echo U(GROUP_NAME . '/Rbac/delNode', array('nid' => $method['id']));?>">[ 删除 ]</a>
                                 </dd><?php endforeach; endif; ?>
                         </dl><?php endforeach; endif; ?>
                 </td>
             </tr><?php endforeach; endif; ?>
    </table>
</div>


<script language="JavaScript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Rbac/addNode');?>";
        });
    });
</script>
</body>
</html>