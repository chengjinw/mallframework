<?php
/**
 * 用户表
 * Description of Users
 *
 * @author WangChengjin
 */

namespace Model;

class UsersModel extends \Core\Lib\ModelBase
{
    const TABLE_NAME = 'wm_users';

    public function getUserList()
    {
        return $this->db->read()->select()->from(self::TABLE_NAME)->queryAll();
    }
    
    public function getUserById($id)
    {
        $arr = array('users_id' => $id);
        return $this->db->write()->select()->from(self::TABLE_NAME)->where($arr)->queryRow();
    }
}

