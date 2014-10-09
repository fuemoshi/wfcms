<?php
return array(
    //'SHOW_PAGE_TRACE' => true,

    'APP_GROUP_LIST' => 'Index,Admin',
    'DEFAULT_GROUP' => 'Index',
    'APP_GROUP_MODE' => 1,
    'APP_GROUP_PATH' => 'Modules',

    'LOAD_EXT_CONFIG' => 'menu_cn-zh',

    'DB_HOST' => 'localhost',
    'DB_USER' => 'root',
    'DB_PWD' => '!QAZ@WSX',
    'DB_NAME' => 'wfcms',
    'DB_PREFIX' => 'wf_',

    //内容模型暂时写成配置形式
    'MODEL_TABLE' => array(
        'news' => '文章模型',
        'product' => '产品模型'
    ),
    'CATEGORY_TYPE' => array(
        '0' => '列表',
        '1' => '单页',
    ),
    'PRODUCT_CLASS' => array(
        1 => array(
            '请选择分类',
            '适用肤质',
            '干性肌肤',
            '油性肌肤',
            '混合型肌肤',
            '敏感肌肤',
            '敏感肌肤',
            '中性肌肤'
        ),
        2 => array(
            '请选择分类',
            '补水保湿',
            '美白/驱黑',
            '祛痘/痘印',
            '控油平衡',
            '收细毛孔',
            '抗敏舒缓',
            '眼袋/黑眼圈',
            '祛斑淡斑',
            '面部清洁',
            '修复受损',
            '紧致抗皱'
        )
    ),
);
?>
