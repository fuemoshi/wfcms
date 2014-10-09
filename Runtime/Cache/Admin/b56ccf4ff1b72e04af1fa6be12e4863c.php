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
<link href="__JS__/jstree/docs/assets/dist/themes/default/style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript"  src="__JS__/jstree/dist/jstree.min.js"></script>

<style type="text/css">
    body{
        margin:0px;
        padding:0px;
    }
</style>


<div class="contentLeft" id="jstree_div">
    <?php echo W('ContentLeft',$category);?>
</div>

<script type="text/javascript">
    $(function(){
        $('#jstree_div').jstree();
        function open(){
            alert('fu');
        }
    });
</script>
</body>
</html>