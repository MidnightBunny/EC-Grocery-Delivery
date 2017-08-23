<?php include 'connection.php';?>
<?php
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
<?php 
      if(isset($_POST['update_supplier']))
      {
        $supplier_ID=$_POST['supplier_ID'];
        $supplier_name=$_POST['supplier_name'];    
        $address=$_POST['address'];
        $contact_no=$_POST['contact_no'];
        
      
  mysql_query("UPDATE tbl_supplier SET supplier_name='$supplier_name',address='$address',contact_no='$contact_no' WHERE supplier_ID='$supplier_ID'") or die(mysql_error()); 
  header("location:supplier.php");
       }
        ?>
<!--Add Users -->
    <?php
      if(isset($_POST['add_supplier']))
      {
        $supplier_ID=$_POST['supplier_ID'];
        $supplier_name=$_POST['supplier_name'];    
        $address=$_POST['address'];
        $contact_no=$_POST['contact_no'];
      

  mysql_query("INSERT into tbl_supplier VALUES('$supplier_ID','$supplier_name','$address','$contact_no')") or die(mysql_error()); 
  header("location:supplier.php");
   }

    ?>
     
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
<!DOCTYPE html>
<html>
 <head>
    <title>Supplier</title>
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
 <nav class="navbar navbar-default navbar-static-top" style="background-color: #7f0000;>
<!-- -->
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
                <li class="active"><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
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
                    <span class="glyphicon glyphicon-list"></span>Supplier
                </div>
                <div class="panel-body">
                  <form method="POST">
                    <input type="text" name="search">
                    <button class="btn btn-primary fa fa-search" name="btn_search"></button>
                    <button class="btn btn-success" name="btn_reset">Show All</button>
                  </form>

                  <table class="table table-stripped table-hover">
                      <thead>
                        <tr>

                          <th>Supplier Name</th>
                          <th>Address</th>
                          <th>Contact No.</th>

                          <th>View</th>
                          <th>Edit</th>
                          
                        </tr>
                      </thead>

                       <tbody>
                        <?php 
                          $display_users=mysql_query("SELECT * FROM tbl_supplier") or die(mysql_error());
                          if (isset($_POST['btn_search']) ) {
    
                              $s = $_POST['search'];
                              $display_users=mysql_query("SELECT * FROM tbl_supplier WHERE supplier_name LIKE '%{$s}%'") or die(mysql_error());  
                          }
                          elseif (isset($_POST['btn_reset'])) {
                            $display_users=mysql_query("SELECT * FROM tbl_supplier") or die(mysql_error());
                          }
                              
                          
                            $i=1;
                            while($row=mysql_fetch_array($display_users)){
                              $supplier_ID=$row['supplier_ID'];
                              $supplier_name=$row['supplier_name'];
                              $address=$row['address'];
                              $contact_no=$row['contact_no'];
                        
                        ?>

                        <tr>
                          <td><?php echo $row['supplier_name']?></td>
                          <td><?php echo $row['address']?></td>
                          <td><?php echo $row['contact_no']?></td>

                           <?php
                            $supplier_ID_selected=$supplier_ID;  
                            $supplier_name_selected=$supplier_name;
                            $address_selected=$address;         
                            $contact_no_selected=$contact_no;
                          
                            ?>
                   
                           <td>
                           <a href="#viewModal<?php echo$i?>" class="btn btn-success btn-sm" title="View Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-eye"></i></a></td>
                          <td>
                          <a href="#editModal<?php echo$i?>" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-pencil"></i></a>
                          </td>        

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
                            <input type="hidden" name="supplier_ID" id="supplier_ID" class="form-control">
                            <input type="hidden"  name="supplier_ID"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_ID_selected?>" readonly >

                            <div class="col-sm-10" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">User Name</span>
                                <input type="text" name="supplier_name"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_name_selected?>" >
                              </div>
                            </div>

                            <div class="col-sm-10" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Address</span>
                                <input type="text"  name="address"  class="form-control" aria-describedby="basic-addon1"  value="<?php echo $address_selected?>" >
                              </div>
                            </div>

                          
                            <div class="col-sm-10" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Contact No.</span>
                                <input type="text" name="contact_no" class="form-control" aria-describedby="basic-addon1" value="<?php echo $contact_no_selected?>" >
                              </div>
                            </div>
                            
                            <div class="row">
                              <div class="col-sm-10">
                                <div class="modal-footer">
                                  <button name="update_supplier" id="update_supplier" class="btn btn-success" type="submit">Update</button>
                                  
                                </div> 
                              </div>
                            </div>  
                          </form>              
                        </div>
                      </div>
                    </div>
                  </div>
                            
                 <!--View Users Modal -->
                  <div id="viewModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">User information</h4>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-sm-7">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Supplier Name</span>
                                  <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_name_selected ?>" readonly="" style="background-color:white;">
                              </div>
                            </div>

                                  <div class="form-group col-sm-7">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">User Level</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $address_selected ?>" readonly="" style="background-color:white;">
                                  </div>
                                  </div>
                          


                          <div class="form-group col-sm-7">
                            <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">Last Name</span>
                            <input type="text"  class="form-control"  aria-describedby="basic-addon1" onKeyPress="return letter(event)" value="<?php echo $contact_no_selected?>" readonly="" style="background-color:white;">
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

                          </div>

                        </section>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add Supplier</button>
                        </div>
                    </div>
                </div>
            </div>
                </div>
  
</div>
      </div>

      <div class="modal fade" id="addModal" tabindex="-1" role="dialog" >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Account Information</h4>
                            <div class="modal-body" >
                              <form method="post" class="form-horizontal">
                                <div class="row">
                                
                                  <input type="hidden" name="supplier_id" id="supplier_id" class="form-control">
                                     
                                  

                                   <div class="col-sm-10" style="margin-top: 10px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Supplier Name</span>
                                        <input type="text" name="supplier_name" id="supplier_name" class="form-control"  onKeyPress="return letter(event)" maxlength="20" placeholder="Supplier Name" required="">
                                    </div>
                                    </div>

                                    <div class="col-sm-10" style="margin-top: 10px;">
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Address</span>
                                        <input type="text" name="address" id="address" class="form-control"  onKeyPress="return letter(event)" maxlenght="50" placeholder="Address" required="">
                                    </div>
                                    </div>
                           
                                  
                                  <div class="col-sm-10" style="margin-top: 10px;">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Contact No.</span>
                                        <input type="text" name="contact_no" id="contact_no" class="form-control"  onKeyPress="return number(event)" maxlength="11" placeholder="Contact Number" required="">
                                    </div>
                                    </div>

                                    
                                    </div>

                                   <div class="row" style="margin-top: 20px;">
                                   <div class="col-sm-10">
                                      <input type="submit" class="btn btn-success" name="add_supplier" value="Save Changes">
                                      <input type="reset" class="btn btn-default" value="Clear">
                                    </div>
                                    </div>
                                  </div>

                                     
                                </form>
                            </div>
                        </div>
                      </div>

                    </div>  

                    <!-- USER ACCOUNT SETTINGS-->
                  <?php include 'connection.php'?>
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
    </div>  
  </body>
</html>