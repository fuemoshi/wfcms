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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; padding: 100px 0 0 0;}
.box{
    width: 420px;
    height: 150px;
    border: 1px solid #ccc;
    margin: 0 auto 225px;
}
.title{
    width: 414px;
    height: 30px;
    line-height: 30px;
    background: url('__IMAGES__/tbg.gif') repeat-x;
    padding: 0px 0 0 6px;
}
.subBox{
    text-align: center;
    font-size: 14px;
    margin-top:30px;
}
.jump{
    padding-top:5px;
}
</style>
</head>
<body>
<div class="system-message">
    <div class="box">
        <div class="title">漫步未来 提示</div>
        <div class="subBox">
           <?php if(isset($message)): ?><span class="tip_suc"><?php echo ($message); ?></span>
           <?php else: ?>
               <span class="tip_red"><?php echo ($error); ?></span><?php endif; ?>

            <p class="jump">
            页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
            </p>
        </div>
    </div>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
</body>
</html>