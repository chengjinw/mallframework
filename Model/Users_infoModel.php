<?php
/**
	 * name
	 *
	 * @param array 
	 * @param obj 
	 * @return array 
	 */

namespace Model;


class Users_infoMoedl extends \Core\Lib\ModelBase{
	const TABLE_NAME = 'wm_users_info';

	/**
	 * 根据id查询用户信息
	 * @param $id id
	 */
	public function getUsersInfo($id){
		$arr = array('users_id' => $id);
		return $this->db->read()->select()->from(self::TABLE_NAME)->where($arr)->queryRow();


	}

	/**
	 * 根据条件查询
	 * @param $where
	 */
	public function getUsersInfoByWhere($where){

	}

} 