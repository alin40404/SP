<?php
class MarketGoodsModel extends Model{
	protected $table = "market_goods";
	public function setPageList($p = 1, $pageNum = 5, $id = "",$search="") {
		if (empty ( $id )) {
			while ( true ) {
				$result = $this->order ( "mgid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
			}
		} else if(empty($search)){
			while ( true ) {
				$result = $this->where ( "vid='$id'" )->order ( "mgid" )->page ( "$p,$pageNum" )->select ();
				if ($result == null && $p > 1) {
					$p --;
				} else {
					break;
				}
			}
		}else{
			while ( true ) {
				$result = $this->where ( "vid='$id' and gname like '%$search%'" )->order ( "mgid" )->page ( "$p,$pageNum" )->select ();
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
		return $this->where ( "mid='$id'" )->count ();
	}
	
	/**
	 * 根据名称查询
	 *
	 * @param string $cname
	 * @param int $showNUm
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectByName($name, $showNUm = 50) {
		$result = $this->where ( "gname like '%$name%'" )->limit ( $showNUm )->select ();
		return $result;
	}
	
	public function getTheSearchNum($id,$name) {
		$result = $this->where ( "vid='$id' and gname like '%$name%'" )->count ();
		return $result;
	}
	
	/**
	 * 根据名称精确查询
	 *
	 * @param string $cname
	 * @return Ambigous <mixed, string, boolean, NULL, unknown>
	 */
	public function selectPreciseByName($mid, $gid) {
		$result = $this->where ( "mid='$mid' and gid ='$gid'" )->select ();
		return $result;
	}
	public function selectById($id = 1) {
		return $this->where ( "gid='$id'" )->find ();
	}
	public function selectByVid($id = 1) {
		return $this->where ( "vid='$id'" )->select ();
	}
	
	/**
	 * 根据id编辑
	 *
	 * @param int $cid
	 * @param string $cname
	 * @return Ambigous <boolean, unknown>
	 */
	public function editById($id,$gid, $mid) {

		$data ['gid'] = $gid;
		$data ['mid'] = $mid;
		$result = $this->where ( "mgid='$id'" )->save ( $data );
		if ($result == 1) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 根据id 批量编辑
	 *
	 * @param array $data
	 * @return number
	 */
	public function editAll($mid,array $data) {
		$num = 0;
		foreach ( $data as $id => $name ) {
			$result = $this->editById ($mid, $id);
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
	public function add($mid,$gid) {
		$result = $this->selectPreciseByName ( $mid, $gid );
		if ($result) {
			return false;
		} else {
			$preNum = $this->getTheNum ($mid);
			$data=array();
			$data ['mid'] = $mid;
			$data ['gid'] = $gid;
			$originDB=new Model();
			$sql="insert into sp_market_goods(mgid,mid,gid) values(null,'$mid','$gid')";
			$num=$originDB->query($sql);
			if ($num>=0) {
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
	public function addAll($mid,array $data) {
		$num = 0;
		if($data!=null){
		foreach ( $data as $id => $name ) {
			$result = $this->add ($mid, $id);
			
			// 增加成功
			if ($result) {
				$num ++;
			}
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
		return $this->where ( "gid='$id'" )->delete ();
	}
	
	public function deleteByMid($id) {
		return $this->where ( "gid='$id'" )->delete ();
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