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
    //=====================================[ DELETE USER ]============================================= 
    if(isset($_POST['deleteUser']))
      {
        $no=$_POST['id'];
          mysql_query("DELETE from tbl_users WHERE id='$no'") or die(mysql_error());
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
        $userlevel=$_POST['userlevel'];
        $status='ACTIVE';
        $storedFile="images/posts/".basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysql_query("INSERT into tbl_users VALUES('$id','$firstname','$lastname','$username','$password','$userlevel','$storedFile','$status')") or die(mysql_error()); 
       
        header("location:user.php");
      }
    //==================================[UPDATE USER]===================================================
    if(isset($_POST['update_btn']))
      {
        $id=$_POST['id'];
        $firstname=$_POST['firstname'];    
        $lastname=$_POST['lastname'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $userlevel=$_POST['userlevel'];
      
        mysql_query("UPDATE tbl_users SET firstname='$firstname',lastname='$lastname',username='$username',password='$password',userlevel='$userlevel' WHERE id='$id'") or die(mysql_error()); 


        header("location:user.php");
              }
   
    
?>
<!--====================[DELETE CONFIRMATION]===================-->
<script type="text/javascript">
  function del_confirmation()
  {
    if(confirm("Are you sure?")==1)
    {
      document.getElementById('deleteUser').submit();
    }
  }
</script>

<!DOCTYPE html>
<html>
 <head>
    <title>User's Management</title>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="Assets/js/jquery-1.10.2.min.js"></script>
    <!-- Sources -->
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="Assets/bootstrap/css/admin_style.css"/>
    <link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.css"/>
    <script src="Assets/js/keypress.js"></script>
    <script src="Assets/js/admin_style.js"></script>
    <script src="Assets/bootstrap/js/jquery.min.js"></script>
    <script src="Assets/bootstrap/js/bootstrap.js"></script>

     <script type="text/javascript">
      $(document).ready(function(){
        $('#myTable').DataTable();});
    </script>
  </head>

 <!-- Keypress -->
    <script type="text/javascript"> 
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
        function number(e) 
        { 
            var key; var keychar; 
                if (window.event) 
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else return true; 
                keychar = String.fromCharCode(key); 
                keychar = keychar.toLowerCase(); 
                if ((("0123456789").indexOf(keychar) > -1))
                    return true; 
                else 
                    return false; 
        }
        function number2(e) 
        { 
            var key; var keychar; 
                if (window.event) 
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else return true; 
                keychar = String.fromCharCode(key); 
                keychar = keychar.toLowerCase(); 
                if ((("0123456789-").indexOf(keychar) > -1))
                    return true; 
                else 
                    return false; 
        }   
        function lenum(e) 
        { 
            var key; var keychar; 
                if (window.event) 
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else return true; 
                keychar = String.fromCharCode(key); 
                keychar = keychar.toLowerCase(); 
                if ((("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz 0123456789").indexOf(keychar) > -1))
                    return true; 
                else 
                    return false; 
        } 
        function lenum2(e) 
        { 
            var key; var keychar; 
                if (window.event) 
                    key = window.event.keyCode; 
                else if (e) 
                    key = e.which; 
                else return true; 
                keychar = String.fromCharCode(key); 
                keychar = keychar.toLowerCase(); 
                if ((("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz 0123456789,.").indexOf(keychar) > -1))
                    return true; 
                else 
                    return false; 
        } 

    </script>
  <body>
   <nav class="navbar navbar-default navbar-static-top" style="background-color: #7f0000;>
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
              <li><a href="#" data-toggle="modal" data-target="#accountSettings"><i class="fa fa-user fa-fw"></i>Change Password</li>
              <li class="divider"></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
           
          </li>
        </ul>
        </div>
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
          <li class="active"><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
          <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
          <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
          <li><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
          <li><a href="inventory.php"><span class="fa fa-pie-chart"></span> Inventory</a></li>
          <li><a href="reports.php"><span class="fa fa-database"></span> Reports</a></li>

    </nav>

  </div>
</div>      
</div></ul>
      <div class="col-md-10 content">
          
                <div>
                <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-list"></span>User Lists
                </div>
                <div class="panel-body">
                  <form method="POST">
   
                    <input type="text"  name="search">
                    <select name="select_search">
                      <option value="Username">Username</option>
                      <option value="FirstName">First Name</option>
                      <option value="LastName">Last Name</option>
                    </select>
                    <button  type="submit" class="btn btn-primary fa fa-search" name="btn_search"></button>
                    <button  type="submit" class="btn btn-success" name="btn_reset">Show All</button>
                    
                  </form>  
                      
                    <table class="table table-stripped table-hover">
                      <thead>
                        <tr>
                          <th>Userlevel</th>
                          <th>Username</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th> Status </th>
                          <th>View</th>
                          <th>Edit</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $display_users=mysql_query("SELECT * FROM tbl_users WHERE userlevel!='Super Admin'") or die(mysql_error());
                          if (isset($_POST['btn_reset'])) {
                            $display_users=mysql_query("SELECT * FROM tbl_users WHERE userlevel!='Super Admin'") or die(mysql_error());
                          }
                          elseif (isset($_POST['btn_search']) ) {
                            $selected = $_POST['select_search'];
                            if ($selected == 'Username') {
                              $s = $_POST['search'];
                              $display_users=mysql_query("SELECT * FROM tbl_users WHERE userlevel!='Super Admin' AND username LIKE '%{$s}%'") or die(mysql_error());  
                            }
                            elseif ($selected == 'FirstName') {
                              $s = $_POST['search'];
                              $display_users=mysql_query("SELECT * FROM tbl_users WHERE userlevel!='Super Admin' AND firstname LIKE '%$s%'") or die(mysql_error());  
                            }
                            elseif ($selected == 'LastName') {
                              $s = $_POST['search'];
                              $display_users=mysql_query("SELECT * FROM tbl_users WHERE userlevel!='Super Admin' AND lastname LIKE '%$s%'") or die(mysql_error());  
                            }
                            
                          }
                          
                            $i=1;
                            while($row=mysql_fetch_array($display_users)){
                              $id=$row['id'];
                              $userlevel=$row['userlevel'];
                              $username=$row['username'];
                              $firstname=$row['firstname'];
                              $lastname=$row['lastname'];
                              $password=$row['password'];
                              $storedFile=$row['image'];
                        ?>

                        <tr>
                          <td><?php echo $row['userlevel']?></td>
                          <td><?php echo $row['username']?></td>
                          <td><?php echo $row['firstname']?></td>
                          <td><?php echo $row['lastname']?></td>
                          <td><?php echo $row['status']?> </td>
                          
                          

                           <?php
                            $id_selected=$id;  
                            $firstname_selected=$firstname;
                            $lastname_selected=$lastname;         
                            $username_selected=$username;
                            $image_selected=$storedFile;
                            $password_selected=$password;
                            $userlevel_selected=$userlevel;
                            
                            ?>
                            <td>
                           <a href="#viewModal<?php echo$i?>" class="btn btn-success btn-sm" title="View Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-eye"></i></a></td>
                          <td>
                          <a href="#editModal<?php echo$i?>" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-pencil"></i></a>
                          </td>
                          

                </div>
                </div>
                </div>

                <!--Edit Users Modal -->
                 <div id="editModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                              <h4 class="modal-title">Edit Account</h4>
                              </div>
                              <div class="modal-body" >
                              <form method="post">
                                    
                                <input type="hidden" name="id" id="id" class="form-control">
                                <div class="col-sm-10">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <select id="userlevel" name="userlevel" class="form-control" value="<?php echo $userlevel_selected ?>">
                                          
                                          <option>Admin</option>
                                          <option>Cashier</option>
                                          <option>Merchandiser</option>
                                    </select>
                                  </div>
                                </div>
                            <input type="hidden"  name="id"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $id_selected?>" readonly >
                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">User Name</span>

                              <input type="text" name="username"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $username_selected?>" >

                            </div>
                            </div>

                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text" name="firstname" class="form-control" value="<?php echo $firstname_selected?>" >
                            </div>
                            </div>

                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                              <input type="text" name="lastname" class="form-control" aria-describedby="basic-addon1" value="<?php echo $lastname_selected?>" >
                            </div>
                            </div>

                        </div>
                              <div class="row">
                              <div class="col-sm-10">
                              <div class="modal-footer">
                                <button name="update_btn" id="update_btn" class="btn btn-success" type="submit"> Update</button>
                                
                                </form>

                                </div>
                                </div>
                              </div>
                            </div>
                            
                            
                         </form>
                         </div>
                         </div>
                         </div>


                <!--View Users Modal -->
                        <div id="viewModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" style="width: 400px;">
                        <div class="modal-content">
                        <div class="modal-header">
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
                              <input type="text"  class="form-control" aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $firstname_selected?>" readonly="" style="background-color:white;" >
                            </div>
                            </div>

                          <div class="form-group col-sm-11">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                            <input type="text"  class="form-control"  aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $lastname_selected?>" readonly="" style="background-color:white;">
                            </div>
                            </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                          <button data-dismiss="modal" aria-label="Close" class="btn btn-success">Close</button>

  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                                        



                                        </tr>
                                       <?php $i++; }?>
                                </tbody>

                              </table>
                             
                            </div>
                                 <div class="panel-footer" style="height: 50px;">
                    <div class="row">
                        <div class="col-md-4">
                           <a href="#" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"> </i> New Account</a>
                           <hr>
                        </div>  

</div>
      </div>

                          </div>


                        </section>
                                <!-- End of Table View -->
                              <hr>
                  <!--Creating User MODAL -->
                 <div class="modal fade" id="addModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" style="width: 450px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Account Information</h4>
                            <div class="modal-body"style="margin-left: 10px;">
                              <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                <div class="row">
                                
                                  <input type="hidden" name="id" id="id" class="form-control">
                                     
                                  <div class="col-sm-12" style="margin-top: 10px;"> 
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <select id="userlevel" name="userlevel"  class="form-control" required>
                                      <option value="" disabled selected>User Level</option>
                                      <option>Admin</option>
                                      <option>Cashier</option>
                                      <option>Merchandiser</option>
                                      <option>Delivery Boy</option>
                                    </select>
                                  </div>
                                  </div>


                                  <div class="col-sm-12" style="margin-top: 10px;">
                                  <div class="input-group">
                                   <span class="input-group-addon" id="basic-addon1">Image</span>
                                    <input type="file" name="file" id="image" class="form-control" placeholder="Image" required>
                                  </div>
                                  </div>

                                   <div class="col-sm-12" style="margin-top: 10px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">First Name</span>
                                        <input type="text" name="firstname" id="firstname" class="form-control"  maxlength="20" onKeyPress="return letter(event)" placeholder="First Name" required="">
                                    </div>
                                    </div>

                                    <div class="col-sm-12" style="margin-top: 10px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Last Name</span>
                                        <input type="text" name="lastname" id="lastname" class="form-control"  onKeyPress="return letter(event)" placeholder="Last Name" required="">
                                    </div>
                                    </div>
                                    <input type="hidden" name="status" id="status" class="form-control">
                           
                                    </div>

                                   <div class="row" style="margin-top: 20px;">
                                   <div class="col-sm-10">
                                      <input type="submit" class="btn btn-success" name="add_user" value="Save Changes">
                                      <?php
                                      if (isset($_POST['add_user']))
                                      {
                                        echo "<script type='text/javascript'>alert('Users Account Created!');</script>";
                                      }
                                        ?>
                                      <input type="reset" class="btn btn-default" value="Clear">

                                       </div>
                                    </div>
                                      </form>
                                   
                                  </div>

                                     
                                
                            </div>
                        </div>
                      </div>

                    </div>  
                    </tr>       
                    </tbody>
                    </table>
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