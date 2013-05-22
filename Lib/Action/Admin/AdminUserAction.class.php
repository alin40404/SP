<?php
class AdminUserAction extends AdminCommonAction {
	
	/**
	 * ---后台用户管理------
	 */
	public function group() {
		$d=getvar('d');
		$originDB=new OriginModel();
		
		if($d==''||$d=='list'){
			define('NOWPOWER','c010103');
			isHavePower(NOWPOWER);
			
			$file="list.html";
		}else if($d=='listjson'){
			$page = isset($_POST['page']) ? $_POST['page'] : 1;
			$rp = isset($_POST['rp']) ? $_POST['rp'] :  $this->pageNum;
			$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'name';
			$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
			$search = isset($_POST['search']) ? $_POST['search'] : '';
			$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
			
			$table = C('DB_PREFIX').'group';
			$sql = 'SELECT Id,gName,orderNum,addTime FROM '.$table.' WHERE 1=1';
			if($search && $keywords!='关键字'){
				$sql .= " AND gName LIKE '%".$keywords."%' OR bak LIKE '%".$keywords."%'";
			}
			$sql .= " ORDER BY ".$sortname." ".$sortorder;
			
			$offset = $page-1;
			
			

			$total = $originDB->getRowsNum($sql);//计算记录集总记录数
			$query = $originDB->selectLimit($sql , $rp , $offset);
			
			header("Content-type: application/json");
			$jsonData = array('page'=>$page,'total'=>$total,'rows'=>array());
			foreach($query AS $row){
				$entry = array('id'=>$row['Id'],
						'cell'=>array(
								'Id'=>$row['Id'],
								'gName'=>$row['gName'],
								'orderNum'=>$row['orderNum'],
								'addTime'=>date('Y-m-d',$row['addTime']),
								'deal'=>'<a href="javascript:void(0);" onclick="deleteOne('.$row['Id'].')">删除</a> <a href="?g=Admin&m=AdminUser&a=group&d=modi&Id='.$row['Id'].'">修改</a>'
						),
				);
				$jsonData['rows'][] = $entry;
			}
			exit(json_encode($jsonData));
		}else if($d=='add'){
			define('NOWPOWER','c010101');
			isHavePower(NOWPOWER);
			$this->assign('d',$d);
			$file="add.html";
		}else if($d=='adddeal'){
			define('NOWPOWER','c010101');
			isHavePower(NOWPOWER);
			
			$table = C('DB_PREFIX').'group';
			$array=$_POST;
			$array['addTime']=time();
			$query = $originDB->insert($table,$array);
			if($query){
				$descibe = '用户组新增成功\n';
				$descibe .= '组名称：'.getvar('gName');
				
			
				$html_str = dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=group&d=list";','succeed');
				exit($html_str);
			}else{
				$descibe = '用户组新增失败\n';
				$descibe .= '组名称：'.getvar('gName');
			
				
				$html_str = dialog_toURL($descibe,'window.history.back();','error');
				exit($html_str);
			}
		}else if($d=='modi'){
			define('NOWPOWER','c010102');
			isHavePower(NOWPOWER);
				$Id = getvar('Id');
				if(empty($Id)){
					
					exit(dialog_toURL("请选择要修改的记录",'window.history.back();','error'));
				}else{
					$table =  C('DB_PREFIX').'group';
					$sql = 'SELECT * FROM '.$table.' WHERE Id='.$Id;
					$query = $originDB->getOneRow($sql);
					if(empty($query['Id'])){
						
						exit(dialog_toURL("该条记录不存在",'window.history.back();','error'));
					}
				}
				
				$gName = $query['gName'];
				$orderNum = $query['orderNum'];
				$bak = $query['bak'];
				$powerShow =explode(',', $query['power']);
				$power=array();
				foreach($powerShow as $key){
					$power[$key]="checked";
				}

				$file="add.html";
				$this->assign('d',$d);
				$this->assign('Id',$Id);
				$this->assign('gName',$gName);
				$this->assign('orderNum',$orderNum); 
				$this->assign('bak',$bak);
				$this->assign('power',$power);

				
			}elseif($d=='modideal'){
				define('NOWPOWER','c010102');
				isHavePower(NOWPOWER);
				//print_r($array);
				$Id = getvar('Id');
				$table =  C('DB_PREFIX').'group';
				unset($_POST['Id']);
				$array=$_POST;
				$where = "Id='$Id'";
				$query = $originDB->update($table,$array,$where);
				
				if($query){
					$descibe = '修改用户组成功\n';
					$descibe .= '用户组Id：'.$Id;
		
					exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=group&d=list";','succeed'));

					
				}else{
					$descibe = '修改用户组失败\n';
					$descibe .= '用户组Id：'.$Id;
					
					exit(dialog_toURL($descibe,'window.history.back();','error'));
				}				
			}elseif($d=='del'){
				define('NOWPOWER','c010104');
				isHavePower(NOWPOWER);
				$Id_str = getvar('Id');
				$Id_str = str_replace('row',' ',$Id_str);
				if(empty($Id_str)){
					exit("记录不存在");
				}
				
				$table_role =  C('DB_PREFIX').'role';
				$sql_role = 'SELECT Id FROM '.$table_role.' WHERE gId IN ('.$Id_str.')';
				$query_role = $originDB->getRowsNum($sql_role);
				if($query_role>0){
					exit("用户组存在用户");
				}
				
				$table =  C('DB_PREFIX').'group';
				$where = "Id IN(".$Id_str.")";
				$query =$originDB->delete($table,$where);
				
				if($query){
					$descibe = '删除用户组成功\n';
					$descibe .= '用户组Id：'.$Id_str;
					
					exit('ok');
				}else{
					$descibe = '删除用户组失败\n';
					$descibe .= '用户组Id：'.$Id_str;
					
					exit("删除失败");
				}
			}else {
				$descibe="请求不正确！";
				exit(dialog_toURL($descibe,'window.history.back();','error'));
				
			}
		
		
		$this->assign('file',$file);
		$currentLocal = '用户组管理';
		$this->assign ( 'currentLocal', $currentLocal );
		$this->display ();
	}

	/**
	 * ---后台用户管理------
	 */
	public function role() {
		$d=getvar('d');
		$originDB=new OriginModel();
		
		if($d=='' || $d=='list'){
			
			define('NOWPOWER','c010203');
			isHavePower(NOWPOWER);
			$file="list.html";
		}else if($d=='listjson'){
			$page = isset($_POST['page']) ? $_POST['page'] : 1;
			$rp = isset($_POST['rp']) ? $_POST['rp'] :  $this->pageNum;
			$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'name';
			$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
			$search = isset($_POST['search']) ? $_POST['search'] : '';
			$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
			if($sortname=='gName'){
				$sortname = 'g.gName';
			}else{
				$sortname = 'r.'.$sortname;
			}
			
			$table_group =  C('DB_PREFIX').'group';
			$table_role =  C('DB_PREFIX').'role';
			$sql = 'SELECT r.Id,g.gName,r.rName,r.orderNum,r.addTime FROM '.$table_role.' AS r LEFT JOIN '.$table_group.' AS g ON r.gId=g.Id WHERE 1=1';
			if($search && $keywords!='关键字'){
				$sql .= " AND r.rName LIKE '%".$keywords."%' OR r.bak LIKE '%".$keywords."%'";
			}
			$sql .= " ORDER BY ".$sortname." ".$sortorder;
			
			$offset = $page-1;
			$total = $originDB->getRowsNum($sql);//计算记录集总记录数
			$query = $originDB->selectLimit($sql , $rp , $offset);
			header("Content-type: application/json");
			$jsonData = array('page'=>$page,'total'=>$total,'rows'=>array());
			foreach($query as $row){
				$entry = array('id'=>$row['Id'],
						'cell'=>array(
								'Id'=>$row['Id'],
								'gName'=>$row['gName'],
								'rName'=>$row['rName'],
								'orderNum'=>$row['orderNum'],
								'addTime'=>date('Y-m-d',$row['addTime']),
								'deal'=>'<a href="javascript:void(0);" onclick="deleteOne('.$row['Id'].')">删除</a> <a href="?g=Admin&m=AdminUser&a=role&d=modi&Id='.$row['Id'].'">修改</a>'
														),
				);
				$jsonData['rows'][] = $entry;
			}
			exit(json_encode($jsonData));
		}else if($d=='getpower'){
			$Id = getvar('Id');
			$table_group =  C('DB_PREFIX').'group';
			$sql = 'SELECT power FROM '.$table_group.' WHERE Id='.$Id;
			$query = $originDB->getOneRow($sql);
			
			exit($query['power']);
		}else if($d=='add'){
			define('NOWPOWER','c010201');
			isHavePower(NOWPOWER);
			
			$table_group =  C('DB_PREFIX').'group';
			$sql = 'SELECT Id,fatherId,gName FROM '.$table_group.' ORDER BY orderNum DESC';
			$query = $originDB->getList($sql);
			$this->assign('group',$query);
			$this->assign('d',$d);
			$orderNum=0;
			$this->assign('orderNum',$orderNum);
			$file="add.html";
		}else if($d=='adddeal'){
			define('NOWPOWER','c010201');
			isHavePower(NOWPOWER);
			
			$table = C('DB_PREFIX').'role';
			$array=$_POST;
			$adminId=$_SESSION['adminId'];
			$array['addTime']=time();
			$array['addUserId']=$adminId;
			
			$query = $originDB->insert($table,$array);
			
			
			
			if($query){
				$descibe = '角色新增成功\n';
				$descibe .= '角色名称：'.getvar('rName');
			
				exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=role&d=list";','succeed'));
			}else{
				$descibe = '角色新增失败\n';
				$descibe .= '角色名称：'.getvar('rName');
					
				exit(dialog_toURL($descibe,'window.history.back();','error'));
			}
			
		}else if($d=='modi'){
			define('NOWPOWER','c010202');
			isHavePower(NOWPOWER);
			
				$Id = getvar('Id');
				if(empty($Id)){
					
					exit(dialog_toURL("请选择要修改的记录",'window.history.back();','error'));
				}else{
					$table = C('DB_PREFIX').'role';
					$sql = 'SELECT * FROM '.$table.' WHERE Id='.$Id;
					$query = $originDB->getOneRow($sql);
					if(empty($query['Id'])){
						
						exit(dialog_toURL("该条记录不存在",'window.history.back();','error'));
					}
				}
				$gId=$query['gId'];
				$rName = $query['rName'];
				$orderNum = $query['orderNum'];
				$bak = $query['bak'];
				$powerShow =explode(',', $query['power']);
				$power=array();
				foreach($powerShow as $key){
					$power[$key]="checked";
				}
				
				$table_group =  C('DB_PREFIX').'group';
				$sql_group = 'SELECT Id,fatherId,gName FROM '.$table_group.' ORDER BY orderNum DESC';
				$query_group = $originDB->getList($sql_group);
				
				$file="add.html";
				$this->assign('d',$d);
				$this->assign('Id',$Id);
				$this->assign('gId',$gId);
				$this->assign('rName',$rName);
				$this->assign('orderNum',$orderNum); 
				$this->assign('bak',$bak);
				$this->assign('power',$power);
				$this->assign('group',$query_group);
				
			}elseif($d=='modideal'){
				define('NOWPOWER','c010202');
				isHavePower(NOWPOWER);
				
				//print_r($array);
				$Id = getvar('Id');
				$table =  C('DB_PREFIX').'role';
				unset($_POST['Id']);
				$array=$_POST;
				$where = "Id='$Id'";
				$query = $originDB->update($table,$array,$where);
				
				if($query){
					
					$descibe = '修改角色成功\n';
					$descibe .= '角色Id：'.$Id;
		
					exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=role&d=list";','succeed'));

					
				}else{
					$descibe = '修改角色失败\n';
					$descibe .= '角色Id：'.$Id;
					
					exit(dialog_toURL($descibe,'window.history.back();','error'));
				}				
			}elseif($d=='del'){
				define('NOWPOWER','c010204');
				isHavePower(NOWPOWER);
				
				$Id_str = getvar('Id');
				$Id_str = str_replace('row',' ',$Id_str);
				if(empty($Id_str)){
					exit("记录不存在");
				}
				
				$table_admin =  C('DB_PREFIX').'admin';
				$sql_admin = 'SELECT Id FROM '.$table_admin.' WHERE gId IN ('.$Id_str.')';
				$query_admin = $originDB->getRowsNum($sql_admin);
				if($query_admin>0){
					exit("该角色存在用户");
				}
				
				$table =  C('DB_PREFIX').'role';
				$where = "Id IN(".$Id_str.")";
				$query =$originDB->delete($table,$where);
				
				if($query){
					$descibe = '删除角色成功\n';
					$descibe .= '角色Id：'.$Id_str;
					
					exit('ok');
				}else{
					$descibe = '删除角色失败\n';
					$descibe .= '角色Id：'.$Id_str;
					
					exit($descibe);
				}
			}else {
				$descibe="请求不正确！";
				exit(dialog_toURL($descibe,'window.history.back();','error'));
				
			}
		
		$this->assign('file',$file);
		$currentLocal = '角色管理';
		$this->assign ( 'currentLocal', $currentLocal );
		$this->display ();
	}
	/**
	 * ---后台用户管理------
	 */

	public function adminUserManage() {
		$d=getvar('d');
		$originDB=new OriginModel();
		
		if($d=='' || $d=='list'){
			
			define('NOWPOWER','c010303');
			isHavePower(NOWPOWER);
			
			$file="list.html";
		}else if($d=='listjson'){
			
			$page = isset($_POST['page']) ? $_POST['page'] : 1;
			$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
			$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'name';
			if($sortname=='gName'){
				$sortname = 'g.gName';
			}elseif($sortname=='rName'){
				$sortname = 'r.rName';
			}else{
				$sortname = 'a.'.$sortname;
			}
			$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
			$search = isset($_POST['search']) ? $_POST['search'] : '';
			$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
			
			
			$table_group =  C('DB_PREFIX').'group';
			$table_role =  C('DB_PREFIX').'role';
			$table_admin =  C('DB_PREFIX').'admin';
			$sql = 'SELECT a.Id,a.adminName,a.realName,a.phone,a.email,g.gName,r.rName FROM '.$table_admin.' AS a LEFT JOIN '.$table_role.' AS r ON a.rId=r.Id LEFT JOIN '.$table_group.' AS g  ON r.gId = g.Id WHERE 1=1';
			if($search && $keywords!='关键字'){
				$sql .= " AND a.adminName LIKE '%".$keywords."%' OR a.realName LIKE '%".$keywords."%' OR a.phone LIKE '%".$keywords."%' OR a.email LIKE '%".$keywords."%'";
			}
			$sql .= " ORDER BY ".$sortname." ".$sortorder;
			
			//exit($sql);
			
			$offset = $page-1;			
			$total = $originDB->getRowsNum($sql);//计算记录集总记录数
			$query = $originDB->selectLimit($sql , $rp , $offset);
			
			header("Content-type: application/json");
			$jsonData = array('page'=>$page,'total'=>$total,'rows'=>array());
			foreach($query AS $row){
				$entry = array('id'=>$row['Id'],
					'cell'=>array(
						'Id'=>$row['Id'],
						'gName'=>$row['gName'],
						'rName'=>$row['rName'],
						'adminName'=>$row['adminName'],
						'realName'=>$row['realName'],
						'phone'=>$row['phone'],
						'email'=>$row['email'],
						'deal'=>'<a href="javascript:void(0);" onclick="deleteOne('.$row['Id'].')">删除</a> <a href="index.php?g=Admin&m=AdminUser&a=adminUserManage&d=modi&Id='.$row['Id'].'">修改</a>'
					),
				);
				$jsonData['rows'][] = $entry;
			}
			exit(json_encode($jsonData));
		}elseif($d=='getrole'){
				$Id = getvar('Id');
				$table_role =  C('DB_PREFIX').'role ';
				$sql = 'SELECT Id,rName FROM '.$table_role.' WHERE gId='.$Id.' ORDER BY orderNum DESC';
				$query = $originDB->getList($sql);
				
				exit(json_encode($query));
			}elseif($d=='getpower'){
				$Id = getvar('Id');
				$table_group =  C('DB_PREFIX').'role';
				$sql = 'SELECT power FROM '.$table_group.' WHERE Id='.$Id;
				$query = $originDB->getOneRow($sql);
				
				exit($query['power']);
		}else if($d=='add'){

			define('NOWPOWER','c010301');
			isHavePower(NOWPOWER);
			
			$table_group =  C('DB_PREFIX').'group';
			$sql = 'SELECT Id,fatherId,gName FROM '.$table_group.' ORDER BY orderNum DESC';
			$query = $originDB->getList($sql);

			$this->assign('group',$query);
			$this->assign('d',$d);
			$orderNum=0;
			$this->assign('orderNum',$orderNum);
			$file="add.html";
		}
		else if($d=='adddeal'){

			define('NOWPOWER','c010301');
			isHavePower(NOWPOWER);
			
			$table = C('DB_PREFIX').'admin';
			$array=$_POST;
			$adminId=$_SESSION['adminId'];
			$array['addTime']=time();
			$array['addUserId']=$adminId;
			dump($array);exit;
			$array['adminPwd']=md5($array['adminPwd']);
			//$ip=$_SERVER['REMOTE_ADDR'];
			
			$query = $originDB->insert($table,$array);
				
				
				
			if($query){
				$descibe = '用户新增成功\n';
				$descibe .= '用户名称：'.getvar('rName');
					
				exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=adminUserManage&d=list";','succeed'));
			}else{
				$descibe = '用户新增失败\n';
				$descibe .= '用户名称：'.getvar('rName');
					
				exit(dialog_toURL($descibe,'window.history.back();','error'));
			}
				
		}else if($d=='modi'){

			define('NOWPOWER','c010302');
			isHavePower(NOWPOWER);
			
			$Id = getvar('Id');
			if(empty($Id)){
					
				exit(dialog_toURL("请选择要修改的记录",'window.history.back();','error'));
			}else{
				$table = C('DB_PREFIX').'admin';
				$sql = 'SELECT * FROM '.$table.' WHERE Id='.$Id;
				$query = $originDB->getOneRow($sql);
				if(empty($query['Id'])){
		
					exit(dialog_toURL("该条记录不存在",'window.history.back();','error'));
				}
			}
			
// 			dump($query);exit;
			
			$gId=$query['gId'];
			$rId=$query['rId'];
			$adminName = $query["adminName"];
			$adminPwd="noinput";
			$realName=$query["realName"];
			$sex=$query["sex"];
			$phone= $query["phone"];
			$email=$query["email"];
			$bak = $query['bak'];
			$powerShow =explode(',', $query['power']);
			$power=array();
			foreach($powerShow as $key){
				$power[$key]="checked";
			}
		
			$table_group =  C('DB_PREFIX').'group';
			$sql_group = 'SELECT Id,fatherId,gName FROM '.$table_group.' ORDER BY orderNum DESC';
			$query_group = $originDB->getList($sql_group);
		
			
			$table_role =  C('DB_PREFIX').'role';
			$sql_role = 'SELECT Id,fatherId,rName FROM '.$table_role.' WHERE gId='.$query['gId'].' ORDER BY orderNum DESC';
			$query_role = $originDB->getList($sql_role);

			
			$file="add.html";
			$this->assign('d',$d);
			$this->assign('Id',$Id);
			$this->assign('gId',$gId);
			$this->assign('rId',$rId);
			$this->assign('adminName',$adminName);
			$this->assign('adminPwd',$adminPwd);
			$this->assign('sex',$sex);
			$this->assign('realName',$realName);
			$this->assign('phone',$phone);
			$this->assign('email',$email);
			$this->assign('bak',$bak);
			$this->assign('power',$power);
			$this->assign('group',$query_group);
			$this->assign('role',$query_role);
		
		}elseif($d=='modideal'){
			define('NOWPOWER','c010302');
			isHavePower(NOWPOWER);
			
			//print_r($array);
			$Id = getvar('Id');
			unset($_POST['Id']);
			unset($_POST['adminPwd_re']);
			$array=$_POST;
// 			dump($array);exit;
			$adminPwd=$array['adminPwd'];
			if($adminPwd=="noinput"){
				unset($array['adminPwd']);
			}else{
				$array['adminPwd']=md5($adminPwd);
			}
			$table =  C('DB_PREFIX').'admin';
			$where = " Id='$Id'";
			$query = $originDB->update($table,$array,$where);
		
			if($query){
				
				clearPowerCache();
				$power=getPower();
				setPowerCacheFile($power);
				
				$descibe = '修改Id：'.$Id.'，修改管理员成功！';
		
				exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=AdminUser&a=adminUserManage&d=list";','succeed'));
		

			}else{
				$descibe = '修改Id：'.$Id.'，修改管理员失败！';
				exit(dialog_toURL($descibe,'window.history.back();','error'));
			}
		}elseif($d=='del'){
			define('NOWPOWER','c010304');
			isHavePower(NOWPOWER);
			
			$Id_str = getvar('Id');
			$Id_str = str_replace('row',' ',$Id_str);
			if(empty($Id_str)){
				exit("记录不存在");
			}
		

		
			$table =  C('DB_PREFIX').'admin';
			$where = "Id IN(".$Id_str.")";
			$query =$originDB->delete($table,$where);
		
			if($query){
					$descibe = '被删除管理员Id：'.$Id_str.'\n';
					$descibe .= '删除管理员成功！';
					
				exit('ok');
			}else{
					$descibe = '被删除管理员Id：'.$Id_str.'\n';
					$descibe .= '删除管理员失败！';
					
				exit($descibe);
			}
		}else if($d=='logindeal'){

				$adminname = getvar('UserName');
				$adminpwd = getvar('Password');
				$table =  C('DB_PREFIX').'admin';
				$sql = 'SELECT `Id`,`power`,`loginTimes`,`lastLoginIP`,`lastLoginTime` FROM '.$table.' WHERE `adminName`="'.$adminname.'" AND `adminPwd`="'.md5($adminpwd).'"';
				//exit($sql);
				$result = $originDB->getOneRow($sql);
				if(@empty($result['Id'])){
					$descibe = '用户名或密码错误,';
					$descibe .= '登陆失败！';
					
					$html_str = dialog_toURL($descibe,'window.history.back();','error');
					exit($html_str);
				}else{
					//设置SESSION
					$_SESSION['adminId'] = $result['Id']; 
					$_SESSION['adminName'] = $adminname;
					
					
					//更新登录信息
					$array['loginTimes'] = $result['loginTimes']+1;
					$array['lastLoginIP'] = getIP();
					$array['lastLoginTime'] = time();
					$where = 'Id='.$result['Id'];
					$result = $originDB->update($table,$array,$where);
					
					$power=$result['power'];
					setPowerCacheFile($power);//生成权限缓存文件
					
					$descibe = '登陆成功！';
// 					exit(dialog_toURL($descibe,'window.history.back();','succeed'));
						
					$html_str = dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=index";','succeed');
					exit($html_str);
				}
			}elseif($d=='logout'){
				
				clearPowerCache();//清除缓存文件
				clearImgCache();//清除缓存文件
				
				$_SESSION["adminId"] = "";
				session_unregister("adminId"); //反注册Session变量adminname
				session_unset(); //释放所有Session变量
				session_destroy();//销毁Session，经此后Session ID就会没有了
				$descibe = '退出登录！';
				$html_str = dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=login";','succeed');
				exit($html_str);
		}elseif($d=='update'){
				$Id = getvar('Id');
				if(empty($Id)){
					exit(dialog_toURL("该记录不存在",'window.history.back();','error'));
				}else{
					$table =  C('DB_PREFIX').'admin';
					$sql = "SELECT * FROM $table WHERE Id='$Id' ";
					$query = $originDB->getOneRow($sql);
					if(empty($query['Id'])){
						exit(dialog_toURL( '该记录不存在','window.history.back();','error'));
					}
				}
				
				
				$adminName = $query['adminName'];
				$adminPwd = 'noinput';
				$sex=$query['sex'];
				$realName = $query['realName'];
				$phone = $query['phone'];
				$email = $query['email'];
				$bak = $query['bak'];
				

				$file="update.html";
				$this->assign('d',$d);
				$this->assign('Id',$Id);
				$this->assign('adminName',$adminName);
				$this->assign('adminPwd',$adminPwd);
				$this->assign('sex',$sex);
				$this->assign('realName',$realName);
				$this->assign('phone',$phone);
				$this->assign('email',$email);
				$this->assign('bak',$bak);
// 				$this->assign('power',$power);
// 				$this->assign('group',$query_group);
// 				$this->assign('role',$query_role);
				
			}elseif($d=='updatedeal'){
				
				$Id = getvar('Id');
				
				unset($_POST['Id']);
				unset($_POST['adminPwd_re']);
				$array=$_POST;
				$adminPwd=$array['adminPwd'];
				if($adminPwd=="noinput"){
					unset($array['adminPwd']);
				}else{
					$array['adminPwd']=md5($adminPwd);
				}
				
				$table =  C('DB_PREFIX').'admin';
				$where = "Id='$Id'";
				$query = $originDB->update($table,$array,$where);
				
				
				if($query){
					$descibe = '修改Id：'.$Id.'，修改管理员个人资料成功！';
					
					exit(dialog_toURL($descibe,'window.location.href="index.php?g=Admin&m=Index&a=right";','succeed'));
				}else{
					$descibe = '修改Id：'.$Id.'，修改管理员个人资料失败！';
					exit(dialog_toURL($descibe,'window.history.back();','error'));
				}				
			}else {
				$descibe="请求不正确！";
			exit(dialog_toURL($descibe,'window.history.back();','error'));
			}
		
		$this->assign('file',$file);
		$currentLocal = '后台用户管理';
		$this->assign ( 'currentLocal', $currentLocal );
		$this->display ();
	}
}
