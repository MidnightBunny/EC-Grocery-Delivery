<?php include 'connection.php';?>
<?php
session_start();
if($_SESSION['id']){
        $id=$_SESSION['id'];
        $firstname=$_SESSION['firstname'];
        $lastname=$_SESSION['lastname'];
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
<nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle navbar-toggle-sidebar collapsed">
      MENU
      </button>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
        Administrator
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
      <form class="navbar-form navbar-left" method="GET" role="search">
        <div class="form-group">
          <input type="text" name="q" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <!-- <li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li> -->
        <li class="dropdown ">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            Welcome! <?php echo $firstname." ".$lastname;?>
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">SETTINGS</li>
              <li class=""><a href="#">Other Link</a></li>
              <li class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>    <div class="container-fluid main-container">
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
          <li><a href="#"><span class="fa fa-tasks"></span> Category</a></li>
          <li><a href="#"><span class="fa fa-truck"></span> Supplier</a></li>
          <li><a href="#"><span class="fa fa-shopping-bag"></span> Items</a></li>
          <li><a href="#"><span class="fa fa-pie-chart"></span> Inventory</a></li>
           <li><a href="#"><span class="fa fa-database"></span> Reports</a></li>
         

          </ul>

          
      </div><!-- /.navbar-collapse -->
    </nav>

  </div>

</div>      </div>
      <div class="col-md-10 content">
          
                <div>
                <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-list"></span>Sortable Lists
                </div>
                <div class="panel-body">
                    
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
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
    </div>	
	</body>
</html>