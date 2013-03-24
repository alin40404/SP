<?php
/**
 * 获取category表所有内容
 * @param array $limit 
 * @return array
 */
function infor_partition_getAll(array $limit = array() ){
	$category=D('Category');
	$data=$category->getAll($limit);
	return $data;
}

function infor_partition_num(){
	$category=D('Category');
	return $category->getTheNum();
}

function infor_partition_editById($cid,$cname){
	$category=D('Category');
	return $category->editById($cid,$cname);
}

function infor_partition_editAll(array $data){
	$category=D('Category');
	return $category->editAll($data);
}

function infor_partition_addByName($cname){
	$category=D('Category');
	return $category->addByName($cname);
}

function infor_partition_deleteByCid($cid){
	$category=D('Category');
	return $category->deleteById($cid);
}


function infor_partition_searchByName($cname,$showNUm=50) {
	$category=D('Category');
	return $category->selectByName($cname,$showNUm);
}

function infor_partition_searchNum($cname){
	$category=D('Category');
	return $category->getTheSearchNum($cname);
}

function infor_partition_setPageList($p=1,$pageNum=5){
	$category=D('Category');
	$list=$category->order("cid")->page("$p,$pageNum")->select();
	return $list;
}

function infor_partition_setPage($nowPage=1,$pageNum=5,$rollPages=5){
// 	import("ORG.Util.Page");
	$count=infor_partition_num();
// 	$page=new Page($count,$pageNum);
// 	return $page->show();
    return showPage($count,$nowPage,$pageNum,$rollPages);
}

 function searchPage($count,$nowPage=1,$pageNum=1){
 	return showPage($count,$nowPage,$count,1);
 }
