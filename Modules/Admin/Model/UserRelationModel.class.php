<?php
/**
 * User: fuemoshi@gmail.com
 * Date: 14-3-27
 * Time: 上午10:19
 */

class UserRelationModel extends RelationModel{

    protected $tableName = 'admin_user';

    protected $_link = array(
        'admin_role' => array(
            'mapping_type' => MANY_TO_MANY, //HAS_ONE HAS_MANY
            'foreign_key' => 'user_id',
            'relation_foreign_key' => 'role_id', //视频版本是用 relation_key
            'relation_table' => 'admin_role_user',
            'mapping_fields' => 'id , name ,remark'
        )
    );

    public function __construct(){
        parent::__construct();
        $this->_link['admin_role']['relation_table'] = C('DB_PREFIX').$this->_link['admin_role']['relation_table'];
    }
}