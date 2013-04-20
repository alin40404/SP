<?php
class PriceSetAction extends AdminCommonAction {
	//
	public function showAll() {
		$style = "none";
		$db = D ( 'MarketGoods' );
		
		$db_a = D ( 'Assortment' );
		$db_gv = D ( 'GoodsVariety' );
		$db_g = D ( 'Goods' );
		$db_price_units = D ( 'PriceUnits' );
		
		$db1 = D ( 'MarketProvince' );
		$db2 = D ( 'MarketCity' );
		$db3 = D ( 'MarketZone' );
		$db4 = D ( 'Market' );
		
		$province = $db1->getAll ();
		$this->assign ( 'province', $province );
		$pid = $province [0] ['pid'];
		$pname = $province [0] ['pname'];
		
		$assortment = $db_a->getAll ();
		$this->assign ( 'assortment', $assortment );
		$aid = $assortment [0] ['aid'];
		$aname = $assortment [0] ['aname'];
		
		$addClass = "accordion-body collapse";
		$mtype = "批发";
		$now = mktime ( 0, 0, 0, idate ( "n" ), idate ( "j" ), idate ( "Y" ) );
		
		$search = "";
		if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
			if ($_GET ['style']) {
				unset ( $_GET ['style'] );
				$style = "block";
				$class = $_GET ['class'];
				$info = $_GET ['info'];
				
				$aid = $_GET ['aid'];
				$aname = $_GET ['aname'];
				$vid = $_GET ['vid'];
				$vname = $_GET ['vname'];
				
				$pid = $_GET ['pid'];
				$pname = $_GET ['pname'];
				$cid = $_GET ['cid'];
				$cname = $_GET ['cname'];
				$zid = $_GET ['zid'];
				$zname = $_GET ['zname'];
				$marketid = $_GET ['mid'];
				$marketname = $_GET ['mname'];
				
				$mtype = $_GET ['mtype'];
				$mtime = $_GET ['mtime'];
			}
			$p = $_GET ['p'];
		} else if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			$aid = $_POST ['aid'];
			$aname = $_POST ['aname'];
			$vid = $_POST ['vid'];
			$vname = $_POST ['vname'];
			// $gid=$_POST['gid'];
			// $gname=$_POST['gname'];
			
			$pid = $_POST ['pid'];
			$pname = $_POST ['pname'];
			$cid = $_POST ['cid'];
			$cname = $_POST ['cname'];
			$zid = $_POST ['zid'];
			$zname = $_POST ['zname'];
			$marketid = $_POST ['mid'];
			$marketname = $_POST ['mname'];
			$mtype = $_POST ['mtype'];
			$mtime = $_POST ['mtime'];
			
			$search = (isset ( $_POST ['key'] ) ? trim ( $_POST ['key'] ) : $search);
		}
// 		dump($_POST);
		
		
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
		
		$market = $db4->selectByZid ( $zid );
		$this->assign ( 'market', $market );
		if (! isset ( $marketid ) || empty ( $marketid )) {
			$marketid = $market [0] ['mid'];
			$marketname = $market [0] ['mname'];
		}
		
		// dump($marketid);
		
		$goodsVariety = $db_gv->selectByAid ( $aid );
		$this->assign ( 'goodsVariety', $goodsVariety );
		if (! isset ( $vid ) || empty ( $vid )) {
			$vid = $goodsVariety [0] ['vid'];
			$vname = $goodsVariety [0] ['vname'];
		}
		
		$originDB = new Model ();
		if ($vid === null || $vid < 0) {
			$goods = array ();
			$marketgoods = array ();
		} else if ($marketid === null || $marketid < 0) {
			$goods = $db_g->selectByVid ( $vid );
			$marketgoods = array ();
		} else {
			
			$sql = "select gid from sp_market_goods where mid='$marketid'";
			$sql_g = "select gid,gname from sp_goods where vid='$vid' and gid not in (" . $sql . ")";
			$sql_mg = "select gid,gname from sp_goods where vid='$vid' and gid in (" . $sql . ")";
			
			$goods = $originDB->query ( $sql_g );
			$marketgoods = $originDB->query ( $sql_mg );
		}
		
		$this->assign ( 'goods', $goods );
		$this->assign ( 'marketgoods', $marketgoods );
		// if(! isset ( $gid ) || empty ( $gid )){
		// $gid=$goods[0]['gid'];
		// $gname=$goods[0]['gname'];
		// }
		if (isset ( $mtime ) && ! empty ( $mtime )) {
			$time = explode ( '-', $mtime );
			$now = mktime ( 0, 0, 0, $time [1], $time [2], $time [0] );
		} else {
			$mtime = date ( "Y-n-j", time () );
		}
		// dump($now);
		// dump($time);
		
		$p = ($p == false ? 1 : $p);
		$p = intval ( $p );
		if ($marketid === null || $marketid < 0) {
			$data = array ();
		} else {
			$begin = ($p - 1) * $this->pageNum + 1;
			$end = $p * $this->pageNum;
			$sql_mg = "select gid,gname from sp_goods where gid in (" . $sql . ") order by gid asc limit $begin,$end ";
			$data = $originDB->query ( $sql_mg );
			
			$sql_temp = "SELECT `mgid`, `mtype`, `price`, `maxprice`, `minprice`, `uid` FROM `sp_market_price` WHERE `mtype`='$mtype' and `mtime`=$now and `mgid` = ";
			foreach ( $data as $id => $value ) {
				$gid = $value ['gid'];
				$sql_mg = $sql_temp . "(select mgid from sp_market_goods where mid='$marketid' and gid='$gid' limit 1) ";
				$result = $originDB->query ( $sql_mg );
				if ($result != null) {
					$data [$id] = array_merge ( $value, $result [0] );
				}
			}
			$units = $db_price_units->getAll();
			
		}
		if (! empty ( $search )) {
			$count = $db->getTheSearchNum ( $vid, $search );
			$info = "搜索结果如下，共" . $count . "条信息";
			$class = "alert alert-success";
			$style = "block";
		} else {
			// $count = $db->getTheNum ( $vid );
			$sql_mg = "select count(gid) as num from sp_goods where gid in (" . $sql . ") ";
			
			$result = $originDB->query ( $sql_mg );
			$count = intval ( $result [0] ['num'] );
		}
		$page = showPage ( $count, $p, $this->pageNum, $this->rollPages );
		
		$this->assign ( 'addClass', $addClass );
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'info', $info );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "PriceSet";
		$this->assign ( 'module', $module );
		$replaceId = "goodspriceSet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "GoodspriceSet";
		$this->assign ( 'pref', $pref );
		
		$this->assign ( 'aid', $aid );
		$this->assign ( 'aname', $aname );
		$this->assign ( 'vid', $vid );
		$this->assign ( 'vname', $vname );
		// $this->assign('gid',$gid);
		// $this->assign('gname',$gname);
		
		$this->assign ( 'prid', $pid );
		$this->assign ( 'pname', $pname );
		$this->assign ( 'cityid', $cid );
		$this->assign ( 'cityname', $cname );
		$this->assign ( 'zoneid', $zid );
		$this->assign ( 'zonename', $zname );
		$this->assign ( 'marketid', $marketid );
		$this->assign ( 'marketname', $marketname );
		
		$this->assign ( 'mtype', $mtype );
		$this->assign ( 'mtime', $mtime );
		$this->assign ( 'units', $units );
		
		$this->assign ( 'search', $search );
		$spPlaceHolder = "名称";
		$this->assign ( "data", $data );
		$this->assign ( 'pgInfo', $page ['pgInfo'] );
		$this->assign ( 'page', $page ['page'] );
		$this->assign ( "spPlaceHolder", $spPlaceHolder );
		$this->display ();
	}
	public function editMarketgoods() {
		$db = D ( 'MarketGoods' );
		
		if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$_POST = stripslashesDeep ( $_POST );
			$get = $_POST ['get'];
			$p = $get ['p'];
			$aid = $get ['aid'];
			$aname = $get ['aname'];
			$vid = intval ( $get ['vid'] );
			$vname = $get ['vname'];
			
			$pid = $get ['pid'];
			$pname = $get ['pname'];
			$cid = $get ['cid'];
			$cname = $get ['cname'];
			$zid = $get ['zid'];
			$zname = $get ['zname'];
			$marketid = intval ( $get ['mid'] );
			$marketname = $get ['mname'];
			
			unset ( $_POST ['get'] );
			$data = $_POST;
			if ($marketid === null || $marketid < 0) {
				$info = "未创建市场名称！";
				$class = "alert alert-error";
			} else if ($vid === null || $vid < 0) {
				$info = "未创建品种名称！";
				
				$class = "alert alert-error";
			} else {
				$sql = "delete from sp_market_goods where mid='$marketid' and gid in (select gid from sp_goods where vid='$vid') ";
				$originDB = new Model ();
				$originDB->query ( $sql );
				$db->addAll ( $marketid, $data );
				$info = "已修改！";
				$class = "alert alert-success";
			}
			$style = "block";
		}
		
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'aid' => $aid,
				'aname' => $aname,
				'vid' => $vid,
				'vname' => $vname,
				'pid' => $pid,
				'pname' => $pname,
				'cid' => $cid,
				'cname' => $cname,
				'zid' => $zid,
				'zname' => $zname,
				'mid' => $marketid,
				'mname' => $marketname,
				'style' => $style,
				'class' => $class,
				'info' => $info 
		) );
	}
	
	
	public function addByUnitsName(){
		$db = D ( 'PriceUnits' );

		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$post_array=array();
			$post_array = stripslashesDeep ( $_POST );
			$name = $post_array ['key'];
			$result = $db->addByName ( $name );
			
			if ($result) {
				$info = "单位名称增加成功！";
				$class = "alert alert-success";
			} else {
				$info = "单位名称已存在，增加失败！";
				$class = "alert alert-error";
			}
			$style = "block";
			unset($post_array['key']);
			$post_array['style']=$style;
			$post_array['info']=$info;
			$post_array['class']=$class;
		}
// 		dump($post_array);
// 		exit();
		$this->redirect ( 'showAll',$post_array );
	}
	
	public function editByUnitsName() {
		$db = D ( 'PriceUnits' );

		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$post_array=array();
			$post_array = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
			$name = $post_array ['key'];
	
			$result = $db->editById ( $id, $name );
			
			if ($result) {
				$info = "单位名称修改成功！";
				$class = "alert alert-success";
			} else {
				$info = "单位名称修改失败！";
				$class = "alert alert-error";
			}
			$style = "block";
			unset($post_array['key']);
			$post_array['style']=$style;
			$post_array['info']=$info;
			$post_array['class']=$class;
		}
// 		dump($post_array);
// 		exit();
		$this->redirect ( 'showAll',$post_array );
				
	}
	
	public function addByName() {
		$db = D ( 'Goods' );
		// $db1 = D ( 'GoodsVariety' );
		
		if ($_POST) {
			$_POST = stripslashesDeep ( $_POST );
			$name = $_POST ['key'];
			$p = $_POST ['p'];
			$id = $_POST ['vid'];
			$gdesc = $_POST ['gdesc'];
			$img = $_POST ['img'];
			if (file_exists ( $img )) {
				$pathinfo = pathinfo ( $img );
				$filename = $pathinfo ['basename'];
				$savePath = C ( 'UPLOAD_GOODS_IMG_URL' );
				if (! file_exists ( $savePath )) {
					mkdirs ( $savePath );
				}
				copy ( $img, $savePath . $filename );
				// move_uploaded_file($img,$savePath.$filename);
				unlink ( $img );
				
				$img = $savePath . $filename;
			} else {
				$img = C ( 'DEFAULT_GOODS_IMG' );
			}
			
			$result = $db->addByName ( $id, $name, $gdesc, $img );
			
			if ($result) {
				$info = "增加成功！";
				$class = "alert alert-success";
			} else {
				$info = "名称已存在，增加失败！";
				$class = "alert alert-error";
			}
			$style = "block";
		}
		$this->redirect ( 'showAll', array (
				'p' => $p,
				'vid' => $id,
				'addClass' => 'accordion-body collapse in',
				'style' => $style,
				'class' => $class,
				'info' => $info 
		) );
	}
	
	public function deleteByUnitsId() {
		$db = D ( 'PriceUnits' );

		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$post_array=array();
			$post_array = stripslashesDeep ( $_POST );
			$id = $_POST ['id'];
	
			$result = $db->deleteById ( $id );
			
			if ($result) {
				$info = "单位名称删除成功！";
				$class = "alert alert-success";
			} else {
				$info = "单位名称删除失败！";
				$class = "alert alert-error";
			}
			$style = "block";
			$post_array['style']=$style;
			$post_array['info']=$info;
			$post_array['class']=$class;
		}

		$this->redirect ( 'showAll',$post_array );
		
	}
	
	public function editAllByUnits() {
		$db = D ( 'PriceUnits' );
		
	if ($_SERVER['REQUEST_METHOD']=='POST') {
			$post_array=array();
			$post_array = stripslashesDeep ( $_POST );
			$data = $post_array ['data'];
			unset ($post_array ['data'] );
			
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {

				$result = $db->editById ( $id, $name);
				if ($result) {
					$editNum ++;
				}
			}
			
			$info = "共提交" . $num . "条记录,已修改".$editNum."条记录";
			$class = "alert alert-info";
			
			$style = "block";
			$post_array['style']=$style;
			$post_array['info']=$info;
			$post_array['class']=$class;
		}

		$this->redirect ( 'showAll',$post_array );	
	}
	
	public function deleteAllByUnits() {
		$db = D ( 'PriceUnits' );
		
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$post_array=array();
			$post_array = stripslashesDeep ( $_POST );
			$data = $post_array ['data'];
			unset ($post_array ['data'] );
				
			$editNum = 0;
			$num = count ( $data );
			foreach ( $data as $id => $name ) {
		
			$result = $db->deleteById ( $id );
				if ($result) {
					$editNum ++;
				}
			}
				
			$info = "共删除" . $editNum . "条记录！";
			$class = "alert alert-info";
			$style = "block";				

			$post_array['style']=$style;
			$post_array['info']=$info;
			$post_array['class']=$class;
		}
		
		$this->redirect ( 'showAll',$post_array );
		
	}
}