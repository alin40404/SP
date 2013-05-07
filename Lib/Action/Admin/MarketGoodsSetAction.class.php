<?php
class MarketGoodsSetAction extends AdminCommonAction{
	public function  showAll() {
		$style = "none";
		
		$db_a = D ( 'Assortment' );
		$db_gv = D ( 'GoodsVariety' );
		$db_g = D ( 'Goods' );
		
		$db_prov = D ( 'MarketProvince' );
		$db_city = D ( 'MarketCity' );
		$db_zone = D ( 'MarketZone' );
		$db_market = D ( 'Market' );
		
		$province = $db_prov->getAll ();
		$this->assign ( 'province', $province );
		$pid = $province [0] ['pid'];
		$pname = $province [0] ['pname'];
		
		$assortment = $db_a->getAll ();
		$this->assign ( 'assortment', $assortment );
		$aid = $assortment [0] ['aid'];
		$aname = $assortment [0] ['aname'];
		
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
		
			}
			$p = $_GET ['p'];
		} else if ($_SERVER ['REQUEST_METHOD'] == 'POST') {
			$_POST = stripslashesDeep ( $_POST );
			$p = $_POST ['p'];
			$aid = $_POST ['aid'];
			$aname = $_POST ['aname'];
			$vid = $_POST ['vid'];
			$vname = $_POST ['vname'];
				
			$pid = $_POST ['pid'];
			$pname = $_POST ['pname'];
			$cid = $_POST ['cid'];
			$cname = $_POST ['cname'];
			$zid = $_POST ['zid'];
			$zname = $_POST ['zname'];
			$marketid = $_POST ['mid'];
			$marketname = $_POST ['mname'];
				
			$search = (isset ( $_POST ['key'] ) ? trim ( $_POST ['key'] ) : $search);
		}
		
		
		$city = $db_city->selectByPid ( $pid );
		$this->assign ( 'city', $city );
		if (! isset ( $cid ) || empty ( $cid )) {
			$cid = $city [0] ['cid'];
			$cname = $city [0] ['cname'];
		}
		
		$zone = $db_zone->selectByCid ( $cid );
		$this->assign ( 'zone', $zone );
		if (! isset ( $zid ) || empty ( $zid )) {
			$zid = $zone [0] ['zid'];
			$zname = $zone [0] ['zname'];
		}
		
		$market = $db_market->selectByZid ( $zid );
		$this->assign ( 'market', $market );
		if (! isset ( $marketid ) || empty ( $marketid )) {
			$marketid = $market [0] ['mid'];
			$marketname = $market [0] ['mname'];
		}
		
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
		
		
		$this->assign ( 'style', $style );
		$this->assign ( 'class', $class );
		$this->assign ( 'info', $info );
		$group = "Admin";
		$this->assign ( 'group', $group );
		$module = "MarketGoodsSet";
		$this->assign ( 'module', $module );
		$replaceId = "marketgoodsSet1";
		$this->assign ( 'replaceId', $replaceId );
		$pref = "marketgoodsSet";
		$this->assign ( 'pref', $pref );
		
		$this->assign ( 'aid', $aid );
		$this->assign ( 'aname', $aname );
		$this->assign ( 'vid', $vid );
		$this->assign ( 'vname', $vname );
		
		$this->assign ( 'prid', $pid );
		$this->assign ( 'pname', $pname );
		$this->assign ( 'cityid', $cid );
		$this->assign ( 'cityname', $cname );
		$this->assign ( 'zoneid', $zid );
		$this->assign ( 'zonename', $zname );
		$this->assign ( 'marketid', $marketid );
		$this->assign ( 'marketname', $marketname );
		
		$this->assign ( 'search', $search );
		$spPlaceHolder = "名称";
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
}