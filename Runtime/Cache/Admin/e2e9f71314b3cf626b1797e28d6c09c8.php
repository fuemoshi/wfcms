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
<form action="<?php echo U(GROUP_NAME . '/Category/editCategory');?>" method="post" enctype="multipart/form-data">
<table class="table table-bordered table-hover definewidth m10">
    <tr>
        <td width="10%" class="tableleft">选择模型</td>
        <td>
            <select name="model_table" id="">
                <?php if(is_array($modelTable)): foreach($modelTable as $key=>$v): ?><option value="<?php echo ($key); ?>" <?php if($result['model_table'] == $key): ?>selected<?php endif; ?>><?php echo ($v); ?></option><?php endforeach; endif; ?>
            </select>
        </td>
    </tr>
    <tr>
        <td class="tableleft">
            上级栏目
        </td>
        <td>
            <?php echo W('SelectorTree',$category);?>
        </td>
    </tr>
    <tr>
        <td class="tableleft">
            栏目类型
        </td>
        <td>
            列表类型 <input type="radio" name="type" value="0" <?php if($result['type'] == 0): ?>checked<?php endif; ?> checked/>&nbsp;&nbsp;
            单页面 <input type="radio" name="type" value="1" <?php if($result['type'] == 1): ?>checked<?php endif; ?>/>
        </td>
    </tr>
    <tr>
        <td class="tableleft">栏目名称</td>
        <td><input type="text" name="name" value="<?php echo ($result["name"]); ?>"/></td>
    </tr>
    <tr>
        <td class="tableleft">栏目图片</td>
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
   <tr class="tr-next">
        <td class="tableleft"></td>
        <td>
            <input type="hidden" name="id" value="<?php echo ($result["id"]); ?>"/>
            <button type="submit" class="btn btn-primary" type="button">保存</button>
            &nbsp;&nbsp;<button type="button" class="btn btn-success" name="backid" id="backid">返回列表</button>
        </td>
    </tr>

</table>
</form>
<script type="text/javascript">
    $(function(){
        $("#parent_id").val('<?php echo ($result["parent_id"]); ?>');
        $('.addImage').click(function(){
            var obj = $('<tr><td></td><td><input name="image[]" type="file" /></td></tr>');
            $('.tr-next').before(obj);
        });
        $('.delImage').click(function(){
            $(this).parents('li').remove();
        });
    })
</script>
</body>
</html>