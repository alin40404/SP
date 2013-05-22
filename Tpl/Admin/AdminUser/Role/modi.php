
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
	<title>泛亚企业网站生产平台</title>
	<link id="skin_css"
		href="http://localhost:8001/iacms/assets/admin/css/common_green.css"
		type="text/css" rel="stylesheet">
		<link
			href="http://localhost:8001/iacms/assets/admin/css/admin.index.css"
			type="text/css" rel="stylesheet">
			<link rel="stylesheet" type="text/css"
				href="http://localhost:8001/iacms/assets/css/ico.css" />
			<script src="http://localhost:8001/iacms/assets/js/jquery.js"
				type="text/javascript"></script>
			<script src="http://localhost:8001/iacms/assets/js/jquery.cookie.js"
				type="text/javascript"></script>
			<script
				src="http://localhost:8001/iacms/assets/effects/artDialog/jquery.artDialog.min.js?skin=grey"
				type="text/javascript"></script>
			<script type="text/javascript"
				src="http://localhost:8001/iacms/assets/effects/artDialog/plugins/iframeTools.js"></script>
			<script
				src="http://localhost:8001/iacms/assets/admin/js/admin.common.js"
				type="text/javascript"></script>
			<script type="text/javascript">
			(function (config) {
				config['background'] = '#000';
				config['opacity'] = 0.1;
				config['lock'] = true;
				config['fixed'] = true;
				config['okVal'] = '确定';
				config['cancelVal'] = '取消';
			})($.dialog.defaults);
		</script>

</head>
<body>
	<div style="height: 60px; overflow: hidden">
		<table width="100%" cellspacing="0" cellpadding="0" border="0"
			class="header">
			<tbody>
				<tr>
					<td width="5"></td>
					<td><a id="switch" class="button" onFocus="this.blur();"
						href="javascript:ia.switchbar();">关闭菜单</a> <a id="lang_button"
						class="button" onFocus="this.blur();" href="javascript:void(0);">简体中文</a>
						<span id="lang_menu" class="top_menu"> <a href="?l=en">English</a>
							<a href="?l=zh-cn">简体中文</a> <a href="?l=zh-cht">繁體中文</a>
					</span></td>
					<td id="skin_css" class="right"><a href="#" title="切换皮肤"
						class="blue_a" css="blue"></a> <a href="#" title="切换皮肤"
						class="gray_a" css="gray"></a> <a href="#" title="切换皮肤"
						class="red_a" css="red"></a> <a href="#" title="切换皮肤"
						class="green_b" css="green"></a></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="frame_side" style="left: 0px;">
		<div class="welcome" style="font-size: 12px;">
			您好： <a class="left_url" href="#">admin</a> &nbsp;&nbsp;&nbsp; <a
				class="left_url" href="index.php" target="_blank">前台主页</a> | <a
				class="left_url" href="?p=adminuser&d=loginout">退出登陆</a>
		</div>
		<div id="menu">
			<ol>
				<a style="padding-right: 10px;" href="javascript:void(0);"
					onfocus="this.blur();" class="item">系统管理</a>
				<ul style="display: none;">
					<li class=""><a href="?" onfocus="this.blur();">后台首页</a></li>
					<li class=""><a href="?p=adminhome&d=clearcache"
						onfocus="this.blur();">清除缓存</a></li>
					<li class=""><a href="?p=category" onfocus="this.blur();">类别管理</a></li>
				</ul>
			</ol>
			<ol>
				<a style="padding-right: 10px;" href="javascript:void(0);"
					onfocus="this.blur();" class="item">后台用户管理</a>
				<ul style="display: block;">
					<li class=""><a href="?p=admingroup" onfocus="this.blur();">用户组管理</a></li>
					<li class="current"><a href="?p=adminroles" onfocus="this.blur();">角色管理</a></li>
					<li class=""><a href="?p=adminuser" onfocus="this.blur();">管理员管理</a></li>
				</ul>
			</ol>
			<ol>
				<a style="padding-right: 10px;" href="javascript:void(0);"
					onfocus="this.blur();" class="item">商品管理</a>
				<ul style="display: none;">
					<li class=""><a href="?p=goods" onfocus="this.blur();">商品管理</a></li>
					<li class=""><a href="?p=area" onfocus="this.blur();">地区管理</a></li>
				</ul>
			</ol>
			<ol>
				<a style="padding-right: 10px;" href="javascript:void(0);"
					onfocus="this.blur();" class="item">会员管理</a>
				<ul style="display: none;">
					<li class=""><a href="?p=member&d=list" onfocus="this.blur();">会员列表</a></li>
				</ul>
			</ol>
		</div>
	</div>
	<div id="body_box" style="margin-left: 230px;">
		<link rel="stylesheet" type="text/css"
			href="http://localhost:8001/iacms/assets/effects/flexigrid/css/flexigrid.pack.css" />
		<script type="text/javascript"
			src="http://localhost:8001/iacms/assets/effects/flexigrid/js/flexigrid.min.js"></script>
		<div class="info_all rounded">
			<h1>
				<i class="icon-th-list btnico"></i><span>角色管理</span>&nbsp;&nbsp;&nbsp;&nbsp;<span
					class="rounded btn"><i class="icon-plus btnico"></i><span><a
						href="?p=adminroles&d=add">新增角色</a></span></span>
			</h1>
			<div class="info_search">
				<form action="" method="get">
					<table border="0" cellpadding="0" cellspacing="5">
						<tbody>
							<tr>
								<td><input class='input' name='keywords' id='keywords'
									placeholder='keywords' size='15' type='text' /><input
									type="hidden" value="" name="lang" id="lang" /><input
									type="hidden" value="1" name="search" id="search" /></td>
								<td><a class="button_2" href="#" id="search_button">搜索</a></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
			<div class="operate">
				<table border="0" cellpadding="0" cellspacing="5">
					<tbody>
						<td><span class="rounded btn" id="search_refresh"><i
								class="icon-refresh btnico"></i><span>刷新</span></span></td>
						<td><span class="rounded btn" id="sall_button"><i
								class="icon-retweet btnico"></i><span>全选</span></span></td>
						<td><span class="rounded btn" id="del_button"><i
								class="icon-remove btnico"></i><span>删除</span></span></td>
					</tbody>
				</table>
			</div>
			<div class="info_list">
				<table id="info_list" style="display: none"></table>
			</div>
		</div>
		<script type="text/javascript">function deleteOne(id){$.dialog.confirm("您确定要删除该数据吗？", function () {var id_str="Id="+id;$.ajax({type: "POST",url: "?p=adminroles&d=del",data: id_str,success: function(msg){if($.trim(msg)=="ok"){$.dialog.alert("数据删除成功！");$("#info_list").flexReload();}else{$.dialog.alert(msg);}}});}, function () {$.dialog.tips("执行取消操作！");});}$("#search_button").bind("click",function(){$("#info_list").flexSearch({searchitems : "search,keywords,lang"});return false;});$("#search_refresh").bind("click",function(){$("#info_list").flexReload();return false;});$("#sall_button").bind("click",function(){$("#info_list tbody tr").toggleClass("trSelected");return false;});$("#del_button").bind("click",function(){$.dialog.confirm("您确定要删除该数据吗？", function () {var id_str = "Id=0";$.each($("#info_list .trSelected"),function(){id_str+=","+$(this).attr("id");});$.ajax({type: "POST",url: "?p=adminroles&d=del",data: id_str,success: function(msg){if($.trim(msg)=="ok"){$.dialog.alert("数据删除成功！");$("#info_list").flexReload();}else{$.dialog.alert(msg);}}});}, function () {$.dialog.tips("执行取消操作！");});return false;});$("#info_list").flexigrid({"url":"?p=adminroles&d=listjson","dataType":"json","colModel":[{"name":"Id","display":"ID","width":40,"sortable":true,"align":"center"},{"name":"rName","display":"\u89d2\u8272\u540d","width":100,"sortable":true,"align":"center"},{"name":"gName","display":"\u6240\u5c5e\u7528\u6237\u7ec4","width":100,"sortable":true,"align":"center"},{"name":"orderNum","display":"\u6392\u5e8f\u6570\u5b57","width":60,"sortable":true,"align":"center"},{"name":"addTime","display":"\u6dfb\u52a0\u65f6\u95f4","width":150,"sortable":true,"align":"center"},{"name":"deal","display":"\u64cd\u4f5c","width":150,"sortable":false,"align":"center"}],"sortname":"orderNum","sortorder":"DESC","usepager":true,"useRp":true,"rp":10,"showTableToggleBtn":true,"width":"100%","height":"auto"});</script>
		<div class="footer">
			这不是一个免费软件，商业用途需要购买版权<br />Copyright © 2013 <a
				href="http://iait.com.cn/" target="_blank">iait.com.cn</a> 版权使用<br />
		</div>
	</div>
	<script type="text/javascript">
			var $lang_closeMenu = '关闭菜单';
			var $lang_openMenu = '打开菜单';
			
			$(function(){
				$('#skin_css a').click(function(){
					$skin = $(this).attr('css');
					$('#skin_css').attr('href','http://localhost:8001/iacms/assets/admin/css/common_'+$skin+'.css');
					$(this).attr('class',$skin+'_b').siblings().each(function(){
						$(this).attr('class',$(this).attr('css')+'_a');
					});
					
					$.cookie('skin_now',$skin,{ expires: 30 });
				});
			});
		</script>
	<script type="text/javascript">ia.menu()</script>
</body>
</html>