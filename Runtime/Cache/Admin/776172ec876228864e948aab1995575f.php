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
<form class="form-inline definewidth m20" action="<?php echo U(GROUP_NAME . '/Rbac/userLog');?>" method="post">
    帐号名：
    <input type="text" name="username" value="<?php echo ($_REQUEST['username']); ?>" id="username" class="abc input-default" placeholder="" value="">&nbsp;&nbsp;
    开始时间：
    <input style="width: 100px;" value="<?php echo ($_REQUEST['start']); ?>" class="Wdate" name="start" type="text" onClick="WdatePicker()">
    结束时间：
    <input style="width: 100px;" value="<?php echo ($_REQUEST['end']); ?>" class="Wdate" name="end" type="text" onClick="WdatePicker()">

    <button type="submit" class="btn btn-primary">查询</button>&nbsp;&nbsp;
    <button type="reset" class="reset btn btn-primary">清空</button>&nbsp;&nbsp;
</form>
<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>帐号</th>
        <th>模块</th>
        <th>操作</th>
        <th>内容</th>
        <th>ip</th>
        <th>创建时间</th>
    </tr>
    </thead>
    <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td><?php echo ($v["username"]); ?></td>
            <td><?php echo (($nodeMap[2][$v['module']])?($nodeMap[2][$v['module']]):$v['module']); ?></td>
            <td><?php echo (($nodeMap[3][$v['action']])?($nodeMap[3][$v['action']]):$v['action']); ?></td>
            <td><?php echo ($v["info"]); ?></td>
            <td><?php echo ($v["ip"]); ?></td>
            <td><?php echo ($v["created_date"]); ?></td>
        </tr><?php endforeach; endif; ?>
</table>
<div class="inline pull-right page"><?php echo ($show); ?></div>


<script type="text/javascript">
    $(function () {
        $('.reset').click(function(){
            $(this).parents('form').find('input').attr('value','');
        });
    });

</script>
</body>
</html>