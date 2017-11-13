
<?php error_reporting(0); ?>
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
      if(isset($_POST['update_supplier']))
      {
        $supplier_ID=$_POST['supplier_ID'];
        $supplier_name=$_POST['supplier_name'];    
        $Scontact_no=$_POST['Scontact_no'];
        $Semail=$_POST['Semail'];
       
        
      
  mysqli_query($open_connection,"UPDATE tbl_supplier SET supplier_name='$supplier_name',Scontact_no='$Scontact_no',Semail='$Semail'WHERE supplier_ID='$supplier_ID'") or die(mysqli_error($open_connection)); 
    
    echo "
<script type='text/javascript'>
        alert('Supplier informations updated!')
        open('supplier.php','_self');
      </script>

    ";
       }
        ?>

<?php 
 if(isset($_POST['deleteUser']))
    {
      $no=$_POST['id'];
        mysqli_query($open_connection,"DELETE from tbl_user WHERE id='$no'") or die(mysqli_error($open_connection));
        header("location:user.php");
    }


 
      if(isset($_POST['update_supplier']))
      {
        $supplier_ID=$_POST['supplier_ID'];
        $supplier_name=$_POST['supplier_name'];    
        $Semail=$_POST['Semail'];
        $Scontact_no=$_POST['Scontact_no'];
        
      
  mysqli_query($open_connection,"UPDATE tbl_supplier SET supplier_name='$supplier_name',Semail='$Semail',Scontact_no='$Scontact_no' WHERE supplier_ID='$supplier_ID'") or die(mysqli_error($open_connection)); 


  echo "<script type='text/javascript'>
            alert('One of the supplier's information is identical to another supplier!');
            </script>"; 
       }



    $con=mysqli_connect("localhost","root","","ecnd_db");
      if(isset($_POST['add_supplier']))
      {
       
        $supplier_name=$_POST['supplier_name'];    
        $Semail=$_POST['Semail'];
        $Scontact_no=$_POST['Scontact_no'];

        $selectquery="SELECT * FROM tbl_supplier WHERE supplier_name='$supplier_name'";
        $result=mysqli_query($con, $selectquery );

        $selectquery2="SELECT * FROM tbl_supplier WHERE Semail='$Semail' OR Scontact_no='$Scontact_no'";
        $result2=mysqli_query($con, $selectquery2);

        if (mysqli_num_rows($result)<=0) {
          if (mysqli_num_rows($result2)<=0){
            mysqli_query($open_connection,"INSERT into tbl_supplier(supplier_name,Semail,Scontact_no)VALUES('$supplier_name','$Semail','$Scontact_no')") or die(mysqli_error($open_connection)); 
      
            echo "<script type='text/javascript'>
                  alert('Supplier Added');
                  </script>";    
          }
          else{ 
            echo "<script type='text/javascript'>
            alert('One of the supplier's information is identical to another supplier!');
            </script>";  
          }
        
        }
        else{ 
          echo "<script type='text/javascript'>
          alert('Supplier Name already exists!');
          </script>";  
        }
      }

?>
<?php 
$ord=mysqli_query($open_connection,"SELECT *  FROM tbl_orders");
$myord=mysqli_num_rows($ord);
?>
<?php
$_SESSION['supplier_ID'] = $_POST['ses_supplier_ID'];
?>




<?php 
if(isset($_POST['view_products']))
    {
        echo "
         <script type='text/javascript'>
          open('view_product.php','_self');
          </script>
        ";

        
      }

?>
<?php 
if(isset($_POST['notify']))
    {
        $no=$_POST['ord_id'];
        mysqli_query($open_connection,"UPDATE tbl_custorder SET order_noti='0'") or die(mysqli_error($open_connection));
        header("location:orders.php");

        
      }

?>
<?php 
$ords=mysqli_query($open_connection,"SELECT *  FROM tbl_custorder where order_noti='1'");
$custord=mysqli_num_rows($ords);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Supplier</title>
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
    <link href="Assets/css/sweetalert.css" rel="stylesheet" />
   <script src="Assets/js/sweetalert.min.js"></script>

<script type="text/javascript">
/*function JSalert(){
swal("Here's the title!", "...and here's the text!");
}*/
</script>

    <script type="text/javascript">
      $(document).ready( function() {
      $('#myTable').DataTable({
        "order":[],
        "aoColumnDefs" : [ {
        "bSortable" : false,
        "aTargets" : [ "no-sort" ]}]
        
      });
    });
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
        
        <li class="active"><a href="supplier.php"><i class="fa fa-truck"></i> Suppliers</a></li>
        <li><a href="orders.php"><i class="fa fa-check-square-o"></i> Orders</a></li>
        <li><a href="customers.php"><i class="fa fa-address-book"></i> Customers</a></li>
        <li><a href="reports.php"><i class="fa fa-book"></i> Reports</a></li>
        <li><a href="users.php"><i class="fa fa-users"></i> User Management</a></li>
        <li><a href="myprofile.php"><i class="fa fa-id-badge"></i> Profile Settings</a></li>

    </ul>
</div><!-- /span-3 -->
<div class="col-lg-10">
    <!-- Right -->

    <a href="#"><strong><span class="fa fa-truck"></span> Suppliers</strong></a>
    <hr>
    <div class="col-sm-12"  style="margin-bottom:100px;">
  <div class="panel panel-danger">
    <div class="panel-heading"></div>
    <div class="panel-body">
      <div class="col-sm-12">
          <div class="col-sm-4" style="border-right:1px solid  #7f0000">
              <form method="post" class="form-horizontal">
                <div class="row">
                    <input type="hidden" name="supplier_id" id="supplier_id" class="form-control">

                    <div class="col-sm-12" style="margin-top: 10px;"> 
                      <h4 style="margin-top:-10px;">NEW SUPPLIER</h4>
                                  
                                    <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Supplier Name</span>
                                        <input type="text" name="supplier_name" id="supplier_name" class="form-control"   maxlength="20" placeholder="Supplier Name" required=""  >
                                   
                                  </div>
                                  </div>

                                     <div class="col-sm-12" style="margin-top: 20px;">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">Email Add  &nbsp &nbsp &nbsp&nbsp</span>
                                      <input type="email" name="Semail" id="Semail" class="form-control"  maxlength="50" placeholder="Email" required="">
                                    </div>
                                  </div>

                                     <div class="col-sm-12" style="margin-top: 20px;">
                                    <div class="input-group">
                                      <span class="input-group-addon" id="basic-addon1">Contact No &nbsp &nbsp&nbsp </span>
                                      <input type="text" name="Scontact_no" id="Scontact_no" class="form-control"  onKeyPress="return number(event)" maxlength="11" placeholder="Contact Number" required="">
                                    </div>
                                  </div>
                                    <input type="hidden" name="status" id="status" class="form-control">
                                    <div class="col-sm-12" style="margin-top: 20px;">
                                  <div class="input-group">
                                   <input type="submit" class="btn btn-danger btn-sm" name="add_supplier" value="Save Changes">
                                      
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
                          <th>Supplier name</th>
                          
                          <th>Contact No.</th>
                          <th>Email</th>
                          <th class="no-sort" >Actions</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          <?php 
                          $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_supplier") or die(mysqli_error($open_connection));
                          
                            $i=1;
                            while($row=mysqli_fetch_array($display_users)){
                              $supplier_ID=$row['supplier_ID'];
                              $supplier_name=$row['supplier_name'];

                              $Semail=$row['Semail'];
                              $Scontact_no=$row['Scontact_no'];
                            
                        ?>

                        <tr>
                          <td><?php echo $row['supplier_name']?></td>
                           <td><?php echo $row['Scontact_no']?> </td>
                          <td><?php echo $row['Semail']?></td>
                         

                          <?php
                           $supplier_ID_selected=$supplier_ID;  
                            $supplier_name_selected=$supplier_name;
                            $Semail_selected=$Semail;   
                            $Scontact_no_selected=$Scontact_no;
                            
                            ?>
                    
                         <td style="padding-left:0px;">
                          <form method="post" style="margin: 0px;">
                        
                            <a href="#editModal<?php echo$i?>" class="btn btn-danger btn-sm" title="Edit Menu" data-toggle="modal" data-id='"<?php echo $row['eid'];?>"'><i class="fa fa-pencil"></i></a>
                             
                              <input type="hidden" name="ses_supplier_ID" value="<?php echo $row['supplier_ID'] ?>">
                    <button type ="submit" name="view_products" class="btn btn-danger btn-sm" title="View Products"><span class="fa fa-shopping-bag"></span></button>
                   
                          
                   </form>
</td>              
</div> 
<!--========================================================[ Edit Users Modal ]==================================================-->
                  <div id="editModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                     <div class="modal-dialog" style="width: 480px;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Supplier Information</h4>
                            </div>
                        <div class="modal-body">
                          <div class="row">
                            <form method="post">            
                            <input type="hidden" name="supplier_ID" id="supplier_ID" class="form-control">
                            <input type="hidden"  name="supplier_ID"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_ID_selected?>" readonly >
                            
                                <div class="col-sm-12" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Supplier Name</span>
                                <input type="text" name="supplier_name"  class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_name_selected?>" onkeypress="return lenum(event)" >
                              </div>
                            </div>


                            <div class="col-sm-12" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Contact No.&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                                <input type="text" name="Scontact_no" class="form-control" aria-describedby="basic-addon1" value="<?php echo $Scontact_no_selected?>" onkeypress="return number(event)">
                              </div>
                            </div>

                            <div class="col-sm-12" style="margin-top: 10px;">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Email Address</span>
                                <input type="Email" name="Semail" class="form-control" aria-describedby="basic-addon1" value="<?php echo $Semail_selected?>"  onkeypress="return number(event)">
                              </div>
                            </div>
                           





                        </div>
                          </div>

                          <div class="modal-footer">
                          <button name="update_supplier" id="update_supplier" class="btn btn-success" type="submit" onclick="JSalert()">Update</button>   
                                 </form>
                              </div>
                            </div>
                          </div>
                        </div>

                        </tr>
                  <!--View Users Modal -->
              <div id="viewModal<?php echo$i?>" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                <div class="modal-dialog" style="width: 380px;">
                  <div class="modal-content">
                    <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Supplier Information</h4>
                            </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <div class="input-group">
                                <span class="input-group-addon" id="basic-addon1">Supplier Name</span>
                                  <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $supplier_name_selected ?>" readonly="" style="background-color:white;">
                              </div>
                            </div>

                                  <div class="form-group col-sm-12">
                                  <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">Contact&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                                    <input type="text" class="form-control" aria-describedby="basic-addon1" value="<?php echo $Scontact_no_selected ?>" readonly="" style="background-color:white;">
                                  </div>
                                  </div>



                          <div class="form-group col-sm-12">
                            <div class="input-group">
                              <span class="input-group-addon" id="basic-addon1">Email&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</span>
                              <input type="text"  class="form-control"  aria-describedby="basic-addon1"  value="<?php echo $Semail_selected?>" readonly="" style="background-color:white;">
                            </div>
                          </div>
                        </div>
                          </div>
                          <div style="padding:10px 0px 10px 160px">
                          <button data-dismiss="modal" aria-label="Close" class="btn btn-danger">Close</button>
                                 </form>
                              </div>
                            </div>
                          </div>
                        </div>


                        <?php $i++; }?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>


<!--========================================================[view products Modal ]==================================================-->
                  <div id="viewProduct" class="modal fade" tabindex="-1" role="dialog" hidden="true" aria-labelledby="myModalLabel">
                     <div class="modal-dialog modal-lg" >
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Products</h4>
                            </div>
                        <div class="modal-body">
                          <div class="row">
                            <form method="post">            
                            <input type="hidden" name="supplier_ID" id="supplier_ID" class="form-control">
                          
                           <div class="col-sm-1"></div>
                           <div class="col-sm-10">
                             <div class="table-responsive">
                             <table class="table table-hover">
                               <thead>
                                 <tr>
                                   <th>Name</th>
                                   <th>Barcode</th>
                                   <th>Standard Price</th>
                                   <th>List Price</th>
                                 </tr>
                               </thead>
                               <tbody>
                                  <?php 
                          $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_products") or die(mysqli_error($open_connection));
                          
                            $i=1;
                            while($row=mysqli_fetch_array($display_users)){
                              $supplier_ID=$row['supplier_ID'];
                                $product_name=$row['product_name'];
                                $barcode=$row['barcode'];
                                $standard_price=$row['standard_price'];
                                $list_price=$row['list_price'];
                             
                            
                        ?>
                               </tbody>
                                <tr>
                                  <td><?php echo $product_name ?></td>
                                  <td><?php echo $barcode ?></td>
                                  <td><?php echo $standard_price ?></td>
                                  <td><?php echo $list_price ?></td>
                                </tr>
                                <?php } ?>
                             </table>
                           </div>
                           </div>
                           <div class="col-sm-1"></div>




                        </div>
                          </div>

                          </form>
                            </div>
                          </div>
                        </div>            
                   



    </div>
  </div>
</div>

 
<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container" ">
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