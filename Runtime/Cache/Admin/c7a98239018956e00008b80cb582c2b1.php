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
<form class="form-inline definewidth m20" action="<?php echo U(GROUP_NAME . '/Product/index');?>" method="post">
    产品名称：
    <input type="text" name="title" id="title" class="abc input-default" placeholder="" value="<?php echo I('title');?>">&nbsp;&nbsp;
    <select name="class1" id="">
        <?php if(is_array($proClass[1])): foreach($proClass[1] as $key=>$v): ?><option value="<?php echo ($key); ?>" <?php if($class1 == $key): ?>selected<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
    </select>
    <select name="class2" id="">
        <?php if(is_array($proClass[2])): foreach($proClass[2] as $key=>$v): ?><option value="<?php echo ($key); ?>" <?php if($class2 == $key): ?>selected<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
    </select>
    <input type="hidden" name="parent_id" value="<?php echo ($_REQUEST['parent_id']); ?>"/>
    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <button type="button" class="btn btn-success" id="addnew">添加产品</button>
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th width="30">排序</th>
        <th width="30">ID</th>
        <th>产品名称</th>
        <th>英文</th>
        <th>分类1</th>
        <th>分类2</th>
        <th>参数1</th>
        <th>参数2</th>
        <th>创建时间</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td><?php echo ($v["sort"]); ?></td>
            <td><?php echo ($v["id"]); ?></td>
            <td><?php echo ($v["title"]); ?></td>
            <td><?php echo ($v["title_en"]); ?></td>
            <td><?php echo ($proClass[1][$v['class1']]); ?></td>
            <td><?php echo ($proClass[2][$v['class2']]); ?></td>
            <td><?php echo ($v["argv1"]); ?></td>
            <td><?php echo ($v["argv2"]); ?>元</td>
            <td><?php echo ($v["created_date"]); ?></td>
            <td>
                <a href="<?php echo U(GROUP_NAME . '/Product/editProduct',array('id'=>$v['id'],'type'=>0));?>">编辑</a>
                <a href="<?php echo U(GROUP_NAME . '/Product/delProduct',array('id'=>$v['id'],'parent_id'=>$v['parent_id']));?>">删除</a>
            </td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="inline pull-right page"><?php echo ($show); ?></div>

<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Product/addProduct',array('parent_id'=>I('parent_id'),'type'=>0));?>";
        });
    });
</script>


</body>
</html>