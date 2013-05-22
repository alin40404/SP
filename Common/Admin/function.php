<?php

/**
 * @函数名:powerCheckbox
 * @参数:$powerStr-默认权限
 * @作用:返回一个指定类别类型的<select>元素
 * @返回值:HTML代码
 */
function powerCheckbox($menu,$powerStr){
	$html = "";
	$amenu = $menu;
	$bmenu = $menu;
	$cmenu = $menu;
	if(is_array($menu)){
		foreach($amenu as $a){
			if(strlen(str_replace('0000','',$a[0]))==3){
				if(strrpos("|".$powerStr,$a[0]) > 0){
					$checked="checked=\"checked\"";
				} else {
					$checked = "";

				}
				$html .= "<div class='rolesA clearfix'>";
				$html .= "<h2><input type=\"checkbox\" name=\"power[]\" value=\"".$a[0]."\" ".$checked." /> ".$GLOBALS['LANG'][$a[2]]."</h2>";
				$html .= "<div class='rolesB'>";
				foreach($bmenu as $b){
					if($a[0]==$b[1]){
						if(strrpos("|".$powerStr,$b[0]) > 0){
							$checked="checked=\"checked\"";
						} else {
							$checked = "";
						}
						$html .= "<strong><input type=\"checkbox\" name=\"power[]\" value=\"".$b[0]."\" ".$checked." /> ".$GLOBALS['LANG'][$b[2]]."：</strong>";
						$html .= "<div class='rolesC'>";
						foreach($cmenu as $c){
							if($b[0]==$c[1]){
								if(strrpos("|".$powerStr,$c[0]) > 0){
									$checked="checked=\"checked\"";
								} else {
									$checked = "";
								}
								if(strrpos("|".$c[2],'权限:') > 0){
									$label = "<label style=\"color:#009900;\">";
									//$checkedStr = $c[2];
								} else {
									$label = "<label>";
								}
								$html .= $label."<input type=\"checkbox\" name=\"power[]\" value=\"".$c[0]."\" ".$checked." /> ".$GLOBALS['LANG'][$c[2]]."</label>&nbsp;&nbsp;&nbsp;";
							}
						}
						$html .= "</div>";
					}
				}
				$html .= "</div>";
				$html .= "</div>";
			}
		}
	}

	return $html;
}

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
