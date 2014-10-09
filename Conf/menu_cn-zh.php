<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-27
 * Time: 下午3:09
 */

return array(
    'menu' => array(
        '内容' =>
            array(
                '内容管理' => array(
                    //   array('模型管理','Pattern/pattern'),
                    array('栏目管理','Category/category'),
                    array('管理内容','Content/content'),
                ),
                '模块管理' => array(
                    array('广告管理','Advertise/index'),
                )
            ),

        '系统' =>
            array(
                '我的面板' => array(
                    array('个人资料', 'Personal/editProfile')
                ),
                '系统管理' => array(
                    array('网页配置', 'Site/editSite'),
                    array('用户管理', 'Rbac/user'),
                    array('角色管理', 'Rbac/role'),
                    array('节点管理', 'Rbac/node'),
                    array('操作日志', 'Rbac/userLog'),
                )
            ),

    )
);