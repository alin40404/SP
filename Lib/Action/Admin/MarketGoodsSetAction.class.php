<?php
class MarketGoodsSetAction extends AdminCommonAction{
	public function  showAll() {
		$db_a = D ( 'Assortment' );
		$db_gv = D ( 'GoodsVariety' );
		$db_g = D ( 'Goods' );
		
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
	}
}