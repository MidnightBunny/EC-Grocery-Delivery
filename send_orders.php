<?php 
  include 'connection.php';
  session_start();
  error_reporting(E_ERROR | E_WARNING | E_PARSE);
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
  //=========================================================[ EDIT PRODUCT ]========================================================
  if(isset($_POST['Saveorders']))
    {

      $bc=$_POST['barcode'];  
      $pID=$_GET['product_ID'];    
      $pName=$_POST['ProductName'];
      $supp=$_POST['supp'];
      $sp=$_POST['StandardPrice'];
      $PDesc=$_POST['Description'];
      $unit=$_POST['unit'];
      $qty=$_POST['qty'];
      $total=$_POST['total2'];
      if ($ds == 'YES') {
        $disc = 1;
      }
      else{
        $disc = 0;
      }


      
    $test="INSERT INTO `tbl_orders`(`product_id`, `barcode`, `product_name`, `supplier_ID`, `standard_price`,`unit`, `quantity`, `total`) VALUES ($pID,'$bc','$pName',$supp,$sp,$unit,$qty,$total)";
    mysqli_query($open_connection,$test);

      echo "<script type='text/javascript'>
        alert('Successfully saved!')
      </script>";
      header("location:product.php");
    }

  ?>
  <?php 
if(isset($_POST['notify']))
    {
        $no=$_POST['ord_id'];
        mysqli_query($open_connection,"UPDATE tbl_custorder SET order_noti='0'") or die(mysqli_error($open_connection));
        header("location:orders.php");   
      }


$ord=mysqli_query($open_connection,"SELECT *  FROM tbl_orders");
$myord=mysqli_num_rows($ord);

$ords=mysqli_query($open_connection,"SELECT *  FROM tbl_custorder where order_noti='1'");
$custord=mysqli_num_rows($ords);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <link href="assets/images/ec.png" rel="icon" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="Assets/css/panel.css" />
    <script type="text/javascript" src="Assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">

    $(document).ready( function() {
      $('#myTable').DataTable({
        "aoColumnDefs" : [ {
        "bSortable" : false,
        "aTargets" : [ "no-sort" ]}]
        
      });
    });

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
        <li class="active"><a href="product.php"><i class="fa fa-shopping-bag"></i> Products</a></li>
        <li><a href="supplier.php"><i class="fa fa-truck"></i> Suppliers</a></li>
        <li><a href="orders.php"><i class="fa fa-check-square-o"></i> Orders</a></li>
        <li><a href="customers.php"><i class="fa fa-address-book"></i> Customers</a></li>
        <li><a href="reports.php"><i class="fa fa-book"></i> Reports</a></li>
        <li><a href="users.php"><i class="fa fa-users"></i> User Management</a></li>
        <li><a href="myprofile.php"><i class="fa fa-id-badge"></i> Profile Settings</a></li>

    </ul>
</div><!-- /span-3 -->
<a href="product.php"><strong><span class="fa fa-shopping-bag"></span> Inventory</strong></a> <label> <span class="fa fa-caret-right"></span> </label> <a href="#"><strong><span class="fa fa-refresh"></span> Orders</strong></a>
    <hr>
 <div class="col-md-10 content">      
        <div>
          <div class="panel panel-danger">
            <div class="panel-heading">
            
            </div>
            <div class="panel-body">
              <?php 
                if (isset($_GET['product_ID'])) {
                  $id=$_GET['product_ID'];
                  $sql="SELECT * FROM tbl_products WHERE product_ID=$id";
                  $b=mysqli_query($open_connection,$sql);
                  while($row1=mysqli_fetch_array($b)){
                    $bc=$row1['barcode'];
                    $pn=$row1['product_name'];
                    $cid=$row1['Category_ID'];
                    $cn=$row1['Category_Name'];
                    $sid=$row1['SCat_ID'];
                    $scn=$row1['SubCategory_Name'];
                    $suid=$row1['supplier_ID'];
                    $sn=$row1['supplier_name'];
                    $sp=$row1['standard_price'];
                    $lp=$row1['list_price'];
                    $quantity=$row1["quantity"];
                    $disc=$row1['discontinue'];
                    $img_display = $row1['image'];  
                  }
                }
              ?>
              <form class="form-signin" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="col-sm-2">
                        <img src="<?php echo $img_display;?>" name="img_display" id="img_display"  style="width:150px;height:150px;">
                      </div>
                      <div class="col-sm-4">
                        <label>Barcode</label>
                          <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)" value="<?php echo $bc; ?>">  
                        <br>
                        <label>Quantity</label>
                          <input type="text" class="form-control" id="qty" name="qty" placeholder="Quantity" onKeyPress="return number(event)" value="<?php echo $quantity;?>" min="<?php echo $quantity;?>"> 
                          <input type="hidden" id="qty2" name="qty2" value="<?php echo $quantity;?>" >         
                            
                      </div>
                      <div class="col-sm-4">
                        <label>Product Name</label>   
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3" value="<?php echo $pn; ?>">
                        <br>
                        <label>Supplier</label>
                              <select class="form-control" id="supp" name="supp" tabindex="6">
                                <option value="" disabled selected>Select Supplier</option>
                                  <?php 
                                    $display_supplier=mysqli_query($open_connection,"SELECT * FROM tbl_supplier") or die(mysqli_error($open_connection));
                                    $i=1;
                                    while($row=mysqli_fetch_array($display_supplier)){
                                      $Supplier_ID=$row['supplier_ID'];
                                      $Supp_Name=$row['supplier_name'];
                                  ?>
                                <option value="<?php echo $Supplier_ID; ?>" <?php if ($Supplier_ID==$suid) { echo "selected";}?> ><?php echo $Supp_Name; ?></option>
                                  <?php } ?> 
                              </select>
                      </div>
                      <div class="col-sm-2">
                        <label>Standard Price</label>
                                <input type="text" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number3(event)" step="any" value="<?php echo $sp; ?>">
                      </div>
                    </div>


                  </div>
              
              <hr>

              <div class="col-sm-12" style="padding-bottom: 30px;">
                <div class="col-sm-12">
                  <div class="col-sm-1"> <label># of Units</label></div>
                  <div class="col-sm-4"> <input type="text" class="form-control" id="unit" name="unit" placeholder="Units" onkeypress="return number(event)" onkeyup="A()"></div>

                   <div class="col-sm-7">
                                    <div class="input-group" style="height:70px;">
                                    <span class="input-group-addon" id="basic-addon1"  style="background-color:#7f0000;color:white;border: 1px solid #7f0000"><label style="font-size: 25px;">TOTAL</label></span>
                                        <input type="text" class="form-control" id="total" name="total" tabindex="8" onKeyPress="return number(event)" disabled="" style="border: 1px solid #7f0000;background-color:white;height:70px; font-size: 45px;">
                                        <input type="hidden" name="total2" id="total2">
                                    </div>
                                    </div>
                </div>
              
              </div>  


                                <div style="padding-top:30px;">
                                  <button type="submit" name="Saveorders" id="Saveorders" class="btn btn-danger" tabindex="9">Save Changes</button>
                                </div>
                                </form>                             
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
     <!-- =================================[ SCRIPTS ]=========================-->   
        <script type="text/javascript">
           $('input,select').on('keypress', function (e) {
              if (e.which == 13) {
                  e.preventDefault();
                  var $next = $('[tabIndex=' + (+this.tabIndex + 1) + ']');
                  console.log($next.length);
                  if (!$next.length) {
                      $next = $('[tabIndex=1]');
                  }
                  $next.focus();
              }
          });
        </script>
        <script type="text/javascript">
            $('#editModal').on('show.bs.modal', function(e) {
              var Users = $(e.relatedTarget).data('id');
              $(e.currentTarget).find('input[name="productID"]').val( Users[0] );
              $(e.currentTarget).find('input[name="barcode"]').val( Users[1] );
              $(e.currentTarget).find('input[name="ProductName"]').val( Users[2]);
              $(e.currentTarget).find('select[name="select_cat"]').val( Users[3] );
            

              $(e.currentTarget).find('select[name="supp"]').val( Users[5] );
              if (Users[6] == 1) {
                document.getElementById("check_dis").checked = true;  
              }
              else{
                document.getElementById("check_dis").checked = false;
              }
              
              
              $(e.currentTarget).find('input[name="StandardPrice"]').val( Users[7] );
              $(e.currentTarget).find('input[name="ListPrice"]').val( Users[8] );
              var src1 = Users[9];
              $("#img_display").attr("src",src1);
              


            });

            function A(){
              var w = document.getElementById("unit").value;
              var x = document.getElementById("qty2").value;
              var y = document.getElementById("StandardPrice").value;
              var z = w*y;
              if (w == 0) {
                document.getElementById("qty").value = x;  
              }
              else
                document.getElementById("qty").value = x*w;
              
              document.getElementById("total").value = z.toFixed(2);
              document.getElementById("total2").value = z.toFixed(2); 
            }
          </script>      
</body>
</html>