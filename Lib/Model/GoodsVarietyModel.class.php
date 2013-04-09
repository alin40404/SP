<?php
class GoodsVarietyModel extends Model{
	protected $table = "goods_variety";
	public function setPageList($p = 1, $pageNum = 5, $id = "",$search="") {
		if (empty ( $id )) {
			while ( true ) {
				$result = $this->order ( "vid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
			}
		} else if(empty($search)){
			while ( true ) {
				$result = $this->where ( "aid='$id'" )->order ( "vid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
			}
		}else{
			while ( true ) {
				$result = $this->where ( "aid='$id' and vname like '%$search%'" )->order ( "vid" )->page ( "$p,$pageNum" )->select ();
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
			return $this->order ( "vid" )->select ();
		}
		return $this->order ( "vid" )->limit ( "$limit[begin],$limit[offset]" )->select ();
	}
	public function getTheNum($id = 1) {
		return $this->where ( "aid='$id'" )->count ();
	}
	
	/**
	 * 根据名称查询
	 *
	 * @param string $cname
	 * @param int $showNUm
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectByName($name, $showNUm = 50) {
		$result = $this->where ( "vname like '%$name%'" )->limit ( $showNUm )->select ();
		return $result;
	}
	public function getTheSearchNum($id,$name) {
		$result = $this->where ( "aid='$id' and vname like '%$name%'" )->count ();
		return $result;
	}
	
	/**
	 * 根据名称精确查询
	 *
	 * @param string $cname
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectPreciseByName($id, $name) {
		$result = $this->where ( "aid='$id' and vname ='$name'" )->select ();
		return $result;
	}
	public function selectById($id = 1) {
		return $this->where ( "vid='$id'" )->find ();
	}
	public function selectByAid($id = 1) {
		return $this->where ( "aid='$id'" )->select ();
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
			$data ['vname'] = $name;
			$result = $this->where ( "vid='$id'" )->save ( $data );
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
	public function addByName($id, $name) {
		$result = $this->selectPreciseByName ( $id, $name );
		if ($result) {
			return false;
		} else {
			$preNum = $this->getTheNum ($id);
			$data ['vname'] = $name;
			$data ['aid'] = $id;
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
		return $this->where ( "vid='$id'" )->delete ();
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