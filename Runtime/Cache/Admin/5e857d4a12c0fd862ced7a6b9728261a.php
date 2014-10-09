<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo (L("management_system")); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="__PUBLIC__/assets/css/dpl-min.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/assets/css/bui-min.css" rel="stylesheet" type="text/css"/>
    <link href="__PUBLIC__/assets/css/main-min.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<div class="header">

    <div class="dl-title">
        <!--<img src="/chinapost/Public/assets/img/top.png">-->
    </div>

    <div class="dl-log"><?php echo (L("welcome")); ?> , <span class="dl-log-user"><?php echo ($username); ?></span><a href="<?php echo U(GROUP_NAME . '/Index/logout');?>"
                                                                    title="<?php echo (L("logout")); ?>" class="dl-log-quit">[退出]</a>
    </div>
</div>
<div class="content">
    <div class="dl-main-nav">
        <div class="dl-inform">
            <div class="dl-inform-title"><s class="dl-inform-icon dl-up"></s></div>
        </div>
        <ul id="J_Nav" class="nav-list ks-clear">
            <?php $first=true; ?>
            <?php if(is_array($topMenu)): foreach($topMenu as $key=>$v): ?><li class="nav-item dl-selected">
                    <div class="nav-item-inner <?php if($first): ?>nav-home<?php else: ?>nav-order<?php endif; ?>"><?php echo ($v); ?></div>
                </li>
                <?php $first=false; endforeach; endif; ?>
        </ul>
    </div>
    <ul id="J_NavContent" class="dl-tab-conten">

    </ul>
</div>
<br/>
<br/>


<script type="text/javascript" src="__PUBLIC__/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/assets/js/bui-min.js"></script>
<script type="text/javascript" src="__PUBLIC__/assets/js/common/main-min.js"></script>
<script type="text/javascript" src="__PUBLIC__/assets/js/config-min.js"></script>
<script>

    BUI.use('common/main', function () {
        var config = <?php echo ($jsonMenu); ?>;
        new PageUtil.MainPage({
            modulesConfig: config
        });
    });
</script>
</body>
</html>