<?php
  include 'connection.php';

  session_start();
  if($_SESSION['id']){
          $ids=$_SESSION['id'];
          $firstname=$_SESSION['firstname'];
          $lastname=$_SESSION['lastname'];
          $passwords=$_SESSION['password'];
          $usernames=$_SESSION['username'];
          $userlevel=$_SESSION['userlevel'];
      }
  else{
          header("location:dashboard.php");
      } 
      
?>
<!DOCTYPE html>
<html>
 <head>
  	<title>Dashboard</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="Assets/js/jquery-1.10.2.min.js"></script>
    <!-- Sources -->
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="Assets/bootstrap/css/admin_style.css"/>
    <link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.css"/>
    <script src="Assets/js/admin_style.js"></script>
    <script src="Assets/bootstrap/js/jquery.min.js"></script>
    <script src="Assets/bootstrap/js/bootstrap.js"></script>

  </head>
  

<body>
  <nav class="navbar navbar-default navbar-static-top" style="background-color: #7f0000;"">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
     
       <img id="logo-img" style="height: 100px;width:100px;" class="logo-img" src="Assets/Images/ec.png"/>
       <div style="margin-left: 100px;margin-top: -50px;">
       <H4 style="color:white;"> EC NEW DEAL GROCERY </H4>
       </div>
    </div>
    <div style="margin-top: 30px;margin-right: 20px;">

      <ul class="nav navbar-right">
        <!-- <li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="color:white;" data-toggle="dropdown" role="button" aria-expanded="false">
              Welcome, <?php echo $userlevel." ".$firstname." ".$lastname;?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li class="dropdown-header">SETTINGS</li>
                <li><a href="#" data-toggle="modal" data-target="#accountSettings"><i class="fa fa-user fa-fw"></i>User Accounts</li>
               
                <li class="divider"></li>
                <li><a href="logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>    
  <div class="container-fluid main-container">
    <div class="col-md-2 sidebar">
      <div class="row">
      <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <div class="absolute-wrapper"> </div>
      <!-- Menu -->
        <div class="side-menu">
          <nav class="navbar navbar-default" role="navigation">
          <!-- Main Menu -->
            <div class="side-menu-container">
              <ul class="nav navbar-nav">
                <li class="active"><a href="#"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                <li><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
                <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
                <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
                <li><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
                <li><a href="inventory.php"><span class="fa fa-pie-chart"></span> Inventory</a></li>
                <li><a href="reports.php"><span class="fa fa-database"></span> Reports</a></li>

                
              </ul>
            </div><!-- /.navbar-collapse -->
          </nav>
        </div>
      </div> 
    </div>
    <div class="col-md-10 content">      
      <div>
        <div class="panel panel-danger">
          <div class="panel-heading">
            <span class="glyphicon glyphicon-list"></span>Dashboard
          </div>
          <div class="panel-body"></div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-12">
                <h6>Kunware footer</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <footer class="footer" style="text-align: center;">
      <p class="col-md-12">
        <hr class="divider">
        Copyright &COPY; 2017 EC New Deal Grocery. All Rights Reserved.
      </p>
    </footer>	
	</body>
</html>