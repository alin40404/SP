<?php
class CategoryModel extends Model {
	protected $table = "category";
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
			return $this->order ( "cid" )->select ();
		}
		return $this->order ( "cid" )->limit ( "$limit[begin],$limit[offset]" )->select ();
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
	public function selectPreciseByName($cname) {
		$result = $this->where ( "cname ='$cname'" )->select ();
		return $result;
	}
	/**
	 * 根据id编辑
	 *
	 * @param int $cid        	
	 * @param string $cname        	
	 * @return Ambigous <boolean, unknown>
	 */
	public function editById($cid, $cname) {
		$result = $this->selectPreciseByName ( $cname );
		if ($result) {
			return false;
		} else {
			$data ['cname'] = $cname;
			$result = $this->where ( "cid='$cid'" )->save ( $data );
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
		foreach ( $data as $cid => $cname ) {
			$result = $this->editById ( $cid, $cname );
			// 修改成功
			if ($result) {
				$num ++;
			}
		}
		return $num;
	}
	
	/**
	 * 由$cname 增加
	 *
	 * @param string $cname        	
	 */
	public function addByName($cname) {
		$result = $this->selectPreciseByName ( $cname );
		if ($result) {
			return false;
		} else {
			$preNum = $this->getTheNum ();
			$data ['cname'] = $cname;
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
		foreach ( $data as $cid => $cname ) {
			$result = $this->addByName ( $cid, $cname );
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
	public function deleteById($cid) {
		return $this->where ( "cid='$cid'" )->delete ();
	}
	
	/**
	 * 根据$cid 批量删除
	 *
	 * @param array $data        	
	 * @return number
	 */
	public function deleteAll(array $data) {
		$num = 0;
		foreach ( $data as $key => $cid ) {
			$result = $this->deleteById ( $cid );
			// 删除成功
			if ($result) {
				$num ++;
			}
		}
		return $num;
	}
}