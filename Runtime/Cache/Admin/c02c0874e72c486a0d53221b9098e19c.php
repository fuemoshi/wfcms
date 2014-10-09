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
<form class="form-inline definewidth m20" action="<?php echo U(GROUP_NAME . '/Advertise/index');?>" method="post">
    标题：
    <input type="text" name="title" id="title" class="abc input-default" placeholder="" value="<?php echo I('title');?>">&nbsp;&nbsp;
    <select name="position" id="">
        <?php if(is_array($posMap)): foreach($posMap as $key=>$v): ?><option value="<?php echo ($key); ?>" <?php if($position == $key): ?>selected<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
    </select>
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <button type="button" class="btn btn-success" id="addnew">添加广告</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="30">排序</th>
        <th width="30">ID</th>
        <th>图片/标题/链接</th>
        <th>位置</th>
        <th>创建时间</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td><?php echo ($v["sort"]); ?></td>
            <td><?php echo ($v["id"]); ?></td>
            <td>
                <a href="http://<?php echo ($v['url']); ?>" target="_blank">
                    <img src="__UPLOADS__/thumb_<?php echo ($v['images']); ?>" width="100" height="100" alt="<?php echo ($v['title']); ?>" title="<?php echo ($v["title"]); ?>"/>
                </a>
            </td>
            <td><?php echo ($posMap[$v['position']]); ?></td>
            <td><?php echo ($v["created_date"]); ?></td>
            <td>
                <a href="<?php echo U(GROUP_NAME . '/Advertise/editAdvertise',array('id'=>$v['id']));?>">编辑</a>
                <a href="<?php echo U(GROUP_NAME . '/Advertise/delAdvertise',array('id'=>$v['id']));?>">删除</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="inline pull-right page"><?php echo ($show); ?></div>

<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Advertise/addAdvertise');?>";
        });
    });
</script>


</body>
</html>