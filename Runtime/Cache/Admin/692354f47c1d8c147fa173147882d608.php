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
<form class="form-inline definewidth m20">
    <button type="button" class="btn btn-success" id="addnew">新增栏目</button>
</form>
<form class="form-inline" action="<?php echo U(GROUP_NAME . '/Category/editSort');?>" method="post">

<table class="table table-bordered table-hover definewidth m10" >
    <thead>
    <tr>
        <th>排序</th>
        <th>ID</th>
        <th>栏目名称</th>
        <th>栏目类型</th>
        <th>所属模型</th>
        <th>数据量</th>
        <th>管理操作</th>
    </tr>
    </thead>
    <?php if(is_array($result)): foreach($result as $key=>$v): ?><tr>
            <td style="width:30px;">
                <input size="2" name="data[<?php echo ($v['id']); ?>]" type="text" name="sort" value="<?php echo ($v['sort']); ?>"/>
            </td>
            <td><?php echo ($v["id"]); ?></td>
            <td>
                <?php if($v['deep']<=1) echo str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;└─ ',$v['deep']); else echo str_repeat(str_repeat('&nbsp',8),$v['deep']).'└─ '; ?>
                <?php echo ($v["name"]); ?>
            </td>
            <td><?php echo ($categoryType[$v['type']]); ?></td>
            <td><?php echo ($modelTable[$v['model_table']]); ?></td>
            <td><?php echo ($cnt); ?></td>
            <td>
                  <a href="<?php echo U(GROUP_NAME . '/Category/addCategory',array('id'=>$v['id']));?>">添加子栏目</a>
                  <a href="<?php echo U(GROUP_NAME . '/Category/editCategory',array('id'=>$v['id']));?>">编辑</a>
                  <a href="##" onclick="del('<?php echo U(GROUP_NAME . '/Category/delCategory',array(id=>$v[id]));?>)')">删除</a>
            </td>
        </tr><?php endforeach; endif; ?>
    <tr>
        <td colspan="7">
            <button type="submit" class="btn sort">排序</button>&nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>


<script language="Javascript">
    $(function () {
        $('#addnew').click(function(){
            window.location.href="<?php echo U(GROUP_NAME . '/Category/addCategory');?>";
        });

    });
    function del(url)
    {
        if(confirm("确定要删除吗？"))
        {
            window.location.href = url;
        }
    }
</script>
</body>
</html>