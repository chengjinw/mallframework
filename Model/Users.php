<?php
/**
 * Description of Users
 *
 * @author WangChengjin
 */

namespace Model;

class Users extends \Core\Lib\ModelBase
{
    const TABLE_NAME = 'wm_users';

    public function getUserList()
    {
        return $this->db->read()->select()->from(self::TABLE_NAME)->queryAll();
    }
    
    public function getUserById($id)
    {
        $arr = array('id' => $id);
        return $this->db->write()->select()->from(self::TABLE_NAME)->where($arr)->queryRow();
    }
}
