<?php
class MarketCityModel extends Model {
	protected $table = "market_city";
	public function setPageList($p = 1, $pageNum = 5, $pid = "") {
		if (empty ( $pid )) {
			while ( true ) {
				$result = $this->order ( "cid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
			}
		} else {
			while ( true ) {
				$result = $this->where ( "pid='$pid'" )->order ( "cid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
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
			return $this->order ( "cid" )->select ();
		}
		return $this->order ( "cid" )->limit ( "$limit[begin],$limit[offset]" )->select ();
	}
	public function getTheNum($id = 1) {
		return $this->where ( "pid='$id'" )->count ();
	}
	
	/**
	 * 根据名称查询
	 *
	 * @param string $cname        	
	 * @param int $showNUm        	
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectByName($name, $showNUm = 50) {
		$result = $this->where ( "pname like '%$name%'" )->limit ( $showNUm )->select ();
		return $result;
	}
	public function getTheSearchNum($name) {
		$result = $this->where ( "pname like '%$name%'" )->count ();
		return $result;
	}
	
	/**
	 * 根据名称精确查询
	 *
	 * @param string $cname        	
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectPreciseByName($pid, $name) {
		$result = $this->where ( "pid='$pid' and cname ='$name'" )->select ();
		return $result;
	}
	public function selectById($id = 1) {
		return $this->where ( "cid='$id'" )->find ();
	}
	public function selectByPid($pid = 1) {
		return $this->where ( "pid='$pid'" )->select ();
	}
	
	/**
	 * 根据id编辑
	 *
	 * @param int $cid        	
	 * @param string $cname        	
	 * @return Ambigous <boolean, unknown>
	 */
	public function editById($id, $name) {
		$result = $this->selectPreciseByName ( $name );
		if ($result) {
			return false;
		} else {
			$data ['cname'] = $name;
			$result = $this->where ( "cid='$id'" )->save ( $data );
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
	 * @param string $cname        	
	 */
	public function addByName($pid, $name) {
		$result = $this->selectPreciseByName ( $pid, $name );
		if ($result) {
			return false;
		} else {
			$preNum = $this->getTheNum ($pid);
			$data ['cname'] = $name;
			$data ['pid'] = $pid;
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
		return $this->where ( "cid='$id'" )->delete ();
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