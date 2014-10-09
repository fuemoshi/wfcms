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
        padding: 0px;
        margin: 0px;
        background: #CCCCCC;
    }
    .left{
        width: 180px;
        margin: 0px 8px 0 0;
        background: #ffffff;
        float:left;
    }
    .right{
        margin: 0px 8px 0 0;
        background: #ffffff;
        position:relative;
        overflow:hidden;
        width: auto;
    }
</style>
<div class="content">
    <div class="left">
        <iframe name="center_frame" id="center_frame" src="<?php echo U(GROUP_NAME.'/Content/left');?>" frameborder="false" scrolling="auto" style="border: none;" width="100%" allowtransparency="true"></iframe>
    </div>
    <div class="right">
        <iframe name="right" id="right" src="<?php echo U(GROUP_NAME.'/Content/right');?>" frameborder="false" scrolling="auto" style="border: none;" width="100%"  allowtransparency="true"></iframe>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $('#center_frame').height($(window).height()-5);
        $('#right').height($(window).height()-5);
    });
</script>


</body>
</html>