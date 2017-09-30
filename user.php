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
          $img_user=$_SESSION['image'];
          
        
      }
  else{
          header("location:dashboard.php");
      } 
  //=====================================[ DELETE USER ]============================================= 
  if(isset($_POST['deleteUser']))
    {
      $no=$_POST['id'];
        mysqli_query($open_connection,"DELETE from tbl_users WHERE id='$no'") or die(mysqli_error($open_connection));
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
        if ($userlevel == "Admin") {
          echo"
        <script type='text/javascript'>
          alert('Cannot create another admin!');
          open('category.php','_self');
          </script>";
        }
        $storedFile="images/posts/".basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysqli_query($open_connection,"INSERT into tbl_users VALUES('$id','$firstname','$lastname','$username','$pass','$userlevel','$storedFile','$status')") or die(mysqli_error($open_connection)); 
       
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
      
        mysqli_query($open_connection,"UPDATE tbl_users SET firstname='$firstname',lastname='$lastname',username='$username',password='$password',userlevel='$userlevel' WHERE id='$id'") or die(mysqli_error($open_connection)); 

        header("location:user.php");
      }    
    
?>

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

    <link rel="stylesheet" type="text/css" href="css/all.min.css" />

    <script type="text/javascript" src="js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="js/gridData.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css" />

    <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script>  
    <script type="text/javascript">

  
    $(document).ready(function(){
        $('#myTable').DataTable();});
    </script>

      <!--//=========[ Keypress ]========= -->
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
  </head>
  <body>
    <?php 
      //==========================================================[ DEACTIVATE ACCOUNT ]=====================================================
      if(isset($_POST['deactive_btn']))
        {
          $id=$_POST['id2'];
          $userlevel=$_POST['userlevel2'];
          if ($userlevel != "Admin") {
            mysqli_query($open_connection,"UPDATE tbl_users SET status='DEACTIVATED' WHERE id=$id") or die(mysqli_error($open_connection)); 
          }else{
            echo"
            <script type='text/javascript'>
              alert('Cannot deactivate an Admin account!')
              open('user.php','_self');
              </script
            ";
          }
         
          
        }
      //==========================================================[ ACTIVATE ACCOUNT ]=====================================================
      if(isset($_POST['active_btn']))
        {
          $id=$_POST['id2'];
          $userlevel=$_POST['userlevel2'];
          
          mysqli_query($open_connection,"UPDATE tbl_users SET status='ACTIVE' WHERE id=$id") or die(mysqli_error($open_connection)); 
          
         
          
        }
    ?>
     <nav class="navbar navbar-default navbar-static-top" style="background-color: #7f0000;>
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
     
       <img id="logo-img" style="height: 100px;width:100px;" class="logo-img" src="Assets/Images/EC.png"/>
       <div style="margin-left: 100px;margin-top: -50px;">
       <H4 style="color:white;"> EC NEW DEAL GROCERY </H4>
       </div>
    </div>
    <div style="margin-top: 30px;margin-right: 20px;">


      <ul class="nav navbar-right">
        <!-- <li><a href="http://www.pingpong-labs.com" target="_blank">Visit Site</a></li> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" style="color:white;" data-toggle="dropdown" role="button" aria-expanded="false">
        
            Welcome, <?php echo "{$firstname} {$lastname}";?>
            <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li class="dropdown-header">SETTINGS</li>
              <li><a href="#" data-toggle="modal" data-target="#accountSettings"><i class="fa fa-user fa-fw"></i>Profile</li>
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
          <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
          <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
          <li><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
          <li><a href="inventory.php"><span class="fa fa-pie-chart"></span> Inventory</a></li>
          <li><a href="reports.php"><span class="fa fa-database"></span> Reports</a></li>
          <li><a href="orders.php"><span class="fa fa-list"></span> Orders</a></li>
          <li class="active"><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>

    </nav>

  </div>
</div>      
</div></ul>
      <div class="col-md-10 content">
          
                <div>
                <div class="panel panel-danger">
                <div class="panel-heading">
                    <span class="fa fa-user"></span>User Lists
                </div>
                <div class="panel-body">
                  <form method="POST">
   
                    
                    
                  </form>  
                      
                    <table class="table table-striped" style="font-size:14px;" id="myTable"> 
                      <thead>
                        <tr>
                          <th>Userlevel</th>
                          <th>Username</th>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th> Status </th>
                          <th>Actions</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_users WHERE userlevel!='Super Admin'") or die(mysqli_error($open_connection));
                          
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
                            $status_selected=$status
                            
                            ?>
                          <td style="text-align-last: center;">
                            <form method="POST">
                              <input type="hidden" name="id2" value="<?php echo $id;?>">
                              <input type="hidden" name="userlevel2" value="<?php echo $userlevel; ?>">
                              <a href="#viewModal<?php echo$i?>" class="btn btn-success btn-sm" title="View Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-eye"></i></a>
                              <a data-target="#editModal" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" data-id= <?php echo '[',$id_selected,',"',$userlevel_selected,'","',$username_selected,'","',$firstname_selected,'","',$lastname_selected,'","',$status_selected,'"]'; ?> ><i class="fa fa-pencil"></i></a>
                              
                              <?php 
                                if ($status == "DEACTIVATED") {
                                  echo "<button name='active_btn' id='active_btn' class='btn btn-primary btn-sm' type='submit'> <i class='fa fa-check'></i></button>";
                                  
                                }
                                elseif ($status == "ACTIVE") {
                                  echo "<button name='deactive_btn' id='deactive_btn' class='btn btn-danger btn-sm' type='submit'> <i class='fa fa-times'></i></button>";
                                }
                              ?>
                            </form>  
                          </td>
                          

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
                              <input type="text"  class="form-control" aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $firstname_selected?>" readonly style="background-color:white;" >
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
                           <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus"> </i> New Account</a>
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
                                      <option>Courier</option>
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
                   
                   

                  
        <footer class="footer" style="text-align: center;">
          <p class="col-md-12">
            <hr class="divider">
            Copyright &COPY; 2017 EC New Deal Grocery. All Rights Reserved.
          </p>
      </footer>
       </div>
                   
      
    </div>
    <!--==================================================================[ EDIT ACCOUNT ]==============================================================-->
                 <div id="editModal" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
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
                                    <select id="userlevel" name="userlevel" class="form-control" >
                                          
                                          <option value="Admin">Admin</option>
                                          <option value="Cashier">Cashier</option>
                                          <option value="Merchandiser">Merchandiser</option>
                                          <option value="Courier">Courier</option>
                                    </select>
                                  </div>
                                </div>
                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">User Name</span>

                              <input type="text" name="username"  class="form-control" aria-describedby="basic-addon1"  >

                            </div>
                            </div>

                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">First Name</span>
                              <input type="text" name="firstname" class="form-control" value="" onkeypress="return letter(event)">
                            </div>
                            </div>

                            <div class="col-sm-10" style="margin-top: 10px;">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                              <input type="text" name="lastname" class="form-control" aria-describedby="basic-addon1" value="" onkeypress="return letter(event)">
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
                    <script type="text/javascript">
                      $('#editModal').on('show.bs.modal', function(e) {
                          var Users = $(e.relatedTarget).data('id');
                          $(e.currentTarget).find('input[name="id"]').val( Users[0] );
                          $(e.currentTarget).find('select[name="userlevel"]').val( Users[1] );
                          $(e.currentTarget).find('input[name="username"]').val( Users[2]);
                          $(e.currentTarget).find('input[name="firstname"]').val( Users[3] );
                          $(e.currentTarget).find('input[name="lastname"]').val( Users[4] );
              
                        });
                    </script>

    <!-- ============================================================[ USER ACCOUNT SETTINGS ]==========================================================-->
      <!--Edit Users Modal -->
      <div  class="modal fade" id="accountSettings" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content modal-sm" style="margin-left:150px;">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Account Settings</h4>
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
                      <input type="text" name="username" value="<?php echo $usernames; ?>" class="form-control" style="margin-bottom: 10px;">
                      <label class="form-label">Old Password</label>
                      <input type="hidden" name="passwords" value="<?php echo $passwords; ?>">
                      <input type="password"  name="old_password" id="old_password" placeholder="Enter Old Password" class="form-control" aria-describedby="basic-addon1" >
                      <hr/>
                      <label>New Password</label>
                      <input type="password"  name="new_password" id="new_password" placeholder="Enter New Passoword" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                      <input type="password"  name="confirm_password" id="confirm_password" placeholder="Confirm Password" class="form-control" aria-describedby="basic-addon1" style="margin-bottom: 10px;">
                    </div>
                  </div> 
                  <div style="text-align: center;"><input type="submit" class="btn btn-success" name="btn_save_new_password"></div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php 
        if(isset($_POST['btn_save_new_password'])){
          $username = $_POST['username'];
          $passwords = $_POST['passwords'];
          $old_password = $_POST['old_password'];
          $new_password = $_POST['new_password'];
          $confirm_password = $_POST['confirm_password'];
          $UC = false;
          $LC = false;
          $NUM = false;
          if($passwords == $old_password){
            if($new_password == $confirm_password){
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
                $query1= mysqli_query($open_connection,"UPDATE tbl_users SET username='$username', password='$pass' WHERE id='$ids'") or die (mysqli_error($open_connection));
                echo "<script type='text/javascript'>alert('Password Successfully Change!');</script>";
              }
              else {
                echo "<script type='text/javascript'> alert ('Password must have at least an uppercase letter, a lowercase letter and a number! '); </script>";
              }
            }
            else{echo "<script type='text/javascript'>alert('NEW PASSWORD AND CONFIRM PASSWORD NOT THE SAME!');</script>";}
          }
          else{echo "<script type='text/javascript'>alert('incorrect old password!');</script>";}
        }
      ?>
  </body>
</html>