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
<style type="text/css">
    body{
        padding-top : 80px;
        background-color: #EFEFEF;
    }
    .form-signin {
        max-width: 150px;
        padding: 21px 22px 9px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05);

        position: absolute;
        z-index: 999;
        left: 47%;
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
        font-family: -webkit-pictograph;
    }

    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 13px;
        height: auto;
        margin-bottom: 8px;
        padding: 2px 3px;
        width:150px;
    }
    .form-signin input[name="verify"]{
        width: 88px;
    }
    .form-signin form{
        width:175px;
    }
    #verifyImg {
        margin-bottom: 8px;
    }
    .logo{
        background: url('__IMAGES__/logo.png') no-repeat;
        position: absolute;
        width: 340px;
        height: 45px;
        left: 26%;
        top: 101px;
        z-index: 1;
    }
</style>
<div class="container">
    <div class="form-signin">
        <form  method="post" action="<?php echo U(GROUP_NAME . '/Login/login');?>">
            <input type="text" name="username" class="input-block-level" placeholder="账号">
            <input type="password" name="password" class="input-block-level" placeholder="密码">
            <input type="text" name="verify" class="input-small" placeholder="验证码">
            <img id="verifyImg" src="<?php echo U(GROUP_NAME.'/Public/verify');?>" onclick="flashVerify()" alt=""/>
            <p><button class="btn btn-small btn-primary" type="submit">登录</button></p>
        </form>
    </div>
    <div class="logo"></div>

</div>

<script language="JavaScript">
    function flashVerify(){
        var time = new Date().getTime();
        $('#verifyImg').attr('src','__APP__/Public/verify/'+time);
    }
</script>

</body>
</html>