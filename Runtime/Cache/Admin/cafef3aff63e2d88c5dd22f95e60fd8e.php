<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
<title><?php echo ($title); ?></title>
<link id="skin_css" href="__PUBLIC__/css/Admin/common_green.css" type="text/css" rel="stylesheet">
<link href="__PUBLIC__/css/Admin/admin.index.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/css/Admin/ico.css" />
<script type="text/javascript" src="__PUBLIC__/js/jquery.min.js"></script>
<script src="__PUBLIC__/js/jquery.cookie.js" type="text/javascript"></script>
<script src="__PUBLIC__/effects/artDialog/jquery.artDialog.min.js?skin=grey" type="text/javascript"></script>
<script type="text/javascript" src="__PUBLIC__/effects/artDialog/plugins/iframeTools.js"></script>
<script src="__PUBLIC__/js/Admin/admin.common.js" type="text/javascript"></script>

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
	
	<div id="body_box" style="margin-left: 0px;">
		<table class="box_top" border="0" cellpadding="0" cellspacing="0"
			width="100%">
			<tbody>
				<tr>
					<td class="title">欢迎进入菜篮子价格查询系统后台</td>
					</tr>
			</tbody>
		</table>
		<table border="0" cellpadding="0" cellspacing="0" class="table center">
			<tbody>
				<tr>
					<td valign="top">
						<table class="rounded" border="0" style="margin-bottom: 10px;"
							cellpadding="0" cellspacing="1" width="100%">
							<tbody>
								<tr>
								</tr>
								<tr>
									<td class="center_top">基本信息</td>
								</tr>
								<tr>
									<td class="welcome">
										<table class="server" border="0" cellpadding="0"
											cellspacing="0" width="100%">
											<tbody>
												<tr class="even">
													<td>您好：：admin，
													<a href="index.php?g=Admin&m=AdminUser&a=adminUserManage&d=update&Id=<?php echo $admin['Id']; ?>">修改个人资料</a></td>
												</tr>
												<tr class="odd">
													<td>真实姓名：<?php echo $admin['realName']; ?></td>
												</tr>
												<tr class="even">
													<td>所属角色 ：<?php echo $admin['rName']; ?>&nbsp;&nbsp;&nbsp;角色名：<?php echo $admin['rName']; ?>
														&nbsp;&nbsp;&nbsp; 登陆次数：<span class="red"><?php echo $admin['loginTimes']; ?></span>
													</td>
												</tr>
												<tr class="odd">
													<td>最后登陆时间：<?php echo $admin['lastLoginTime']; ?></td>
												</tr>
												<tr class="even">
													<td>最近登录IP：<?php echo $admin['lastLoginIP']; ?></td>
												</tr>
											</tbody>
										</table>
									</td>
								</tr>
							</tbody>
						</table>
						<table class="rounded" border="0" cellpadding="0" cellspacing="1"
							width="100%">
							<tbody>
								<tr>
									<td class="center_top">服务器信息</td>
								</tr>
								<tr>
									<td class="welcome"><table class="server" border="0"
											cellpadding="0" cellspacing="0" width="100%">
											<tbody>
												<tr class="odd"></tr>
												<tr class="even">
													<td>服务器信息：<?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
												</tr>
												<tr class="odd">
													<td>MySQL支持情况：5.5.29</td>
												</tr>
												<tr class="even">
													<td>GD库支持情况：<?php
 $gd_info = gd_info(); echo $gd_info['GD Version']; ?>
													</td>
												</tr>
												<tr class="odd">
													<td>单文件上传限制：<?php echo ini_get("upload_max_filesize"); ?></td>
												</tr>
												<tr class="even">
													<td>POST 提交限制：<?php echo ini_get("post_max_size"); ?></td>
												</tr>
												<tr class="odd">
													<td>被禁用的函数：<?php echo ini_get("disable_functions") ? ini_get("disable_functions") : '无'; ?></td>
												</tr>
											</tbody>
										</table></td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="10"></td>
					<td valign="top" width="280">
						<table class="news rounded" border="0" cellpadding="0"
							cellspacing="0" style="margin-bottom: 10px;">
							<tbody>
								<tr>
									<td class="news_top" colspan="2">统计信息</td>
								</tr>
								<tr>
									<td class="row"><table border="0" cellpadding="0"
											cellspacing="0">
											<tbody>
												<tr>
													<td>注册会员：<a href="index.php?p=member"><?php echo $memberSum; ?></a></td>
													<td></td>
													<td width="60px"></td>
													<td></td>
													<td class="red"></td>
												</tr>
												<tr>
													<td></td>
													<td class="red"></td>
													<td></td>
													<td></td>
													<td class="red"></td>
												</tr>

												<tr>
												</tr>
											</tbody>
										</table></td>
								</tr>
							</tbody>
						</table>
						<table class="news rounded" border="0" cellpadding="0"
							cellspacing="0">
							<tbody>
								<tr>
									<td class="news_top">后台公告</td>
								</tr>
								<tr>
									<td id="client_news" class="row"></td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>
		
	</div>
	
</body>
</html>