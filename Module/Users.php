<?php
/**
 * Description of Users
 *
 * @author WangChengjin
 */

namespace Module;

class Users extends \Core\Lib\ModuleBase
{
    public function getUserById($id)
    {
        return \Model\Users::instance()->getUserById($id);
    }
}
