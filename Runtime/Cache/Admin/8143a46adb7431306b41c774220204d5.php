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
<form action="<?php echo U(GROUP_NAME . '/Site/editSite');?>"
      method="post" class="definewidth m20" enctype="multipart/form-data">
    <table class="table table-bordered table-hover m10">
        <tr>
            <td class="tableleft" style="width:100px;">网站名称</td>
            <td><input type="text" name="site_name" value="<?php echo ($result["site_name"]); ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">网站关键字</td>
            <td><input type="text" style="width: 500px;" name="keywords" value="<?php echo ($result["keywords"]); ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">网站描述</td>
            <td>
                <textarea name="description" id="" style="width:500px;height:100px;"><?php echo ($result["description"]); ?></textarea>
            </td>
        </tr>
        <tr class="tr-argv1">
            <td class="tableleft">公司热线</td>
            <td><input type="text" name="hot_line" value="<?php echo ($result["hot_line"]); ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">客服qq</td>
            <td><input type="text" name="qq_online" value="<?php echo ($result["qq_online"]); ?>"/></td>
        </tr>
        <tr class="">
            <td class="tableleft">联系我们</td>
            <td>
                <textarea id="editor_id" name="contact" style="width:700px;height:300px;"><?php echo ($result["contact"]); ?></textarea>
            </td>
        </tr>
        <tr>
            <td class="tableleft"></td>
            <td>
                <input type="hidden" name="id" value="<?php echo ($result["id"]); ?>"/>
                <button type="submit" class="btn btn-primary" type="button">保存</button>
            </td>
        </tr>
    </table>
</form>
<script charset="utf-8" src="__JS__/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="__JS__/kindeditor/lang/zh_CN.js"></script>
<script>
    KindEditor.ready(function(K) {
        window.editor = K.create('#editor_id');
    });
</script>
</body>
</html>