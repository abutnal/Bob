<?php
class Database{
	public $con;
	public function __construct(){
		$this->con = mysqli_connect("localhost","root","","bobfreelancer");
		if(!$this->con){
			die('Connection failed').mysqli_error();
		}
	}
}
$obj = new Database;