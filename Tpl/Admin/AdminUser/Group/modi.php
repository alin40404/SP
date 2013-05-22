
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title><{$title}></title>
<link id="skin_css" href="<?php echo $public_url; ?>/css/Admin/common_green.css" type="text/css" rel="stylesheet">
<link href="<?php echo $public_url; ?>/css/Admin/admin.index.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo $public_url; ?>/css/Admin/ico.css" />
<script type="text/javascript" src="<?php echo $public_url; ?>/js/jquery.min.js"></script>
<script src="<?php echo $public_url; ?>/js/jquery.cookie.js" type="text/javascript"></script>
<script src="<?php echo $public_url; ?>/effects/artDialog/jquery.artDialog.min.js?skin=grey" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $public_url; ?>/effects/artDialog/plugins/iframeTools.js"></script>

<script src="<?php echo $public_url; ?>/js/Admin/admin.common.js" type="text/javascript"></script>
<script type="text/javascript">
	(function(config) {
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
<div id="body_box" style="margin-left:0px;">
	<style type="text/css">
/*用户角色权限补充CSS*/
.rolesA {
	width: 100%;
}

.rolesA,.rolesB {
	display: block;
	clear: both;
	margin: 5px;
}

.rolesA {
	background-color: #CCC;
	line-height: 200%;
	color: #666;
}

.rolesA h2 {
	display: block;
	clear: both;
	padding: 5px;
	padding-left: 0px;
	background-color: #CCC;
	color: #333;
}

.rolesA input {
	vertical-align: middle;
}

.rolesB {
	margin-left: 0px;
}

.rolesB strong {
	display: block;
	clear: both;
	float: left;
	width: 150px;
}

.rolesC {
	float: left;
	width: 100%;
	border-bottom: #CCC 1px dotted;
}

.rolesC label {
	width: 160px;
}
</style>
	<script language="javascript">
		$(function() {
			$(".rolesA > h2 > input").click(
					function() {
						if ($(this).attr("checked") == "checked") {
							$(this).parents(".rolesA").children(".rolesB")
									.find(":checkbox").attr("checked", true);
						} else {
							$(this).parents(".rolesA").children(".rolesB")
									.find(":checkbox").attr("checked", false);
						}
					});

			$(".rolesB > strong > input").click(
					function() {
						if ($(this).attr("checked") == "checked") {
							$(this).parent("strong").next(".rolesC").find(
									":checkbox").attr("checked", true);
						} else {
							$(this).parent("strong").next(".rolesC").find(
									":checkbox").attr("checked", false);
						}
					});
		});
	</script>
	<div class="info_all rounded">
		<h1>
		<i class="icon-edit btnico"></i><span>修改用户组</span>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<span class="rounded btn">
			<i class="icon-plus btnico"></i><span>
			<a href="?g=Admin&m=AdminUser&a=group&d=add">新增用户组</a></span>
			</span>
			&nbsp;&nbsp;&nbsp;&nbsp; <span class="rounded btn"> <i
				class="icon-th-list btnico"></i><span><a
					href="?g=Admin&m=AdminUser&a=group&d=list">用户组管理</a></span>
			</span>
		</h1>
		<link rel="stylesheet"
			href="<?php echo $public_url; ?>/effects/validform/css/validform.css"
			type="text/css" media="all" />
			<?php 
echo powerCheckbox($powerShow,$$powerShow);
 ?>
		<form action="index.php?g=Admin&m=AdminUser&a=group&d=modideal" method="post"
			class="formTable">
			<table width="100%" align="center" border="0" cellpadding="0"
				cellspacing="0">
				<tr>
					<td class="eleName"><span class="need">*</span> 组名称:</td>
					<td class="eleCont"><input type="text" name="gName" value="<?php  echo $gName; ?>"
						class="input_text" datatype="*" nullmsg="请填写" errormsg="填写有误" /></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 排序数组:</td>
					<td class="eleCont"><input type="text" name="orderNum"
						value="0" class="input_text" datatype="*" nullmsg="请填写"
						errormsg="填写有误" /></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 备注:</td>
					<td class="eleCont"><textarea type="textaera" name="bak"
							style="width: 400px; height: 80px;" nullmsg="请填写" errormsg="填写有误" /></textarea></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr>
					<td class="eleName"><span class="need">*</span> 权限:</td>
					<td class="eleCont"><div class='rolesA clearfix'>
							<h2>
								<input type="checkbox" name="power[]" value="c020000" /> 系统管理
							</h2>
							<div class='rolesB'>
								<strong><input type="checkbox" name="power[]"
									value="c020100" /> 后台首页：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c020101" /> 基本信息</label>
								</div>

								<div class='rolesC'></div>
								
							</div>
						</div>
						<div class='rolesA clearfix'>
							<h2>
								<input type="checkbox" name="power[]" value="c010000" />
								后台用户管理
							</h2>
							<div class='rolesB'>
								<strong><input type="checkbox" name="power[]"
									value="c010100" checked /> 用户组管理：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c010101" /> 新增用户组</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010102" /> 修改用户组</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010103" /> 用户组管理</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010104" /> 删除用户组</label>&nbsp;&nbsp;&nbsp;
								</div>
								<strong><input type="checkbox" name="power[]"
									value="c010200" /> 角色管理：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c010201" /> 新增角色</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010202" /> 修改角色</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010203" /> 角色管理</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010204" /> 删除角色</label>&nbsp;&nbsp;&nbsp;
								</div>
								<strong><input type="checkbox" name="power[]"
									value="c010300" /> 管理员管理：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c010301" /> 新增用户</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010302" /> 修改用户</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010303" /> 用户管理</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c010304" /> 删除用户</label>&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</div>
						<div class='rolesA clearfix'>
							<h2>
								<input type="checkbox" name="power[]" value="c040000" /> 商品管理
							</h2>
							<div class='rolesB'>
								<strong><input type="checkbox" name="power[]"
									value="c040900" /> 商品管理：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c040901" /> 新增商品</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040902" /> 修改商品</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040903" /> 删除商品</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040904" /> 商品列表</label>&nbsp;&nbsp;&nbsp;
								</div>
								<strong><input type="checkbox" name="power[]"
									value="c040400" /> 地区管理：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c040401" /> 新增地区</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040402" /> 修改地区</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040403" /> 删除地区</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c040404" /> 地区列表</label>&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</div>
						<div class='rolesA clearfix'>
							<h2>
								<input type="checkbox" name="power[]" value="c050000" /> 会员管理
							</h2>
							<div class='rolesB'>
								<strong><input type="checkbox" name="power[]"
									value="c050200" /> 会员列表：</strong>
								<div class='rolesC'>
									<label><input type="checkbox" name="power[]"
										value="c050201" /> 重置密码</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c050202" /> 删除会员</label>&nbsp;&nbsp;&nbsp;<label><input
										type="checkbox" name="power[]" value="c050203" /> 冻结账号</label>&nbsp;&nbsp;&nbsp;
								</div>
							</div>
						</div></td>
					<td class="eleTip"><div class="Validform_checktip">请填写</div></td>
				</tr>
				<tr class="button">
					<td colspan="3" class="center"><input type="submit"
						value="提 交" />&nbsp;&nbsp;&nbsp;<input type="reset" value="重 置" /></td>
				</tr>
			</table>
		</form>
		<script type="text/javascript"
			src="<?php echo $public_url; ?>/effects/validform/validform.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$(".formTable").Validform({
					tiptype : 2,
					tipmsg : {
						tit : "提示信息",
						w : "请输入正确信息！",
						r : "通过信息验证！",
						c : "正在检测信息…",
						s : "请填入信息！",
						v : "所填信息没有经过验证，请稍后…",
						p : "正在提交数据…",
						err : "出错了！提交地址或返回数据格式是错误！",
						abort : "Ajax操作被取消！"
					},
				});
			});
		</script>
	</div>
</body>
</html>
