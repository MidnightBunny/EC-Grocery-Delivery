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
//=====================================[ DELETE USER ]============================================= 
  if(isset($_POST['deleteUser']))
    {
      $no=$_POST['id'];
        mysqli_query($open_connection,"DELETE from tbl_user WHERE id='$no'") or die(mysqli_error($open_connection));
        header("location:user.php");
    }
    //=====================================[ ADD USER ]================================================
    if(isset($_POST['add_user']))
       {
        $id=$_POST['id'];
        $firstname=$_POST['firstname'];    
        $lastname=$_POST['lastname'];
        $username=$_POST['firstname'];
        $password=strtoupper($_POST['lastname']);
        $pass=md5($password);
        $userlevel=$_POST['userlevel'];
        $status='ACTIVE';
        $email=$_POST['email'];
        if ($userlevel == "Admin") {
          echo"
        <script type='text/javascript'>
          alert('Cannot create another admin!');
          open('users.php','_self');
          </script>";
        }
        else{
        $storedFile="images/posts/".basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysqli_query($open_connection,"INSERT into tbl_user VALUES('$id','$firstname','$lastname','$username','$pass','$userlevel','$storedFile','$status','$email')") or die(mysqli_error($open_connection)); 
        header("location:users.php");
       }
        
      }
    //==================================[UPDATE USER]===================================================
    if(isset($_POST['update_btn']))
      {
        $id=$_POST['id'];
        $firstname=$_POST['firstname'];    
        $lastname=$_POST['lastname'];
        $username=$_POST['username'];
        $userlevel=$_POST['userlevel'];
        $email=$_POST['email'];

        mysqli_query($open_connection,"UPDATE tbl_user SET firstname='$firstname',lastname='$lastname',username='$username',userlevel='$userlevel',email='$email' WHERE id='$id'") or die(mysqli_error($open_connection)); 

        echo"
     <script type='text/javascript'>
        alert('User successfully updated!')
        open('users.php','_self');
      </script>
      ";

      }    
    
?>
<?php
 if(isset($_POST['deactive_btn']))
        {
          $id=$_POST['id2'];
          $userlevel=$_POST['userlevel2'];
          if ($userlevel != "Admin") {
            mysqli_query($open_connection,"UPDATE tbl_user SET status='DEACTIVATED' WHERE id=$id") or die(mysqli_error($open_connection)); 
          }else{
            echo"
            <script type='text/javascript'>
              alert('Cannot deactivate an Admin account!')
              open('users.php','_self');
              </script
            ";
          }
         
          
        }


        if(isset($_POST['active_btn']))
        {
          $id=$_POST['id2'];
          $userlevel=$_POST['userlevel2'];
          
          mysqli_query($open_connection,"UPDATE tbl_user SET status='ACTIVE' WHERE id=$id") or die(mysqli_error($open_connection)); 
          
         
          
        }
?>
<?php
  if(isset($_POST['deleteUser']))
    {
      $no=$_POST['id'];
        mysql_query("DELETE from tbl_user WHERE id='$no'") or die(mysql_error());
        header("location:users.php");
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
    <title>User Manangement</title>
    <link href="assets/images/ec.png" rel="icon" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="Assets/css/panel.css" />
    <link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css" />
    <script type="text/javascript" src="Assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script> 
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
    <script type="text/javascript">
  function del_confirmation()
  {
    if(confirm("Are you sure?")==1)
    {
      document.getElementById('deleteUser').submit();
    }
  }
  function letter(e) 
        { 
            var key; var keychar; 
                if (window.event) 
                    key = window.event.keyCode; 
                else if (e)   
                    key = e.which; 
                else return true; 
                keychar = String.fromCharCode(key); 
                keychar = keychar.toLowerCase(); 
                if ((("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz ").indexOf(keychar) > -1)) 
                    return true;
                else 
                    return false; 
        }  
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
        <li><hr style="width: 50%"></li>
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="product.php"><i class="fa fa-shopping-bag"></i> Products</a></li>
        
        <li><a href="supplier.php"><i class="fa fa-truck"></i> Suppliers</a></li>
        <li><a href="orders.php"><i class="fa fa-check-square-o"></i> Orders</a></li>
        <li><a href="customers.php"><i class="fa fa-address-book"></i> Customers</a></li>
        <li><a href="reports.php"><i class="fa fa-book"></i> Reports</a></li>
        <li class="active"><a href="users.php"><i class="fa fa-users"></i> User Management</a></li>
        <li><a href="myprofile.php"><i class="fa fa-id-badge"></i> Profile Settings</a></li>

    </ul>
</div><!-- /span-3 -->
<div class="col-lg-10">
    <!-- Right -->

    <a href="#"><strong><span class="fa fa-users"></span> User management</strong></a>
    <hr>
    <div class="col-sm-12">
  <div class="panel panel-danger">
    <div class="panel-heading"></div>
    <div class="panel-body">
      <div class="col-sm-12">
          <div class="col-sm-4" style="border-right:1px solid  #7f0000">
              <form method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" name="id" id="id" class="form-control">
                    <div class="col-sm-12" style="margin-top: 10px;"> 
                      <h4 style="margin-top:-10px;">NEW USER</h4>
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <select id="userlevel" name="userlevel"  class="form-control" required>
                                      <option value="" disabled selected>User Level</option>
                                      <option>Admin</option>
                                      <option>Cashier</option>
                                      <option>Merchandiser</option>
                                      <option>Courier</option>
                                    </select>
                                  </div>
                                  </div>

                                  <div class="col-sm-12" style="margin-top: 20px;">
                                  <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon1">Image &nbsp  &nbsp  &nbsp&nbsp</span>
                                    <input type="file" name="file" id="image" class="form-control" placeholder="Image" required>
                                  </div>
                                  </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">First Name</span>
                                        <input type="text" name="firstname" id="firstname" class="form-control"  maxlength="20" onKeyPress="return letter(event)" placeholder="First Name" required="">
                                    </div>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Last Name</span>
                                        <input type="text" name="lastname" id="lastname" class="form-control"  onKeyPress="return letter(event)" placeholder="Last Name" required="">
                                    </div>
                                    </div>
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="">
                                    </div>
                                    </div>
                                    <input type="hidden" name="status" id="status" class="form-control">
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                  <div class="input-group">
                                   <input type="submit" class="btn btn-danger btn-sm" name="add_user" value="Save Changes">
                                      <?php
                                      if (isset($_POST['add_user']))
                                      {
                                        echo "<script type='text/javascript'>alert('Users Account Created!');</script>";
                                      }
                                        ?>
                                      
                                  </div>
                                  </div>


                </div>
              </form>
          </div>
          <div class="col-sm-8">
              <div>
                  <table class="table table-hover" id="myTable">
                      <thead>
                        <tr>
                          <th>Userlevel</th>
                          <th>Username</th>
                          <th>Fullname</th>
                          <th> Status </th>
                          <th class="no-sort" >Actions</th>
                          <th>  </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_user WHERE userlevel!='Super Admin'") or die(mysqli_error($open_connection));
                          
                            $i=1;
                            while($row=mysqli_fetch_array($display_users)){
                              $id=$row['id'];
                              $userlevel=$row['userlevel'];
                              $username=$row['username'];
                              $firstname=$row['firstname'];
                              $lastname=$row['lastname'];
                              $status=$row['status'];
                              $password=$row['password'];
                              $storedFile=$row['image'];
                              $email=$row['email'];
                        ?>

                        <tr>
                          <td><?php echo $row['userlevel']?></td>
                          <td><?php echo $row['username']?></td>
                          <td><?php echo $row['firstname']?> <?php echo $row['lastname']?></td>
                          <td ><?php echo $row['status']?> </td>

                          <?php
                            $id_selected=$id;  
                            $firstname_selected=$firstname;
                            $lastname_selected=$lastname;         
                            $username_selected=$username;
                            $image_selected=$storedFile;
                            $password_selected=$password;
                            $userlevel_selected=$userlevel;
                            $status_selected=$status;
                            $email_selected=$email;
                            
                            ?>
                          <td style="text-align-last: center;padding-left:0px;">
                            <form method="POST" >
                              <input type="hidden" name="id" value="<?php echo $id;?>">
                              <input type="hidden" name="id2" value="<?php echo $id;?>">
                              <input type="hidden" name="userlevel2" value="<?php echo $userlevel; ?>">
                              <a href="#viewModal<?php echo$i?>" class="btn btn-danger btn-sm" title="View Info" data-toggle="modal" ><i class="fa fa-eye"></i></a>
                              
                              
                              <?php 
                                if ($status == "DEACTIVATED") {
                                  echo "<button name='active_btn' id='active_btn' class='btn btn-danger btn-sm' type='submit' title='Deactivate Account'> <i class='fa fa-check'></i></button>";
                                  
                                }
                                elseif ($status == "ACTIVE") {
                                  $test="<a data-target=\"#editModal\" class=\"btn btn-danger btn-sm\" title=\"Edit Info\" data-toggle=\"modal\" data-id=";
                                  $test2="><i class=\"fa fa-pencil\"></i></a> ";
                                  
                                  echo $test, '[',$id_selected,',"',$userlevel_selected,'","',$username_selected,'","',$firstname_selected,'","',$lastname_selected,'","',$status_selected,'","',$email,'"]',$test2;     
                                   
                                  echo "<button name='deactive_btn' id='deactive_btn' class='btn btn-danger btn-sm' type='submit' title='Reactivate Account' > <i class='fa fa-times'></i></button>";
                                }
                              ?>
                            </form> 

                          </td>
                          <td>
                            
                          </td>
                        </tr>
                         <!--View Users Modal -->
                        <div id="viewModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" style="width: 400px;">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">User information</h4>
                        </div>
                        <div class="modal-body">
                        <form method="post" class="form-horizontal">
                        <div class="row" style="margin-left: 10px;">
                           <div class="form-group col-sm-11">
                                     <center><img src="<?php echo $image_selected; ?>" style="width:100px;height:100px"/></center> 
                                     </div>
                                              
                          <div class="form-group col-sm-11">
                          <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Username</span>
                              <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $username_selected ?>" readonly="" style="background-color:white;">
                          </div>
                          </div>

                                  <div class="form-group col-sm-11">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $userlevel_selected ?>" readonly="" style="background-color:white;">
                                  </div>
                                  </div>
                          </div>

                          <div class="row"style="margin-left: 10px;">
                            <div class="form-group col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text"  class="form-control" aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $firstname_selected?>" readonly style="background-color:white;" >
                            </div>
                            </div>

                          <div class="form-group col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                            <input type="text"  class="form-control"  aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $lastname_selected?>" readonly="" style="background-color:white;">
                            </div>
                            </div>

                             <div class="form-group col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Email</span>
                            <input type="text"  class="form-control"  aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $email_selected?>" readonly="" style="background-color:white;">
                            </div>
                            </div>
                            </div>
                          </div>
                          

                            </form>
                              
                            </div>
                          </div>
                        </div>



                        <?php $i++; }?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>


 <div id="editModal" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                          <div class="modal-dialog">
                            <div class="modal-content" style="width: 400px;margin-left: 100px;">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title">Edit Account</h4>
                              </div>
                              <div class="modal-body" >
                              <form method="post">
                                    
                                <input type="hidden" name="id" id="id" class="form-control">
                                <div class="col-sm-12">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <select id="userlevel" name="userlevel" class="form-control" >
                                          
                                          <option value="Admin">Admin</option>
                                          <option value="Cashier">Cashier</option>
                                          <option value="Merchandiser">Merchandiser</option>
                                          <option value="Courier">Courier</option>
                                    </select>
                                  </div>
                                </div>
                            <div class="col-sm-12" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">User Name</span>

                              <input type="text" name="username"  class="form-control" aria-describedby="basic-addon1"  >

                            </div>
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text" name="firstname" class="form-control" value="" onkeypress="return letter(event)">
                            </div>
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                              <input type="text" name="lastname" class="form-control" aria-describedby="basic-addon1" value="" onkeypress="return letter(event)">
                            </div>
                            </div>

                             <div class="col-sm-12" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Email Add</span>
                              <input type="email" name="email" class="form-control" aria-describedby="basic-addon1" value="" >
                            </div>
                            </div>


                        </div>
                              <div class="row">
                              <div class="col-sm-12" style="padding:25px; margin-left: 150px;">
                             
                                <button name="update_btn" id="update_btn" class="btn btn-danger " type="submit"> Update</button>
                                
                                </form>

                               
                                </div>
                              </div>
                            </div>
                            
                            
                         </form>
                        </div>
                      </div>
                    </div>
                    <script type="text/javascript">
                      $('#editModal').on('show.bs.modal', function(e) {
                          var Users = $(e.relatedTarget).data('id');
                          $(e.currentTarget).find('input[name="id"]').val( Users[0] );
                          $(e.currentTarget).find('select[name="userlevel"]').val( Users[1] );
                          $(e.currentTarget).find('input[name="username"]').val( Users[2]);
                          $(e.currentTarget).find('input[name="firstname"]').val( Users[3] );
                          $(e.currentTarget).find('input[name="lastname"]').val( Users[4] );
                          $(e.currentTarget).find('input[name="email"]').val( Users[6] );
              
                        });
                    </script>



    </div>
  </div>
</div>
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <p class="navbar-text pull-left">© 2017 EC New Deal Grocery All Rights Reserved.
    
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