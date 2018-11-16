<?php
include('model.php');
//Add New Project POST
if (isset($_POST['submit'])) {
	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$date = $date->format('d-m-Y h:i:s');
	$check = ['project_title'=> mysqli_real_escape_string($obj->con,$_POST['project_title'])];
	$data = [
		'user_id'=> $_POST['user_id'],
		'project_title'=> mysqli_real_escape_string($obj->con,$_POST['project_title']),
		'project_description' => mysqli_real_escape_string($obj->con,$_POST['project_description']),
		'client_details' => mysqli_real_escape_string($obj->con,$_POST['client_details']),
		'date' => $date
	];

	if($obj->insert('project_tbl',$data,$check)){
		header('Location:dashboard.php?msg=New Project Added Successfully&class=success');
	}
	else
	{
		header('Location:dashboard.php?msg=Project Title already taken, Try with another&class=warning');
	}
}

//Login Form POST 
if (isset($_POST['login'])) {
	$data =[
		'email'=>$_POST['username'],
		'password'=>md5($_POST['password'])
	];
	$user_id = $obj->login('user_tbl',$data);
	if(isset($user_id))
	{
		session_start();
		header('Location:dashboard.php');
		$_SESSION['user_id']=$user_id;
	}
	else
	{
		
		header('Location:index.php?msg=Wrong username or password');
	}
}




//Update Form POST
if (isset($_POST['update'])) {

	$data = [
		'project_title'=> mysqli_real_escape_string($obj->con,$_POST['project_title']),
		'project_description' => mysqli_real_escape_string($obj->con,$_POST['project_description']),
		'client_details' => mysqli_real_escape_string($obj->con,$_POST['client_details'])
	];
	$where = ['project_id'=>$_POST['project_id'],'user_id'=> $_POST['user_id']];
	if($obj->update('project_tbl',$data,$where))
	{
		header('Location:dashboard.php?msg=Record Updated Successfully&class=success');
	}
	else
	{
		header('Location:dashboard.php?msg=Opps!, Something is wrong Try again&class=warning');
	}
}

//Delete records POST
if (isset($_POST['delete'])) {
	$where = ['project_id'=>$_POST['p_id'],'user_id'=>$_POST['u_id']];
	//print_r($where);
	if($obj->delete('project_tbl',$where)){
		header("Location:dashboard.php?msg=Record Deleted Successfully&class=danger");
	}
	else
	{
		header("Location:dashboard.php?msg=Oops! Try again&class=warning");
	}
}

//Timer Code POST
if (isset($_POST['starttime'])) {
	$data = ['user_id'=> $_POST['user_id'],'project_id'=> $_POST['project_id'],'start_time'=>$_POST['strttimer']];
	if($obj->insert('project_log_history',$data,$check)){
		header('Location:details.php?project_id='.$_POST['project_id'].'');
	}
}

if (isset($_POST['stoptime'])) {
	$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
	$date = $date->format('d-m-Y h:i a');
	$data = ['stop_time'=> $_POST['stoptimer'], 'total_hours'=>$_POST['total_hours'], 'date'=>$date];
	$where = ['log_id'=>$_POST['log_id'],'user_id'=> $_POST['user_id'],'project_id'=>$_POST['project_id']];
	
	if($obj->update('project_log_history',$data,$where))
	{
		header('Location:details.php?project_id='.$_POST['project_id'].'');
	}
	else
	{
		header('Location:details.php');
	}
}