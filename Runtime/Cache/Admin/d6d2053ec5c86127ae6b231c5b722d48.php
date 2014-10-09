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
<form action="<?php echo U(GROUP_NAME . '/Product/addProduct');?>"
      method="post" class="definewidth m20" enctype="multipart/form-data">
<table class="table table-bordered table-hover m10">
    <tr>
        <td class="tableleft" style="width:100px;">产品名称</td>
        <td><input type="text" name="title"/></td>
    </tr>
    <tr>
        <td class="tableleft" style="width:100px;">英文名称</td>
        <td><input type="text" name="title_en"/></td>
    </tr>
    <tr>
        <td class="tableleft">分类1(肤肌)</td>
        <td>
            <select name="class1" id="">
                <?php if(is_array($proClass[1])): foreach($proClass[1] as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">分类2(功效)</td>
        <td>
            <select name="class2">
                <?php if(is_array($proClass[2])): foreach($proClass[2] as $key=>$v): ?><option value="<?php echo ($key); ?>"><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
    </tr>
    <tr class="tr-image">
        <td class="tableleft">图片</td>
        <td>
            <input name="image[]" type="file" /> <a href="#" class="addImage">添加</a>
        </td>
    </tr>
    <tr class="tr-argv1">
        <td class="tableleft">参数1(容量)</td>
        <td><input type="text" name="argv1" value=""/></td>
    </tr>
    <tr>
        <td class="tableleft">参数2(价格)</td>
        <td><input type="text" name="argv2" value="0"/>(元)</td>
    </tr>
    <tr class="">
        <td class="tableleft">产品介绍</td>
        <td>
            <textarea id="editor_id" name="desc" style="width:700px;height:300px;"></textarea>
        </td>
    </tr>
    <tr class="">
        <td class="tableleft">使用方法</td>
        <td>
            <textarea name="usage" style="width:500px;height:200px;"></textarea>
        </td>
    </tr>
    <tr>
        <td class="tableleft">排序</td>
        <td><input type="text" style="width: 30px;" name="sort" value="0"/></td>
    </tr>
    <tr>
        <td class="tableleft"></td>
        <td>
            <input type="hidden" name="parent_id" value="<?php echo I('parent_id');?>"/>
            <input type="hidden" name="type" value="<?php echo I('type');?>"/>
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
    });
</script>
</body>
</html>