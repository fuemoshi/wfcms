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
<div class="box">
    <div class="wrapper">
        <div id="focus">
            <ul>
                <?php if(is_array($flashImgs)): foreach($flashImgs as $key=>$v): ?><li>
                        <a href="<?php echo $v['url']? 'http://'.$v['url'] : '#'; ?>">
                            <img src="__UPLOADS__/<?php echo ($v["images"]); ?>" alt="<?php echo ($v["title"]); ?>"/>
                        </a>
                    </li><?php endforeach; endif; ?>
            </ul>
        </div><!--focus end-->
    </div><!-- wrapper end -->
</div>

<script type="text/javascript">
    $(function() {
        var sWidth = $("#focus").width(); //获取焦点图的宽度（显示面积）
        var len = $("#focus ul li").length; //获取焦点图个数
        var index = 0;
        var picTimer;

        //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
        var btn = "<div class='btnBg'></div><div class='btn'>";
        for(var i=0; i < len; i++) {
            btn += "<span></span>";
        }
        btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
        $("#focus").append(btn);
        $("#focus .btnBg").css("opacity",0.5);

        //为小按钮添加鼠标滑入事件，以显示相应的内容
        $("#focus .btn span").css("opacity",0.4).mouseover(function() {
            index = $("#focus .btn span").index(this);
            showPics(index);
        }).eq(0).trigger("mouseover");

        //上一页、下一页按钮透明度处理
        $("#focus .preNext").css("opacity",0.2).hover(function() {
            $(this).stop(true,false).animate({"opacity":"0.5"},300);
        },function() {
            $(this).stop(true,false).animate({"opacity":"0.2"},300);
        });

        //上一页按钮
        $("#focus .pre").click(function() {
            index -= 1;
            if(index == -1) {index = len - 1;}
            showPics(index);
        });

        //下一页按钮
        $("#focus .next").click(function() {
            index += 1;
            if(index == len) {index = 0;}
            showPics(index);
        });

        //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
        $("#focus ul").css("width",sWidth * (len));

        //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
        $("#focus").hover(function() {
            clearInterval(picTimer);
        },function() {
            picTimer = setInterval(function() {
                showPics(index);
                index++;
                if(index == len) {index = 0;}
            },4000); //此4000代表自动播放的间隔，单位：毫秒
        }).trigger("mouseleave");

        //显示图片函数，根据接收的index值显示相应的内容
        function showPics(index) { //普通切换
            var nowLeft = -index*sWidth; //根据index值计算ul元素的left值
            $("#focus ul").stop(true,false).animate({"left":nowLeft},300); //通过animate()调整ul元素滚动到计算出的position
            //$("#focus .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
            $("#focus .btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300); //为当前的按钮切换到选中的效果
        }
    });

</script>
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