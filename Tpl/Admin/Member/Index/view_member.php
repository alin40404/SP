<style type="text/css">
	.formTable {
		font-size:12px;
		width:400px;
		line-height:200%;
	}
	.formTable td {
		border-bottom:#CCC 1px dotted;
	}
	.formTable .eleName {
		width:80px;
		padding-right:10px;
		text-align:right;
		font-weight:bold;
	}
	.formTable .eleCont {
		width:280px;
	}
</style>
<table width="100%" align="center" class="formTable" cellspacing="0" cellpadding="0" border="0">
	<tbody>
		<tr>
			<td class="eleName">电子邮箱:</td>
			<td class="eleCont">
			<?php echo $query['email']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">真实姓名:</td>
			<td class="eleCont">
				<?php echo $query['realname']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">性别:</td>
			<td class="eleCont">
				<?php echo $query['sex']==2?'女士':'先生'; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">生日:</td>
			<td class="eleCont">
				<?php echo $query['birthday']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">详细地址:</td>
			<td class="eleCont">
				<?php echo $query['fullAddress']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">邮编:</td>
			<td class="eleCont">
				<?php echo $query['postcode']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">移动电话:</td>
			<td class="eleCont">
				<?php echo $query['mobile']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">固定电话:</td>
			<td class="eleCont">
				<?php echo $query['phone']; ?>
			</td>
		</tr>
		<tr>
			<td class="eleName">个人简介:</td>
			<td class="eleCont">
				<?php echo $query['introduce']; ?>
			</td>
		</tr>
	</tbody>
</table>