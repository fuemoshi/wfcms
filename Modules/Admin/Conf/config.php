<?php
/*
 * 布署到正式环境时注意修改 数据库\全局地址
 * */
return array(

    //'SHOW_PAGE_TRACE' => true,

    'DEFAULT_MODULE' => 'Index',
    'URL_MODEL' => 0, //
    'SESSION_AUTO_START' => true,

    //防远程提交表单
    'TOKEN_ON' => true,
    'TOKEN_NAME' => 'token',
    'TOKEN_TYPE' => 'md5',

    //RBAC
    'RBAC_SUPERADMIN' => 'admin', //超级管理员名称
    'ADMIN_AUTH_KEY' => 'superadmin', //超级管理员标别
    'USER_AUTH_ON' => true, //是否开启认证
    'USER_AUTH_TYPE' => 2, //验证类型 1：登录验证 2：实时验证
    'USER_AUTH_KEY' => 'uid',
    'NOT_AUTH_MODULE' => 'Index,Advertise,Content,Category,Common,Login,News,Pattern,Personal,Product,Public', //
    'NOT_AUTH_ACTION' => '',

    'RBAC_ROLE_TABLE' => 'wf_admin_role',
    'RBAC_USER_TABLE' => 'wf_admin_role_user',
    'RBAC_ACCESS_TABLE' => 'wf_admin_access',
    'RBAC_NODE_TABLE' => 'wf_admin_node',


	//'配置项'=>'配置值'
    //'TMPL_FILE_DEPR'=>'_',
    //'PAGE_TRACE_SAVE'=>true

    'DEFAULT_THEME'  => 'Default',
    'TMPL_DETECT_THEME' => true, // 自动侦测模板主题
    'THEME_LIST'=>'Default,Mobile',//支持的模板主题项

    'TMPL_PARSE_STRING'  =>array(
        '__PUBLIC__' => __ROOT__ . '/Modules/' . GROUP_NAME . '/Public',
        '__JS__'     => __ROOT__ . '/Modules/' . GROUP_NAME . '/Public/Js',
        '__CSS__'    => __ROOT__ .  '/Modules/' . GROUP_NAME . '/Public/Css',
        '__IMAGES__' => __ROOT__ .  '/Modules/' . GROUP_NAME . '/Public/Images',
        '__UPLOADS__' => __ROOT__ . '/Uploads',
    ),

    'UPLOAD_IMAGE' => array(
        'allowExts' => array('jpg','gif','png','jpeg'),
        'savePath' => APP_PATH  . '/Uploads/',
        'thumb' => true,
        'thumbMaxWidth' => 400,
        'thumbMaxHeight' => 400,
    ),

    //'TMPL_L_DELIM'=>'<{',
    //'TMPL_R_DELIM'=>'}>',

    //默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR' => 'Public/jump',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public/jump',

    //{__NOLAYOUT__} <include file="Module:action" />
    'LAYOUT_ON'=> true,
    'LAYOUT_NAME'=>'layout',

    //'VAR_FILTERS'=>'htmlspecialchars',
    //'VAR_PAGE'=>'page',

    //多语言
    'LANG_SWITCH_ON' => true,

    'LANG_AUTO_DETECT' => false,
    'DEFAULT_LANG' => 'zh-cn',
    'LANG_LIST' => 'zh-cn,en-us',
    'VAR_LANGUAGE' => 'l', //切换参数

);
?>
