<?php
class MemberAction extends AdminCommonAction{
	
	/**
	 * ---用户管理------
	 */
	public function memberManage(){
		
		$d=getvar('d');
		$originDB=new OriginModel();
		
		if($d=='' || $d=='list'){
			define('NOWPOWER','c050200');
			isHavePower(NOWPOWER);
			
			$file="list.html";
		}else if($d=='listjson'){
				
				$page = isset($_POST['page']) ? $_POST['page'] : 1;
				$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
				$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'name';
				$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'desc';
				$search = isset($_POST['search']) ? $_POST['search'] : '';
				$keywords = isset($_POST['keywords']) ? $_POST['keywords'] : '';
				
				
				$table =  C('DB_PREFIX').'member';
				$sql = 'SELECT Id,email,realname,sex,mobile,isFrost,regTime FROM '.$table.' WHERE 1=1';
				if($search){
					if($keywords!='' && $keywords!='关键字'){
						$sql .= " AND `email` LIKE '%".$keywords."%' OR `realname` LIKE '%".$keywords."%' OR `mobile` LIKE '%".$keywords."%' OR `phone` LIKE '%".$keywords."%'";
					}
				}
				$sql .= " ORDER BY ".$sortname." ".$sortorder;
				
				$offset = $page-1;				
				$total =$originDB->getRowsNum($sql);//计算记录集总记录数
				$query =$originDB->selectLimit($sql , $rp , $offset);
				
				header("Content-type: application/json");
				$jsonData = array('page'=>$page,'total'=>$total,'rows'=>array());
				foreach($query AS $row){		
					if($row['isFrost']==2){
						$status = '被冻结';
					}else{
						$status = '正常';
					}
								
					$entry = array('id'=>$row['Id'],
						'cell'=>array(
							'Id'=>$row['Id'],
							'email'=>$row['email'],
							'realname'=>$row['realname'],
							'sex'=>$row['sex']==1?'先生':'女士',
							'mobile'=>$row['mobile'],
							'status'=>$status,
							'regTime'=>date('Y-m-d',$row['regTime']),
							'deal'=>'<a href="javascript:void(0);" onclick="deleteOne('.$row['Id'].')">删除</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="memberView('.$row['Id'].')">查看</a>'
						),
					);
					$jsonData['rows'][] = $entry;
				}
			exit(json_encode($jsonData));
		}elseif($d=='view'){
				$Id = getvar('Id');
				$table =  C('DB_PREFIX').'member';
				$sql = 'SELECT * FROM '.$table.' WHERE `Id`="'.$Id.'"';
				$query = $originDB->getOneRow($sql);
				$file="view_member.php";
				require("/Tpl/Admin/Member/Index/$file");
				exit;
				
			}elseif($d=='del'){
// 				define('nowpower','c050202');
// 				if(!powerVerify(nowpower,$_SESSION['adminId'])){
// 					exit($GLOBALS['LANG']['glb_oth_nopower']);
// 				}
				define('NOWPOWER','c050202');
				isHavePower(NOWPOWER);
				
				$Id_str = getvar('Id');
				$Id_str = str_replace('row','',$Id_str);

				if(empty($Id_str)){
					exit('请选择删除的记录');
				}
				
				$table =  C('DB_PREFIX').'member';
				$where = "Id IN(".$Id_str.")";
				$query =$originDB->delete($table,$where);
				
				if($query){
					$descibe = '删除会员成功\n';
					$descibe .= '会员Id：'.$Id_str;
					
					exit('ok');
				}else{
					$descibe = '删除会员失败\n';
					$descibe .= '会员Id：'.$Id_str;
					
					exit($descibe);
				}
			}elseif($d=='isfrost'){
// 				define('nowpower','c050202');
// 				if(!powerVerify(nowpower,$_SESSION['adminId'])){
// 					exit($GLOBALS['LANG']['glb_oth_nopower']);
// 				}
				define('NOWPOWER','c050202');
				isHavePower(NOWPOWER);
				$Id_str = getvar('Id');
				$Id_str = str_replace('row','',$Id_str);

				if(empty($Id_str)){
					exit('请选择记录');
				}
				
				$value = getvar('value');
				$array['isFrost'] = $value;
				$table =  C('DB_PREFIX').'member';
				$where = 'Id IN ('.$Id_str.')';
				$query = $originDB->update($table,$array,$where);
				
				if($query){
					exit('ok');
				}else{
					if($value=='2'){
						exit('取消冻结账户成功！');
					}else{
						exit('取消冻结账户失败！');
					}
				}			
			}elseif($d=='resetpwd'){
// 				define('nowpower','c050202');
				define('NOWPOWER','c050202');
				isHavePower(NOWPOWER);
				$Id_str = getvar('Id');
				$Id_str = str_replace('row','',$Id_str);

				if(empty($Id_str)){
					exit('请选择要操作的记录！');
				}
				
				$array['password'] = md5('123456');
				$table =  C('DB_PREFIX').'member';
				$where = 'Id IN ('.$Id_str.')';
				$query = $originDB->update($table,$array,$where);
				
				if($query){
					exit('ok');
				}else{
					exit('重置密码失败！');
				}
			}else {
				$descibe="请求不正确！";
			exit(dialog_toURL($descibe,'window.history.back();','error'));
		}
		
		$this->assign('file',$file);
		$currentLocal='用户管理';
		$this->assign('currentLocal',$currentLocal);
		$this->display();
	}
	

	
}