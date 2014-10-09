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
<form class="form-inline definewidth m20" action="<?php echo U(GROUP_NAME . '/Rbac/user');?>" method="post">
    帐号名称：
    <input type="text" name="username" id="username" class="abc input-default" placeholder="" value="">&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <button type="button" class="btn btn-success" id="addnew">新增帐号</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>ID</th>
        <th>帐号名</th>
        <th>最后登录时间</th>
        <th>最后登录IP</th>
        <th>锁定状态</th>
        <th>所属角色</th>
        <th>管理操作</th>
    </tr>
    </thead>
        <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["username"]); ?></td>
            <td><?php echo ($v["last_login_date"]); ?></td>
            <td><?php echo ($v["last_login_ip"]); ?></td>
            <td><?php if($v['status'] != 1): ?>锁定<?php else: ?>未锁定<?php endif; ?></td>
            <td>
                <?php if($v['username'] == C('RBAC_SUPERADMIN')): ?>超级管理员
                    <?php else: ?>
                        <ul style="margin:0;padding:0">
                            <?php if(is_array($v["admin_role"])): foreach($v["admin_role"] as $key=>$value): ?><li><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</li><?php endforeach; endif; ?>
                        </ul><?php endif; ?>
            </td>
            <td>
                  <a href="<?php echo U(GROUP_NAME . '/Rbac/editUser',array('id'=>$v['id']));?>">编辑</a>
                  <a href="<?php echo U(GROUP_NAME . '/Rbac/delUser',array('id'=>$v['id']));?>">删除</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="inline pull-right page"><?php echo ($show); ?></div>

<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Rbac/addUser');?>";
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