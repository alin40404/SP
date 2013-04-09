<?php
class CitySetAction extends AdminCommonAction{
	// 市
	public function showAll() {
		$style = "none";
		$db = D ( 'MarketCity' );
		$db1 =D ( 'MarketProvince' );
		$province=$db1->getAll();
		$this->assign('province',$province);
		$pid=$province[0]['pid'];
		$pname=$province[0]['pname'];
	
		if ($_GET) {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$infor = $_GET ['infor'];
				$pid=$_GET['pid'];
				$array=$db1->selectById($pid);
				$pname=$array['pname'];
			}
			$p = $_GET ['p'];
		} else if ($_POST) {
			$p = $_POST ['p'];
			$pid=$_POST['pid'];
			$pname=$_POST['pname'];
			
			}

		$p=($p==false?1:$p);
		$p = intval ( $p );
		$data = $db->setPageList ( $p, $this->pageNum,$pid);
		$count = $db->getTheNum ($pid);
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );

	
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'infor', $infor );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "CitySet";
		$this->assign ( 'module', $module );
		$replaceId = "citySet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "citySet";
		$this->assign ( 'pref', $pref );
		// dump($data);
		// dump($page);

		$this->assign('prid',$pid);
		$this->assign('pname',$pname);
		
		$spPlaceHolder = "市/区";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	
	public function editByName() {
		$db = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			// $result = infor_partition_editById ( $id, $name );
			$result = $db->editById ( $id, $name );
			$array=$db->selectById($id);
			$pid=$array['pid'];
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
				'pid'=>$pid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function addByName() {
		$db = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$pid=$_POST['pid'];
			// $result = infor_partition_addByName ( $cname );
	
			$result = $db->addByName ($pid,$name );
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
				'pid'=>$pid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function deleteById() {
		$db = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$p = $_POST ['p'];
			
			$array=$db->selectById($id);
			$pid=$array['pid'];
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
				'pid'=>$pid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	
// 	public function searchByName() {
// 		if ($_POST) {
// 			$_POST = stripslashesDeep ( $_POST );
// 			$name = $_POST ['key'];
// 			$search = "search";
// 		}
	
// 		$this->redirect ( 'showAll', array (
// 				'search' => $search,
// 				'name' => $name
// 		) );
// 	}
	
	public function editAll() {
		$db = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {
				// $result = infor_partition_editById ( $id, $name );
				$result = $db->editById ( $id, $name );
				if ($result) {
					$editNum ++;
				}
			}
			
			$array=$db->selectById($id);
			$pid=$array['pid'];
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "保存成功！";
			$class = "alert alert-info";
			$style = "block";
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid'=>$pid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
	public function deleteAll() {
		$db = D ( 'MarketCity' );
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			unset ( $_POST ['p'] );
			$data = $_POST;
			$editNum = 0;
			$num = count ( $data );
			$first=true;
			foreach ( $data as $id => $name ) {
				if($first){
					$array=$db->selectById($id);
					$pid=$array['pid'];
				}
				$result = $db->deleteById ( $id );
				if ($result) {
					$editNum ++;
				}
				$first=false;
			}
			// $infor="共提交".$num."条信息，".$editNum."条信息修改成功！";
			$infor = "共删除" . $editNum . "条记录！";
			$class = "alert alert-info";
			$style = "block";
		}
	
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'pid'=>$pid,
				'style' => $style,
				'class' => $class,
				'infor' => $infor
		) );
	}
}