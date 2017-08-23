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
  	<title>Inventory</title>
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
                <li><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                <li><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
                <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
                <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
                <li><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
                <li class="active"><a href="inventory.php"><span class="fa fa-pie-chart"></span> Inventory</a></li>
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
              <span class="glyphicon glyphicon-list"></span>Inventory
          </div>
          <div class="panel-body">
            <table class="table table-stripped table-hover">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Received</th>
                  <th>On Order</th>
                  <th>Shrinkage</th>
                  <th>Shipped</th>
                  <th>Allocated</th>
                  <th>Back Order</th>
                  <th>On Hand</th>
                  <th>Available</th>
                  <th>Below Target</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-6">
                <div class="row">
                <div class="col-md-6">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Cat"><i class="fa fa-plus"></i> New Purchase Order</button>
                </div>                 
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--=====================================[ CREATE PURCHASE ORDER ]=======================================-->
    <div id="Cat" class="modal fade" role="dialog">
       <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Product</h4>
          </div>
          <div class="modal-body">
            <form class="form-signin" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <div class="row">
                  <div class="col-md-12">
                    <label>Product Name</label>   
                    <select class="form-control" name="select_p" id="select_p" tabindex="4" onchange="showUser(this.value)" required>
                      <option value="" disabled selected>Select Product</option>
                        <?php 
                          $display_cat=mysql_query("SELECT * FROM tbl_products") or die(mysql_error());
                          $i=1;
                          while($row=mysql_fetch_array($display_cat)){
                            $Cat_ID=$row['product_ID'];
                            $Cat_Name=$row['product_name'];
                        ?>
                      <option value="<?php echo $Cat_ID; ?>"><?php echo $Cat_Name; ?></option>
                      <?php } ?>        
                    </select>     
                  </div>
                  
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Standard Price</label>
                      <input type="number" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number3(event)">
                      <label >List Price</label>
                      <input type="number" class="form-control" id="ListPrice" name="ListPrice" placeholder="List Price" tabindex="8" onKeyPress="return number3(event)">
                    </div>         
                  </div>  
                  <div class="col-md-2">
                    <button type="submit" name="ProductSubmit" class="btn btn-default" tabindex="9">Save Order</button>
                  </div>
                </div>
              </div>  
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div> 
    </div>

     <!-- USER ACCOUNT SETTINGS-->
                
                  <div  class="modal fade" id="accountSettings" tabindex="-1" role="dialog" >
                    <div class="modal-dialog">
                      <div class="modal-content modal-sm" style="margin-left:150px;">
                        <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Account Settings</h4>
                        </div>
                            <div class="modal-body" >
                            <form method="post">
                            <div class="row">
                                <div class="col-sm-12">
                                  <div class="input-group">
                                    <div>
                                        <label class="form-label">
                                        Username
                                        </label> 
                                    </div>
                                    <input type="hidden" name="ids" value="<?php echo $ids?>" class="form-control" style="margin-bottom:10px;">
                                    <input type="text" name="username" value="<?php echo $usernames; ?>" class="form-control" style="margin-bottom: 10px;">
                                      <label class="form-label">
                                        Old Password
                                      </label>
                                      <input type="hidden" name="passwords" value="<?php echo $passwords; ?>">
                                      <input type="password"  name="old_password" id="old_password" placeholder="Enter Old Password" class="form-control" aria-describedby="basic-addon1" >
                                      <hr/>
                                      <label>
                                        New Password
                                      </label>
                                      <input type="password"  name="new_password" id="new_password" placeholder="Enter New Passoword" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                                    <input type="password"  name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                                  </div>
                                </div> 
                                <div style="text-align: center;"><input type="submit" class="btn btn-success" name="btn_save_new_password">
                                </div>
                              </div>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>

                            
                            <?php 
                               if(isset($_POST['btn_save_new_password']))
                                {
                                 $username = $_POST['username'];
                                 $passwords = $_POST['passwords'];
                                 $old_password = $_POST['old_password'];
                                 $new_password = $_POST['new_password'];
                                 $confirm_password = $_POST['confirm_password'];

                                  if($passwords == $old_password)
                                 {

                                  if($new_password == $confirm_password)
                                  {
                                    if (strlen($confirm_password) < 8) {
                                      echo "<script type='text/javascript'> alert ('Password does not change successfully! it must be 8 character!'); </script>";
                                    }
                                     elseif (strlen($confirm_password) > 8) {
                                      echo "<script type='text/javascript'> alert ('Password does not change successfully! Password too long!!'); </script>";

                                    }

                                    else {

                                   $query1= mysql_query("UPDATE tbl_users SET username='$username', password='$new_password' WHERE id='$ids'") or die (mysql_error());

                                    echo "<script type='text/javascript'>alert('Password Successfully Change!');</script>";
                                  }
                                }
                                  else
                                  {
                                    echo "<script type='text/javascript'>alert('NEW PASSWORD AND CONFIRM PASSWORD NOT THE SAME!');</script>";
                                  }
                                 }
                                  else
                                  {
                                    echo "<script type='text/javascript'>alert('incorrect old password!');</script>";
                                  }
                                }
                            ?>
    <footer class="footer" style="text-align: center;">
      <p class="col-md-12">
        <hr class="divider">
        Copyright &COPY; 2017 EC New Deal Grocery. All Rights Reserved.
      </p>
    </footer>	
	</body>
</html>