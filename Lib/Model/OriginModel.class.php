<?php
class OriginModel extends Model{
	public function getList($sql){
		return $this->query($sql);
	}
	public function getRowsNum($sql){
		$result=$this->query($sql);//计算记录集总记录数
		$total=mysql_num_rows($result);
		return $total;
	}
	
	public function selectLimit($sql , $rowNum=10 , $offset=0){
		$begin=$offset * $rowNum ;
		$sql .= " limit $begin,$rowNum ";
		
		$query = $this->query ( $sql );
		return $query;
	}
	
	public function insert($table,$array){
		if(is_array($array)){
			$keys="(";
			$values="(";
			foreach ($array as $key=>$value){
				$keys .="$key,";
				$value=(is_array($value))?implode(',', $value):$value;
				$values.="'$value',";
			}
			$keys=trim($keys,',').')';
			$values=trim($values,',').')';
			$sql="insert $table $keys values $values";
		    $result= $this->query($sql);
		    return true;
			
		}else{
			return false;
		}
	}
	
	public function getOneRow($sql){
		$query = $this->query ( $sql );
		if(count($query)>0){
			return $query[0];
		}else{
			return null;
		}
		
	}
	
	public function update($table,$array,$where){
		if(is_array($array)){
			$values=" ";
			foreach ($array as $key=>$value){
				$value=(is_array($value))?implode(',', $value):$value;
				$values.=" $key='$value',";
			}
			$values=trim($values,',');
			$sql="update $table set $values where $where";
			$result= $this->query($sql);
			return true;
				
		}else{
			return false;
		}
	}
	
	public function delete($table,$where){
		
		$sql="delete from $table where $where ";
		$result= $this->query($sql);
		return true;
	}
}