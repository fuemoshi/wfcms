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
    <button type="button" class="btn btn-success" id="addnew">新增角色</button>
</div>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>角色名称</th>
        <th>角色描述</th>
        <th>开启状态</th>
        <th>管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($role)): foreach($role as $key=>$v): ?><tr>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["name"]); ?></td>
            <td><?php echo ($v["remark"]); ?></td>
            <td>
                <?php if($v["status"]): ?>开启<?php else: ?>关闭<?php endif; ?>
            </td>
            <td>
                  <a href="<?php echo U(GROUP_NAME . '/Rbac/editRole',array('id'=>$v['id']));?>">编辑</a>
                  <a href="<?php echo U(GROUP_NAME . '/Rbac/delRole',array('id'=>$v['id']));?>">删除</a>
                  <a href="<?php echo U(GROUP_NAME . '/Rbac/access',array('rid'=>$v['id']));?>">配置权限</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>

<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Rbac/addRole');?>";
        });
    });
    function del(id)
    {
        if(confirm("确定要删除吗？"))
        {
            var url = "index.html";
            window.location.href=url;
        }
    }
</script>


</body>
</html>