<?php
class PriceUnitsModel extends Model {
	protected $table = "price_units";
	public function setPageList($p = 1, $pageNum = 5) {
		while ( true ) {
			$result = $this->order ( "cid" )->page ( "$p,$pageNum" )->select ();
			if ($result == null && $p > 1) {
				$p --;
			} else {
				break;
			}
		}
		return $result;
	}
	/**
	 * 获取所有内容
	 *
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function getAll(array $limit = array()) {
		if ($limit == null) {
			return $this->order ( "uid" )->select ();
		}
		return $this->order ( "uid" )->limit ( "$limit[begin],$limit[offset]" )->select ();
	}
	public function getTheNum() {
		$data = $this->select ();
		return count ( $data );
	}
	
	/**
	 * 根据名称查询
	 *
	 * @param string $cname        	
	 * @param int $showNUm        	
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectByName($cname, $showNUm = 50) {
		$result = $this->where ( "cname like '%$cname%'" )->limit ( $showNUm )->select ();
		return $result;
	}
	public function getTheSearchNum($cname) {
		$result = $this->where ( "cname like '%$cname%'" )->count ();
		return $result;
	}
	
	
	
	/**
	 * 根据名称精确查询
	 *
	 * @param string $cname        	
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectPreciseByName($name) {
		$result = $this->where ( "uname ='$name'" )->select ();
		return $result;
	}
	/**
	 * 根据id编辑
	 *
	 * @param int $id        	
	 * @param string $name        	
	 * @return Ambigous <boolean, unknown>
	 */
	public function editById($id, $name) {
		$result = $this->selectPreciseByName ( $name );
		$result=false;
		if ($result) {
			return false;
		} else {
			$data ['uname'] = $name;
			$result = $this->where ( "uid='$id'" )->save ( $data );
			if ($result == 1) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	/**
	 * 根据id 批量编辑
	 *
	 * @param array $data        	
	 * @return number
	 */
	public function editAll(array $data) {
		$num = 0;
		foreach ( $data as $id => $name ) {
			$result = $this->editById ( $id, $name );
			// 修改成功
			if ($result) {
				$num ++;
			}
		}
		return $num;
	}
	
	/**
	 * 由$name 增加
	 *
	 * @param string $name        	
	 */
	public function addByName($name) {
		$result = $this->selectPreciseByName ( $name );
		$result=false;
		if ($result) {
			return false;
		} else {
			$preNum = $this->getTheNum ();
			$data ['uname'] = $name;
			$num = $this->data ( $data )->add ();
			if ($preNum < $num) {
				return true;
			} else {
				return false;
			}
		}
	}
	
	/**
	 * (non-PHPdoc)
	 *
	 * @see Model::addAll()
	 */
	public function addAll(array $data) {
		$num = 0;
		foreach ( $data as $id => $name ) {
			$result = $this->addByName ( $id, $name );
			// 增加成功
			if ($result) {
				$num ++;
			}
		}
		return $num;
	}
	/**
	 * 根据$cid删除
	 *
	 * @param int $cid        	
	 * @return Ambigous <mixed, boolean, unknown>
	 */
	public function deleteById($id) {
		return $this->where ( "uid='$id'" )->delete ();
	}
	
	/**
	 * 根据$cid 批量删除
	 *
	 * @param array $data        	
	 * @return number
	 */
	public function deleteAll(array $data) {
		$num = 0;
		foreach ( $data as $key => $id ) {
			$result = $this->deleteById ( $id );
			// 删除成功
			if ($result) {
				$num ++;
			}
		}
		return $num;
	}
}