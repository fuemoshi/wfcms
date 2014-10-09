<?php
/*
 * 布署到正式环境时注意修改 数据库\全局地址
 * */
return array(

    //内容模型暂时写成配置形式
    'MODEL_TABLE' => array(
        'news' => '文章模型',
        'product' => '产品模型'
    ),
    'CATEGORY_TYPE' => array(
        '0' => '列表',
        '1' => '单页',
    ),


    //'SHOW_PAGE_TRACE' => true,

    'DEFAULT_MODULE' => 'Index',
    'URL_MODEL' => 0, //
    'SESSION_AUTO_START' => true,

    //防远程提交表单
    'TOKEN_ON' => true,
    'TOKEN_NAME' => 'token',
    'TOKEN_TYPE' => 'md5',

    'DEFAULT_THEME'  => 'Default',
    'TMPL_DETECT_THEME' => true, // 自动侦测模板主题
    'THEME_LIST'=>'Default,Mobile',//支持的模板主题项

    'TMPL_PARSE_STRING'  =>array(
        '__PUBLIC__' => __ROOT__ . '/Modules/' . GROUP_NAME . '/Public',
        '__JS__'     => __ROOT__ . '/Modules/' . GROUP_NAME . '/Public/Js',
        '__CSS__'    => __ROOT__ . '/Modules/' . GROUP_NAME . '/Public/Css',
        '__IMAGES__'    => __ROOT__ .  '/Modules/' . GROUP_NAME . '/Public/Images',
        '__UPLOADS__' => __ROOT__ . '/Uploads'
    ),

    'LAYOUT_ON'=> true,
    'LAYOUT_NAME'=>'layout',

    'LANG_SWITCH_ON' => true,

    'LANG_AUTO_DETECT' => false,
    'DEFAULT_LANG' => 'zh-cn',
    'LANG_LIST' => 'zh-cn,en-us',
    'VAR_LANGUAGE' => 'l', //切换参数

);
?>
