<?php
/**
 * UserVerifiedModel.class.php
 * user_verified 表操作
 * @copyright			copyright(c)  2013
 * @author alin.chen
 *
 */
class UserVerifiedModel extends Model {
   // protected $table='user_verified';
	
	public function selectByUnameAndPW($user,$password){
		if(empty($user)||empty($password)){
			return NULL;
		}else{
			$password=md5($password);
			return $this->where("uname='$user' and password='$password'")->select();
//             return $this->select();
		}
	}
	
	/**
	 *  添加数据操作
	 * @param array $params
	 */
	public function _add(array $params) {
		return $id = $this->data ( $params )->add ();
	}
	/**
	 * 修改数据
	 * @param  $uid
	 * @param array $data
	 */
	public function _edit($uid, array $data) {
		return $this->where ( "uid='$uid'" )->save ( $data );
	}
	
	/**
	 * 删除数据
	 * @param  $uid
	 * @return mixed
	 */
	public function _delete($uid) {
		return $this->where ( "uid='$uid'" )->delete ();
	}
	
	/**
	 * 根据uid查询数据
	 * @param  $uid
	 * @param  $keys 要显示的字段
	 * @return mixed
	 */
	public function infor($uid, $keys = array()) {
		if (empty ( $keys )) {
			$field = '*';
		} else {
			$field = implode ( ',', $keys );
		}
		
		return $this->field ( $field )->where ( "uid='$uid'" )->find ();
	}
	
	/**
	 * 查询用户名
	 * @param  $uname
	 * @param  $keys 要显示的字段
	 * @return mixed
	 */
	public function inforByUname($uname, $keys = array()) {
		if (empty ( $keys )) {
			$field = '*';
		} else {
			$field = implode ( ',', $keys );
		}
		
		return $this->field ( $field )->where ( "uname='$uname'" )->find ();
	}
	
	/**
	 * 获取所有信息
	 * @param array $param 查询用户名参数
	 * @param array $limit
	 * @return mixed
	 */
	public function getAll(array $param, array $limit = array()) {
		$result = array (
				'count' => 0,
				'data' => array () 
		);
		$where = '1=1';
		if (isset ( $param ['uname'] )) {
			$where .= " and uname like '%$param[uname]%'";
		}
		$result ['count'] = $this->where ( $where )->count ();
		$result ['data'] = $this->where ( $where )
		 						->order ( "uname desc" )
								->limit ( "$limit[begin],$limit[offset]" )
								->select ();
		return $result;
	}
}