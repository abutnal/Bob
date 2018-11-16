<?php
include('database.php');
class CurdOperation extends Database{

//Login METHOD
	public function login($table,$data){
		$sql="";
		$condition="";
		foreach ($data as $key => $value) {
			$condition .= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql="SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		$result = mysqli_fetch_array($query);
		if($result[0]>0){
			return $result['user_id'];
		}
	} 	


//Insert METHOD
	public function insert($table,$data,$check){
		$sql="";
		$condition="";
		foreach ($check as $key => $value) {
			$condition .= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql="SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		$result = mysqli_fetch_array($query);
		if($result[0]>0){
			return false;
		}
		else
		{
			$sql ="";
			$sql .= "INSERT INTO ".$table;
			$sql .=" (".implode(", ", array_keys($data)).") VALUES";
			$sql .="('".implode("', '", array_values($data))."')";
			$query = mysqli_query($this->con,$sql);
			if ($query) {
				return true;
			}
		}
	}

//Select ALL  METHOD
	public function select_all($table){
		$sql="";
		$sql .="SELECT * FROM ".$table;
 			//	$sql ="SELECT  A.`project_title` , A.`date` , B.`status` FROM ".$table1." AS A INNER JOIN ".$table2." AS B WHERE A.`user_id` = B.`user_id`";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)):
			$array[]=$row;
		endwhile;
		return $array;
	}


//Select WHERE  METHOD
	public function select_where($table,$where){
		$sql="";
		$condition="";
		$array = array();
		foreach ($where as $key => $value) {
			$condition.= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql = "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_array($query)):
			$array[] = $row;
		endwhile;
		return $array;
	}

 //Select Total Hours  METHOD
	public function select_totaltime($table,$where){
		$sql="";
		$condition="";
		$array = array();
		foreach ($where as $key => $value) {
			$condition.= $key."='".$value."' AND ";
		}
		$condition = substr($condition, 0,-5);
		$sql = "SELECT SEC_TO_TIME( SUM( TIME_TO_SEC( `total_hours` ) ) ) AS totaltime FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_array($query)):
			$array[] = $row;
		endwhile;
		return $array;
	}		

 //Update METHOD
	public function update($table,$data,$where){
		$sql="";
		$condition="";
		foreach ($where as $key => $value) {
			$condition.= $key."='".$value."' AND ";
		}
		foreach ($data as $key => $value) {
			$sql.= $key."='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$condition = substr($condition, 0,-5);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}
	}
 //Delete METHOD
	public function delete($table,$where){
		$sql="";
		$condition="";
		foreach ($where as $key => $value) {
			$condition .= $key."='".$value."' AND "; 	
		}
		$condition = substr($condition, 0,-5);
		$sql = "DELETE FROM ".$table." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}					
}
$obj = new CurdOperation;