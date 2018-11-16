<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
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
        <li><a href="#"></a></li>
      </ul>
    </div>
  </div>
</nav>
<!--/Navbar-->

    <div class="container">
        <div class="row"><br>
            <div class="col-md-4 col-lg-4 col-md-offset-6">
                <div class="panel panel-primary">
                    <div class="panel-heading" style="color:#fff;font-size:20px;padding: 2px 14px;margin: 0px;">Login Form</div>
                    <div class="panel-body">
                        <form action="controller.php" method="post">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group"><input type="email" required="required" name="username" placeholder="Username" class="form-control"></div>
                                    <div class="form-group"><input type="password" required="required" name="password" placeholder="Password" class="form-control"></div>
                                    <?php if(isset($_GET['msg'])){ 
                                    
                                    echo '<div style="padding:6px 25px 6px 10px" class="alert alert-dismissible alert-warning">
                                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                                      <strong>  '.$_GET['msg'].'</strong>.
                                  </div>';
                              }?>
                              <div class="form-group"><input type="submit" name="login" value="Login" class="btn btn-success pull-right"></div>
                          </div>
                      </div>
                  </form>
              </div>
              
          </div>
          <p style="font-size: 15px;">Username: utnal.ab@gmail.com <br> Password: 123456</p>
             
      </div>
  </div>
</div>
</body>
</html>