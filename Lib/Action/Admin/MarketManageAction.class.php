<?php
class MarketManageAction extends AdminCommonAction {
	public function showAll() {
		$style = "none";
		$db = D ( 'Market' );
		$db1 = D ( 'MarketProvince' );
		$db2 = D ( 'MarketCity' );
		$db3 = D ( 'MarketZone' );
		$db4 = D ( 'Category' );
		
		$category = $db4->getAll ();
		$tempArr = array ();
		foreach ( $category as $key => $value ) {
			$tempArr [$value ['cid']] = $value ['cname'];
		}
		$this->assign ( 'category', $tempArr );
		
		$province = $db1->getAll ();
		$this->assign ( 'province', $province );
		$pid = $province [0] ['pid'];
		$pname = $province [0] ['pname'];
		
		if ($_GET) {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
				$pid = $_GET ['pid'];
				$array = $db1->selectById ( $pid );
				$pname = $array ['pname'];
				$cid = $_GET ['cid'];
				$array = $db2->selectById ( $cid );
				$cname = $array ['cname'];
				$zid = $_GET ['zid'];
				$array = $db3->selectById ( $zid );
				$zname = $array ['zname'];
			}
			$p = $_GET ['p'];
		} else if ($_POST) {
			$p = $_POST ['p'];
			$pid = $_POST ['id'];
			$pname = $_POST ['key'];
			if ($_POST ['pid']) {
				$cid = $pid;
				$cname = $pname;
				$pid = $_POST ['pid'];
				$pname = $_POST ['pname'];
				if ($_POST ['cid']) {
					$zid = $cid;
					$zname = $cname;
					$cid = $_POST ['cid'];
					$cname = $_POST ['cname'];
				}
			}
			//dump($_POST);
		}
		
		$city = $db2->selectByPid ( $pid );
		$this->assign ( 'city', $city );
		if (! isset ( $cid ) || empty ( $cid )) {
			$cid = $city [0] ['cid'];
			$cname = $city [0] ['cname'];
		}
		
		$zone = $db3->selectByCid ( $cid );
		$this->assign ( 'zone', $zone );
		if (! isset ( $zid ) || empty ( $zid )) {
			$zid = $zone [0] ['zid'];
			$zname = $zone [0] ['zname'];
		}
		
		$p = intval ( $p );
		$data = $db->setPageList ( $p, $this->pageNum, $zid );
		$count = $db->getTheNum ( $zid );
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "MarketManage";
		$this->assign ( 'module', $module );
		$replaceId = "marketSet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "marketSet";
		$this->assign ( 'pref', $pref );
		// dump($data);
		// dump($page);
		
		$this->assign ( 'prid', $pid );
		$this->assign ( 'pname', $pname );
		$this->assign ( 'cityid', $cid );
		$this->assign ( 'cityname', $cname );
		$this->assign ( 'zoneid', $zid );
		$this->assign ( 'zonename', $zname );
		
		$spPlaceHolder = "市场";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	public function editByName() {
		$db = D ( 'Market' );
		$db1 = D ( 'MarketZone' );
		$db2 = D ( 'MarketCity' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$ctgid = $_POST ['ctgid'];
			$zoneid = $_POST ['zid'];
			$p = $_POST ['p'];
			
			$result = $db->editById ( $id, $ctgid, $zoneid, $name );
			$array = $db1->selectById ( $zoneid );
			$cid = $array ['cid'];
			$array = $db2->selectById ( $cid );
			$pid = $array ['pid'];
			
			if ($result) {
				$infor = "修改成功！";
				$class = "alert alert-success";
			} else {
				$infor = "名称已存在！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid' => $pid,
				'cid' => $cid,
				'zid' => $zoneid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function addByName() {
		$db = D ( 'Market' );
		$db1 = D ( 'MarketZone' );
		$db2 = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$zid = $_POST ['zid'];
			$array = $db1->selectById ( $zid );
			$cid = $array ['cid'];
			$array = $db2->selectById ( $cid );
			$pid = $array ['pid'];
			
			$ctgid = $_POST ['ctgid'];
			$result = $db->addByName ( $ctgid, $zid, $name );
			// dump($_POST);
			if ($result) {
				$infor = "增加成功！";
				$class = "alert alert-success";
			} else {
				$infor = "名称已存在，增加失败！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid' => $pid,
				'cid' => $cid,
				'zid' => $zid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function deleteById() {
		$db = D ( 'Market' );
		$db1 = D ( 'MarketZone' );
		$db2 = D ( 'MarketCity' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$p = $_POST ['p'];
			
			$array = $db->selectById ( $id );
			$zid = $array ['zid'];
			$array = $db1->selectById ( $zid );
			$cid = $array ['cid'];
			$array = $db2->selectById ( $cid );
			$pid = $array ['pid'];
			
			$result = $db->deleteById ( $id );
			
			if ($result) {
				$infor = "删除成功！";
				$class = "alert alert-success";
			} else {
				$infor = "删除失败！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid' => $pid,
				'cid' => $cid,
				'zid' => $zid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function editAll() {
		$db = D ( 'Market' );
		$db1 = D ( 'MarketZone' );
		$db2 = D ( 'MarketCity' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$zid = $_POST ['zid'];
			$array = $db1->selectById ( $zid );
			$cid = $array ['cid'];
			$array = $db2->selectById ( $cid );
			$pid = $array ['pid'];
			unset ( $_POST ['zid'] );
			
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			// dump($data);
			foreach ( $data as $id => $array ) {
				
				$result = $db->editById ( $id, $array ['ctgid'], $zid, $array ['name'] );
				if ($result) {
					$editNum ++;
				}
			}
			
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "保存成功！";
			$class = "alert alert-info";
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid' => $pid,
				'cid' => $cid,
				'zid' => $zid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
	public function deleteAll() {
		$db = D ( 'Market' );
		$db1 = D ( 'MarketZone' );
		$db2 = D ( 'MarketCity' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			$first = true;
			//dump($data);
			
			foreach ( $data as $id => $name ) {
				if ($first) {
					$array = $db->selectById ( $id );
					$zid = $array ['zid'];
					$array = $db1->selectById ( $zid );
					$cid = $array ['cid'];
					$array = $db2->selectById ( $cid );
					$pid = $array ['pid'];
					$first = false;
				}
				
				$result = $db->deleteById ( $id );
				if ($result) {
					$editNum ++;
				}
			}
			
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "共删除" . $editNum . "条记录！";
			$class = "alert alert-info";
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid' => $pid,
				'cid' => $cid,
				'zid' => $zid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor 
		) );
	}
}