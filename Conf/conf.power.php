<?php
	//权限应该对应到操作级别
	//栏目（column）、模块（module）、功能（action）、操作（operation）、记录（record）
	return array(
		//栏目标识 , 上级标记 , 栏目名称 , 是否显示 , href , target , 菜单排序
		
		//系统管理
		array('c020000','c000000','glb_cate_systemManage',true,"#",'',0),
		
		//管理员管理  
		array('c010000','c000000','glb_cate_adminManage',true,"#",'',0),
		//组织管理
		array('c010100','c010000','glb_cate_groupsManage',true,"?p=admingroup",'',0),
		//角色管理
		array('c010200','c010000','glb_cate_rolesManage',true,"?p=adminroles",'',0),
		//管理员管理
		array('c010300','c010000','glb_cate_auserManage',true,"?p=adminuser",'',0),
		
		//内容管理
		//array('c030000','c000000','glb_cate_contentManage',true,"#",'',0),
		
		// 商品管理
		array('c040000','c000000','glb_cate_productManage',true,"#",'',0),
		
		//会员管理
		array('c050000','c000000','glb_cate_memberManage',true,"#",'',0),
		
		//邮件管理
		//array('c060000','c000000','glb_cate_emailManage',true,"#",'',0),
		
		//广告管理
		//array('c070000','c000000','glb_cate_advertiseManage',true,"#",'',0),
		
	
	);
?>