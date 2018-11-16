<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin | Dashboard</title>
</head>
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/bootstrap.min.js"></script>
<body>
	<div class="container">
<!--Navbar-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Bob Freelancer</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<!--/Navbar-->


<!--Main Content-->
<div class="row">
	<div class="col-md-1">
		<a href="dashboard.php" class="btn btn-default pull-left">Back</a>
	</div>
	<div class="col-md-2  ">
			<div class="row">
					<div class="col-md-12">
						 <?php 
	                include('model.php');
	              	session_start();
	              		$s_time='';
	               $where = ['user_id'=>$_SESSION['user_id']];
				   $admin = $obj->select_where('user_tbl',$where);
				   foreach ($admin as $name) {
				   	echo '<span  class="btn btn-warning pull-left">WELCOME '.$name['fullname'].'</span>';
				   }
				?>
					</div>
					<div class="col-md-12">
						
						<?php  
								$arr = array();
							    $where = ['user_id'=>$_SESSION['user_id'], 'project_id'=>$_GET['project_id']];
								$times = $obj->select_totaltime('project_log_history',$where);
								foreach ($times as $time) {
									if (!empty($time['totaltime'])) {
										echo '<h3>Total Working Hours</h3>';
										echo '<span style="font-size:18px;font-wieght:bold">'.substr($time['totaltime'], 0,-7).'</span> h:m:s';
									}
									
								}
						        
                         
								
						?>
					</div>
				</div>	
	             


             
	</div>


	<div class="col-md-7 col-md-offset-1">

				<?php
					if (isset($_GET['project_id'])) {
									$s_time='';
									$stop_time='';
									$logid='';
									$id =$_GET['project_id'] ?? null;
									$where = ['project_id'=>$id,'user_id'=>$_SESSION['user_id']];
									$logdata_id = $obj->select_where('project_log_history',$where);
									foreach ($logdata_id as $row) {
 												$logid = $row['log_id'];
 												$s_time = $row['start_time'];
 												$stop_time = $row['stop_time'];
									}
									$data = $obj->select_where('project_tbl',$where);
									foreach ($data as $row) {
									?>
							
									
				<table class="table table-bordered">
					<tr>
						<th>Project Title</th>
						<td><?php echo $row['project_title']?></td>
					</tr>
					<tr>
						<th>Project Description</th>
						<td><?php echo $row['project_description']?></td>
					</tr>
					<tr>
						<th>Client Details</th>
						<td><?php echo $row['client_details']?></td>
					</tr>
				</table>
				<?php  } }?>

		<?php
		$date = new DateTime('now', new DateTimeZone('Asia/Kolkata'));
        $date = $date->format('h:i:s a');
			$start = strtotime($s_time); 
			$end = strtotime($date); 
			$totaltime = ($end - $start)  ; 
			$hours = intval($totaltime / 3600);   
			$seconds_remain = ($totaltime - ($hours * 3600)); 
			$minutes = intval($seconds_remain / 60);   
			$seconds = ($seconds_remain - ($minutes * 60)); 

			
		?>

		<?php

		?>


		<?php if ($s_time!='' && $stop_time==''){ ?>
			<form action="controller.php" method="post">
					<input type="hidden" name="strttimer" value="<?php echo $date?>">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>" class="form-control">
					<input type="hidden" name="project_id" value="<?php echo $row['project_id']?>" class="form-control">
					<input type="hidden" name="stoptimer" value="<?php echo $date?>">
					<input type="hidden" name="log_id" value="<?php echo $logid?>">
					<input type="hidden" name="total_hours" value="<?php echo "$hours:$minutes:$seconds";?>">
					<input type="submit" value="Stop" id="hide" name="stoptime" class="btn btn-danger pull-right">	
				</form>
		<?php }else{?>
			 <form action="controller.php" method="post">
					<input type="hidden" name="strttimer" value="<?php echo $date?>">
					<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>" class="form-control">
									<input type="hidden" name="project_id" value="<?php echo $row['project_id']?>" class="form-control">
					<input type="submit" value="Start" id="show" name="starttime" class="btn btn-success pull-right">
				</form>		
			<?php

		} ?>
				
				
	</div>
</div>

			<div class="container">
				<div class="row">
					<br>
						
					<div class="col-md-6 col-md-offset-4 col-md-onset-3">
					
							<table class="table table-bordered">
								
									<?php
					                if (isset($_GET['project_id'])) {
									$id =$_GET['project_id'] ?? null;
									$where = ['project_id'=>$id,'user_id'=>$_SESSION['user_id']];
									$data = $obj->select_where('project_log_history',$where);
									if (!empty($data)) {
											echo '<tr>
						<th>SL</th>
						<th>Time</th>
						<th>Total Hours</th>
						<th>Date</th>
					</tr>';
									}
								    $count =1;
									foreach ($data as $row) {
									?>
									
					  <tr>
					  	<td><?php echo $count++;?></td>
					  	<td><b>From</b> <?php echo $row['start_time']?> <b>To</b> <?php echo $row['stop_time']?></td>
					  	<td><?php echo $row['total_hours']?></td>
					  	<td><?php echo $row['date']?></td>
					  </tr>
				
				<?php  } }?>
									</table>		
					</div>
					
				</div>
			</div>
<!--/Main Content-->
	</div>
	<script>
$(document).ready(function(){
  /*  $('#hide').hide();
    $("#show").click(function(){
        $("#hide").show();
        $("#show").hide();
    });
    
    $("#hide").click(function(){
        $("#hide").hide();
        $("#show").show();
    });
});
</script>
</body>
</html>