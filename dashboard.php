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
						<li><a href="logout.php" style="font-size: 18px">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!--/Navbar-->
		<!--Main Content-->
		<div class="row">
			<div class="col-md-5  col-md-offset-1">
				
				<?php 
				include('model.php');
				session_start();

				$where = ['user_id'=>$_SESSION['user_id']];
				$admin = $obj->select_where('user_tbl',$where);
				foreach ($admin as $name) {
					echo '<span  class="btn btn-warning pull-left">WELCOME '.$name['fullname'].'</span>';
				}
				?>

			</div>
			<div class="col-md-4 col-md-offset-1">

				<?php

				if (isset($_GET['update'])) {
					$id =$_GET['project_id'] ?? null;
					$where = ['project_id'=>$id];
					$data = $obj->select_where('project_tbl',$where);
					foreach ($data as $row) {?>
						<!-- Edit Form-->
						<div class="panel panel-primary">
							<div class="panel-heading">Edit Project Details</div>
							<div class="panel-body">
								<form action="controller.php" method="post">
									<div class="row">
										<div class="col-md-12"><div class="form-group">
											<input type="text" name="project_title" required value="<?php echo $row['project_title'] ?>" placeholder="Title" id="" class="form-control">
										</div></div>
										<div class="col-md-12"><div class="form-group">
											<textarea name="project_description"  required placeholder="Description" id="" cols="30" rows="2" class="form-control"><?php echo $row['project_description'] ?></textarea>
										</div></div>
										<div class="col-md-12"><div class="form-group">
											<textarea name="client_details" required placeholder="Client Details" id="" cols="30" rows="2" class="form-control"><?php echo $row['client_details'] ?></textarea>
										</div></div>
										<div class="col-md-12">
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>" class="form-control">
											<input type="hidden" name="project_id" value="<?php echo $row['project_id']?>" class="form-control">
											<a href="dashboard.php" class="btn btn-default pull-left">Cancel</a>
											<input type="submit" name="update" value="Update"  class="btn btn-primary pull-right"></div>
										</div>
									</form>
								</div>
							</div>
							<!--/Edit Form-->							
							<?php
						}
					}
					else
					{	
						?>							
						<!--Add New Project Form-->
						<div class="panel panel-primary">
							<div class="panel-heading">Add New Project</div>
							<div class="panel-body">
								<form action="controller.php" method="post">
									<div class="row">
										<div class="col-md-12"><div class="form-group">
											<input type="text" name="project_title" required placeholder="Title" id="" class="form-control">
										</div></div>
										<div class="col-md-12"><div class="form-group">
											<textarea name="project_description" required placeholder="Description" id="" cols="30" rows="1" class="form-control"></textarea>
										</div></div>
										<div class="col-md-12"><div class="form-group">
											<textarea name="client_details" required placeholder="Client Details" id="" cols="30" rows="1" class="form-control"></textarea>
										</div></div>
										<div class="col-md-12">
											<?php if (isset($_GET['msg'])) {
												echo '<div class="alert alert-dismissible alert-'.$_GET['class'].'" style="padding:6px 30px 6px 15px; ">
												<a href="dashboard.php" style="text-decoration:none"> <span class="pull-right" style="font-size:30px;margin-top:-17px;margin-right:-14px !important"> &times;</span>'.$_GET['msg'].'</a>
												</div>';
											}?>
											<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']?>" class="form-control">		
											<input type="submit" name="submit"  class="btn btn-primary pull-right"></div>
										</div>
									</form>
								</div>
							</div>
							<!--/Add New Project Form-->	
						<?php }?>
					</div>
				</div>
				<!-- Data Table -->
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 col-md-onset-2">
							<table class="table table-bordered" >

								<?php
								$data = $obj->select_all('project_tbl');
								if (!empty($data)) {
									echo '
									<tr>
									<thead>
									<th>SL</th>
									<th>PROJECT TITLE</th>
									<th>CLIENT DETAILS</th>
									<th>DATE</th>
									<th colspan="2" style="text-align: center;">ACTION</th>
									</thead>
									</tr>
									';
								}
								$count=1;
								foreach ($data as $row):
									
									?>
									<tr >
										<td><?php echo $count++;?></td>
										<td><?php echo $row['project_title']?></td>
										<td><?php echo $row['client_details']?></td>
										<td><?php echo $row['date']?></td>
										<td style="text-align: right">
											<a href="dashboard.php?update=1&project_id=<?php echo $row['project_id']?>" class="btn btn-primary btn-xs">Edit</a>
											<a href="details.php?project_id=<?php echo $row['project_id']?>" class="btn btn-success btn-xs">Open</a>

											<td><form action="controller.php" method="post">
												<input type="hidden" name="p_id" value="<?php echo $row['project_id']?>"">
												<input type="hidden" name="u_id" value="<?php echo $_SESSION['user_id']?>"">
												<input type="submit" value="Delete" name="delete" class="btn btn-danger btn-xs"></form></td>
											</td>
										</tr>
									<?php endforeach;?>
								</table>
							</div>

						</div>
					</div>
					<!-- End table-->
					<!--/Main Content-->
				</div>

			</body>
			</html>