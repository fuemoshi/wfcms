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
<form action="<?php echo U(GROUP_NAME . '/Personal/editProfile');?>" method="post">
<table class="table table-bordered table-hover definewidth m10">
    <tr><th colspan="2">联系方式</th></tr>
    <tr>
        <td width="10%" class="tableleft">用户帐号</td>
        <td><input type="text" name="username" value="<?php echo ($user["username"]); ?>" disabled/></td>
    </tr>
    <tr>
        <td class="tableleft">密码</td>
        <td><input type="password" name="password"/><span class="tip">(<?php echo (L("pwd_empty_not_save")); ?>)</span></td>
    </tr>
    <tr>
        <td class="tableleft">联系人</td>
        <td><input type="realname" name="realname"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">手机</td>
        <td><input type="text" name="phone" value="<?php echo ($user["phone"]); ?>"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">QQ</td>
        <td><input type="text" name="qq" value="<?php echo ($user["qq"]); ?>"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">联系地址</td>
        <td><input type="text" style="width:480px" name="address" value="<?php echo ($user["address"]); ?>"/></td>
    </tr>
    <tr>
        <td width="10%" class="tableleft">联系邮箱</td>
        <td><input type="text" name="email" value="<?php echo ($user["email"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <input type="hidden" name="id" value="<?php echo ($user["id"]); ?>"/>
            <button type="submit" class="btn btn-primary" type="button">保存</button>
        </td>
    </tr>
</table>
</form>
</body>
</html>