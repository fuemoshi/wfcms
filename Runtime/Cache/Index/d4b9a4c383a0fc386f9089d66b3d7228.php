<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title><?php echo ($title); ?></title>
    <meta name="keywords" content="<?php echo ($keywords); ?>">
    <meta name="description" content="<?php echo ($description); ?>">
    <link rel="stylesheet" type="text/css" href="__CSS__/style.css?t=<?php echo time();?>" />
    <script type="text/javascript" src="__JS__/jquery.js"></script>
    <script type="text/javascript" src="__JS__/expand.js"></script>
    <script language="javascript" type="text/javascript" src="__JS__/My97DatePicker/WdatePicker.js"></script>
</head>
<body>
<?php echo ($test); ?>
<div class="head_box">
    <div class="head_right">
        <div class="logo_img">
            <img height="90" src="__IMAGES__/logo.png" alt=""/>
        </div>
        <div class="head_right2">
            <form action="<?php echo U(GROUP_NAME . '/Index/products');?>" name="selectForm2" style="margin:0; padding:0;" method="post">
                <table width="260" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td height="5" colspan="2" align="center"></td>
                        <td width="62" rowspan="3" align="center"><img src="__IMAGES__/order.png" width="50" height="55"></td>
                    </tr>
                    <tr>
                        <td height="20" colspan="2" align="right"><a href="<?php echo U(GROUP_NAME . '/Index/check');?>" target="_blank">防伪查询</a>
                    </tr>
                    <tr>
                        <td width="147">
                            <label for="textfield"></label>
                            <input name="title" type="text" class="so_input" id="textfield" value="产品搜索">
                        </td>
                        <td width="51" align="right"><input type="image" src="__IMAGES__/go.gif" width="44" height="20"></td>
                    </tr>
                    </tbody></table>
            </form>
        </div>
    </div>

    <div class="menu_box">
        <ul>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/index');?>" <?php echo $actionName == 'index' ? 'class="menu_selected"' : '' ?> style="width: 88px;">首页</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/about');?>" <?php echo $actionName == 'about' ? 'class="menu_selected"' : '' ?>>关于医朵</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/products');?>" <?php echo $actionName == 'products' ? 'class="menu_selected"' : '' ?>>理肤产品</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/news');?>" <?php echo $actionName == 'news' ? 'class="menu_selected"' : '' ?>>资讯中心</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/sellers');?>" <?php echo $actionName == 'sellers' ? 'class="menu_selected"' : '' ?>>畅销榜单</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/new_products');?>" <?php echo $actionName == 'new_products' ? 'class="menu_selected"' : '' ?>>新品上市</a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/article');?>" <?php echo $actionName == 'article' ? 'class="menu_selected"' : '' ?>>美丽物语</a></li>
        </ul>
    </div>
    <div class="c"></div>
</div>
<script>
    $('#textfield').focus(function(){ $(this).val('');});
</script>
<div class="page_box">
    <div class="pagebg_top">
        <div class="pagebg_bottom">
            <div class="page_left_box">
    <div class="page_left_title"><img src="__IMAGES__/t_<?php echo ($actionName); ?>.png" height="60"></div>
    <div class="page_left_menu">
        <ul>
            <?php if(is_array($category)): foreach($category as $key=>$v): ?><li><a href="<?php echo U(GROUP_NAME . '/Index/'. $actionName , array('type'=>$v['type'],'pid'=>$v['id']));?>"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
            <?php if($actionName == 'about'): ?><li><a href="<?php echo U(GROUP_NAME . '/Index/contact');?>">联系我们</a></li>
                <li><a href="<?php echo U(GROUP_NAME . '/Index/check');?>">防伪查询</a></li>
                <!--<li><a href="<?php echo U(GROUP_NAME . '/Index/sitemap');?>">网站地图</a></li>--><?php endif; ?>
        </ul>
    </div>
    <div class="page_left_ico">
        <ul>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/check');?>"><img src="__IMAGES__/b_securlty.jpg" alt="防伪查询" width="133" height="73" border="0"></a></li>
            <li><a href="<?php echo U(GROUP_NAME . '/Index/article');?>"><img src="__IMAGES__/b_pri.jpg" alt="原液理肤手册" width="133" height="73" border="0"></a></li>
        </ul>
    </div>
</div>
            <div class="page_right_box">
                <div class="page_article_box"><p>
                    <?php echo (htmlspecialchars_decode($result["content"])); ?>
                </div>
            </div>
            <div class="c"></div>
        </div>
    </div>
</div>
<div class="foot_box">
    <div class="foot_menu_box">
        <div class="foot_menu_l">
            <ul>
                <li><a href="##" target="_blank"><img src="__IMAGES__/foot_menu_02.gif" alt="ETO常见问题" width="84" height="17" border="0"></a></li>
                <li style="padding-top: 3px;">
                    <span style="color:#B58C39">
                        咨询专线: <?php echo ($hot_line); ?>
                        <a style="color:#B58C39" href="tencent://message/?uin=<?php echo ($hot_line); ?>&amp;Site=在线客服&amp;Menu=yes">在线客服</a>
                    </span>
                </li>
            </ul>
        </div>
        <div class="foot_menu_r">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> <a class="bds_qzone" title="分享到QQ空间" href="#"></a> <a class="bds_tsina" title="分享到新浪微博" href="#"></a> <a class="bds_tqq" title="分享到腾讯微博" href="#"></a> <a class="bds_renren" title="分享到人人网" href="#"></a> <span class="bds_more"></span></div>
            <!-- Baidu Button END -->
        </div>
        <div class="c"></div>
    </div>
    <div class="foot_menu_box2">
        <div class="foot_menu_box2_l">
            <ul>
                <li><a href="<?php echo U(GROUP_NAME . '/Index/about');?>"><img src="__IMAGES__/foot_menu2_01.gif" alt="ETO医朵介绍" width="64" height="12" border="0"></a></li>
                <li><a href="<?php echo U(GROUP_NAME . '/Index/article');?>"><img src="__IMAGES__/foot_menu2_02.gif" alt="ETO理肤手册" width="64" height="12"></a></li>
                <li><a href="<?php echo U(GROUP_NAME . '/Index/sitemap');?>"><img src="__IMAGES__/foot_menu2_03.gif" alt="ETO网站地图" width="66" height="12" border="0"></a></li>
                <li><a href="<?php echo U(GROUP_NAME . '/Index/contact');?>"><img src="__IMAGES__/foot_menu2_04.gif" alt="联系ETO" width="65" height="12"></a></li>
            </ul>
            <div class="c"></div>
        </div>
        <div class="foot_menu_box2_l" style="margin-left:40px;">
        </div>
        <div class="foot_menu_box2_r">
        </div>
        <div style="width:100%;float:left;margin-top:8px; text-align:center;"><a href="http://zhenpin.org/ " target="_blank"><img src="__IMAGES__/aca.gif"></a></div>
        <div class="c"></div>
    </div>

</div>
        
</body>
</html>