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
<form class="form-inline definewidth m20" action="<?php echo U(GROUP_NAME . '/News/index');?>" method="post">
    标题：
    <input type="text" name="title" id="title" class="abc input-default" placeholder="" value="<?php echo I('title');?>">&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <input type="hidden" name="parent_id" value="<?php echo I('parent_id');?>"/>
    <button type="button" class="btn btn-success" id="addnew">添加文章</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="30">排序</th>
        <th width="30">ID</th>
        <th width="50%">标题</th>
        <th>创建时间</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td><?php echo ($v["sort"]); ?></td>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["title"]); ?></td>
            <td><?php echo ($v["created_date"]); ?></td>
            <td>
                <a href="<?php echo U(GROUP_NAME . '/News/editNews',array('id'=>$v['id'],'type'=>0));?>">编辑</a>
                <a href="<?php echo U(GROUP_NAME . '/News/delNews',array('id'=>$v['id'],'parent_id'=>$v['parent_id']));?>">删除</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="inline pull-right page"><?php echo ($show); ?></div>

<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/News/addNews',array('parent_id'=>I('parent_id'),'type'=>0));?>";
        });
    });
</script>


</body>
</html>