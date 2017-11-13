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
          $image=$_SESSION['image'];
          
        
      }
  else{
          header("location:dashboard.php");
      } 
    
?>
<?php 
$ord=mysqli_query($open_connection,"SELECT *  FROM tbl_orders");
$myord=mysqli_num_rows($ord);
?>
<?php 
if(isset($_POST['notify']))
    {
        $no=$_POST['ord_id'];
        mysqli_query($open_connection,"UPDATE tbl_custorder SET order_noti='0'") or die(mysqli_error($open_connection));
        header("location:orders.php");   
      }

$ords=mysqli_query($open_connection,"SELECT *  FROM tbl_custorder where order_noti='1'");
$custord=mysqli_num_rows($ords);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Customer</title>
    <link href="assets/images/ec.png" rel="icon" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="Assets/css/panel.css" />
    <script type="text/javascript" src="Assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
            <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css" />
    <script type="text/javascript">
       $(document).ready( function() {
      $('#myTable').DataTable({
        "order":[],
        "aoColumnDefs" : [ {
        "bSortable" : false,
        "aTargets" : [ "no-sort" ]}]
        
      });
    });
    </script>
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" rel="stylesheet">

<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img id="logo-img" style="height: 60px;" class="logo-img navbar-brand" src="Assets/Images/ban.png"/>
        </div>
        <div class="navbar-collapse collapse">
            <form method="post">
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-right: -15px;"><a href="#"><i class="fa fa-refresh" style="font-size:20px;"></i> <span class="label label-danger">0</span></a></li>
                  <input type="hidden" name="ord_id" id="ord_id">  
                <li style="margin-right: -10px;">
                    <button type="submit" name="notify" style="margin-top:14px; background-color: #7f0000;border: none;color:white;">
                        <i class="fa fa-shopping-cart" style="font-size:20px;"></i>
                        <span class="label label-danger"><?php echo $custord," "; ?></span>
                    </button>
                </li>
             </form>
                <li><a  href="supp_orders.php"><i class="fa fa-truck" style="font-size:20px;"></i> <span class="label label-danger"><?php echo $myord," "; ?></span></a></li>

                <li><a   href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>

<!-- /Header -->

<!-- Main -->

<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12">

    <ul class="nav nav-pills nav-stacked" style="border-right:1px solid black">
        <li class="nav-header"><center><img src="<?php echo $image?>" class="img-circle" style="height: 90px;width: 90px;"></center></li>
        <li class="nav-header"><center><label><?php echo "{$firstname} {$lastname}";?>
        <a data-toggle="modal" data-target="#accountSettings"> <span class="fa fa-cog"></span></a></label></center></li>
        <li><center><span style="font-size:12px;"><?php echo date(" F j, Y "); ?></span></center></li>
        <li><hr style="width: 50%;"></li>
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="product.php"><i class="fa fa-shopping-bag"></i> Products</a></li>
        
        <li><a href="supplier.php"><i class="fa fa-truck"></i> Suppliers</a></li>
        <li><a href="orders.php"><i class="fa fa-check-square-o"></i> Orders</a></li>
        <li class="active"><a href="customers.php"><i class="fa fa-address-book"></i> Customers</a></li>
        <li><a href="reports.php"><i class="fa fa-book"></i> Reports</a></li>
        <li><a href="users.php"><i class="fa fa-users"></i> User Management</a></li>
        <li><a href=myprofile.php><i class="fa fa-id-badge"></i> Profile Settings</a></li>

    </ul>
</div><!-- /span-3 -->
<div class="col-lg-10">
    <!-- Right -->

    <a href="#"><strong><span class="fa fa-address-book"></span> Customers</strong></a>
    <hr>
    <div class="col-sm-12">
  <div class="panel panel-danger">
    <div class="panel-heading"></div>
    <div class="panel-body">
        <div class="">
          <div>
            <table class="table table-hover" id="myTable">
              <thead>
                <tr>
                  <td class="no-sort">ID</td>
                  <td class="no-sort">Fullname</td>
                  <td class="no-sort">Contact No.</td>
                  <td class="no-sort">Address</td>
                  
                </tr>
              </thead>
              <tbody>
                <?php 
                          $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_customer") or die(mysqli_error($open_connection));
                          
                            $i=1;
                            while($row=mysqli_fetch_array($display_users)){
                              $id=$row['id'];
                              $first_name=$row['first_name'];
                              $last_name=$row['last_name'];
                              $contact_no=$row['contact_no'];
                              $address=$row['address'];
                ?>
                <tr>
                  <td><?php echo $row['id'];?></td>
                  <td><?php echo $row['first_name'];?> <?php echo $row['last_name']; ?></td>
                  <td><?php echo $row['contact_no']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  
                  
               </tr>
                
              </tbody>

              
            </table>
            <?php $i++; } ?>
          </div>
        </div> 
      </div>
    </div>
  </div>
</div>
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <p class="navbar-text pull-left">© 2017 EC New Deal Grocery All Rights Reserved.
          
      </p>
    
    </div>
</div>

<!-- ==============================================[ USER ACCOUNT SETTINGS ]==============================================-->
    <div  class="modal fade" id="accountSettings" tabindex="-1" role="dialog" >
      <div class="modal-dialog">
        <div class="modal-content modal-sm" style="margin-left:150px;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Change Password</h4>
          </div>
          <div class="modal-body" >
            <form method="post">
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group">
                    <div>
                      <label class="form-label">Username</label> 
                    </div>
                    <input type="hidden" name="ids" value="<?php echo $ids?>" class="form-control" style="margin-bottom:10px;">
                    <input type="text" name="username" value="<?php echo $usernames; ?>" class="form-control" style="margin-bottom: 10px;background-color: white;" disabled>
                    <label class="form-label">Old Password</label>
                    <input type="hidden" name="passwords" value="<?php echo $passwords; ?>">
                    <input type="password"  name="old_password" id="old_password" placeholder="Enter Old Password" class="form-control" aria-describedby="basic-addon1" >
                    <hr/>
                    <label>New Password</label>
                    <input type="password"  name="new_password" id="new_password" placeholder="Enter New Password" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                    <input type="password"  name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                  </div>
                </div> 
                <div style="text-align: center;"><input type="submit" class="btn btn-danger" name="btn_save_new_password"></div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php 
      if(isset($_POST['btn_save_new_password'])){
        $passwords = $_POST['passwords'];
        $old_password = $_POST['old_password'];
        $old_password_encrypted = md5($old_password);
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];
        $UC = false;
        $LC = false;
        $NUM = false;
        if($passwords == $old_password_encrypted){
          if($new_password == $confirm_password){
            if ($new_password == $old_password) {
              echo "<script type='text/javascript'> alert ('The new password is the same as the previous password'); </script>";
            }
            else{
              for ($i=0; $i < strlen($new_password); ++$i) { 
              $b=$new_password[$i];
              if (ctype_upper($b)) {
                $UC = true;
              }
              elseif (ctype_lower($b)) {
                $LC = true;
              }
              elseif (ctype_digit($b)) {
                $NUM = true;
              }
              }
              if (strlen($confirm_password) < 8) {
                echo "<script type='text/javascript'> alert ('Password must be at least 8 character long!'); </script>";
              }
              elseif ($UC && $LC && $NUM ) {
                $pass = md5($new_password);
                $query1= mysqli_query($open_connection,"UPDATE tbl_user SET password='$pass' WHERE id='$ids'") or die (mysqli_error($open_connection));
                echo "<script type='text/javascript'>alert('Password Successfully Change!');</script>";
              }
              else {
                echo "<script type='text/javascript'> alert ('Password must have at least an uppercase letter, a lowercase letter and a number! '); </script>";
              }  
            }
            
          }
          else{echo "<script type='text/javascript'>alert('NEW PASSWORD AND CONFIRM PASSWORD NOT THE SAME!');</script>";}
        }
        else{echo "<script type='text/javascript'>alert('incorrect old password!');</script>";}
      }
    ?>

</body>
</html>