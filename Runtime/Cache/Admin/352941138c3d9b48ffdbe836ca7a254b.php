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
<form action="<?php echo U(GROUP_NAME . '/Advertise/editAdvertise');?>"
      method="post" class="definewidth m20" enctype="multipart/form-data">
    <table class="table table-bordered table-hover m10">
        <tr>
            <td class="tableleft" style="width:100px;">标题</td>
            <td><input type="text" name="title" value="<?php echo ($result["title"]); ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">类别/位置</td>
            <td>
                <select name="position" id="">
                    <?php if(is_array($posMap)): foreach($posMap as $key=>$v): ?><option <?php if($result['position'] == $key): ?>selected<?php endif; ?> value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
                </select>
            </td>
        </tr>
        <tr class="tr-image">
            <td class="tableleft">图片</td>
            <td>
                <ul>
                    <?php if(is_array($images)): foreach($images as $key=>$v): if($v): ?><li style="padding:5px;">
                                <img src="__UPLOADS__/thumb_<?php echo ($v); ?>" width="100" height="100" alt=""/>
                                <input type="text" name="images[]" value="<?php echo ($v); ?>"/>
                                <a href="#" class="delImage">移除</a>
                            </li><?php endif; endforeach; endif; ?>
                </ul>
                <a href="#" class="addImage">添加</a>
            </td>
        </tr>
        <tr class="tr-argv1">
            <td class="tableleft">链接</td>
            <td>http://<input type="text" name="url" value="<?php echo ($result["url"]); ?>"/></td>
        </tr>
        <tr>
            <td class="tableleft">排序</td>
            <td><input type="text" style="width: 30px;" name="sort" value="<?php echo ($result["sort"]); ?>"/></td>
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
    $(function(){
        $('.addImage').click(function(){
            var obj = $('<tr><td></td><td><input name="image[]" type="file" /></td></tr>');
            $('.tr-argv1').before(obj);
        });
        $('.delImage').click(function(){
            $(this).parents('li').remove();
        });
    });
</script>
</body>
</html>