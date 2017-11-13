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
  if(isset($_POST['ProductEdit']))
    {

      $bc=$_POST['barcode'];  
      $pID=$_POST['productID'];    
      $pName=$_POST['ProductName'];
      $scat=$_POST['select_cat'];
      $supp=$_POST['supp'];
      $sp=$_POST['StandardPrice'];
      $lp=$_POST['ListPrice'];
      $PDesc=$_POST['Description'];
      $ds=$_POST['check_dis'];
      if ($ds == 'YES') {
        $disc = 1;
      }
      else{
        $disc = 0;
      }

      $getCat=mysqli_query($open_connection,"SELECT Category_ID FROM tbl_subcategory WHERE SCat_ID=$scat");
      while ($r=mysqli_fetch_array($getCat)) {
        $cat=$r['Category_ID'];
      }

      $storedFile="images/products/".basename($_FILES["file"]["name"]);
      if ($storedFile == "images/products/") {
        echo $n1="UPDATE tbl_products SET `barcode`='$bc',`product_name`='$pName',`Category_ID`=$cat,`SCat_ID`=$scat,`supplier_ID`=$supp,`standard_price`=$sp,`list_price`=$lp,`description`='$PDesc',`discontinue`=$disc WHERE product_ID=$pID";
        mysqli_query($open_connection,$n1); 
      }
      else{
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysqli_query($open_connection,"UPDATE tbl_products SET `barcode`='$bc',`product_name`='$pName',`Category_ID`=$cat,`supplier_ID`=$supp,`standard_price`=$sp,`list_price`=$lp,`Description`='$pDesc',`discontinue`=$disc,`image`='$storedFile' WHERE product_ID=$pID"); 
      }
     echo"
     <script type='text/javascript'>
        alert('Supplier informations updated!')
        open('product.php','_self');
      </script>
      ";


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

    </script>
    <script type="text/javascript">
      $(function(){
      $('#num').keypress(function(event) {
      var charCode = (event.which) ? event.which : event.keyCode

      if (
            (charCode != 45 || $(this).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(this).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;
        return true;
  });
});
      $(function(){
      $('#num2').keypress(function(event) {
      var charCode = (event.which) ? event.which : event.keyCode

      if (
            (charCode != 45 || $(this).val().indexOf('-') != -1) &&      // “-” CHECK MINUS, AND ONLY ONE.
            (charCode != 46 || $(this).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
            (charCode < 48 || charCode > 57))
            return false;
        return true;
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
 <div class="col-md-10 content">    

    <a href="product.php"><strong><span class="fa fa-shopping-bag"></span> Products</strong></a> <label> <span class="fa fa-caret-right"></span> </label> <a href="#"><strong><span class="fa fa-shopping-bag"></span> Edit Product</strong></a>
    <hr>  
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
                    $pDesc= $row1["description"];
                    $disc=$row1['discontinue'];
                    $img_display = $row1['image'];  
                  }
                }
              ?>
              <form class="form-signin" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <div class="row">
                            <input type="hidden" name="productID" value="<?php echo $id; ?>">
                          <div class="col-sm-12">
                            
                              <div class="col-sm-8">
                                <div class="col-md-6">
                              
                                <label>Barcode</label>
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)" value="<?php echo $bc; ?>">  
                              
                              <label>Product Name</label>   
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3" value="<?php echo $pn; ?>">
                                
                                 <label>Standard Price</label>
                                  <input type="text" class="form-control" id="num" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number3(event)" value="<?php echo $sp; ?>">
                                
                          </div>
                          <div class="col-md-6">
                              <label>Catergory</label>
                              <select class="form-control" name="select_cat" id="select_cat" tabindex="4" >
                                <option value="" disabled selected>Select Category</option>
                                  <?php 
                                    $display_cat=mysqli_query($open_connection,"SELECT * FROM tbl_category") or die(mysqli_error($open_connection));
                                    $i=1;
                                    while($row=mysqli_fetch_array($display_cat)){
                                      $Cat_ID=$row['Category_ID'];
                                      $Cat_Name=$row['Category_Name'];
                                  ?>
                                  <optgroup label="<?php echo $Cat_Name; ?>">
                                    <?php
                                      $display_scat=mysqli_query($open_connection,"SELECT * FROM tbl_subcategory WHERE Category_ID=$Cat_ID") or die(mysqli_error($open_connection)); 
                                      while ($row2=mysqli_fetch_array($display_scat)) {
                                        $SCat_ID=$row2['SCat_ID'];
                                        $SCat_Name=$row2['SubCategory_Name'];
                                      
                                    ?>
                                    <option value="<?php echo $SCat_ID; ?>" <?php if($SCat_ID == $sid){echo "selected";} ?> ><?php echo $SCat_Name; ?></option>  
                                    <?php } ?>
                                  </optgroup>
                                
                                <?php } ?>        
                              </select> 

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

                               <label >List Price</label>
                                <input type="text" class="form-control" id="num2" name="ListPrice" placeholder="List Price" tabindex="8" onKeyPress="return number3(event)" value="<?php echo $lp; ?>">
                              <br>
                            </div>

                            <div class="col-md-12">
                              <textarea name="Description" id="Description" cols="78" rows="6" style="resize: none;" class="form-control"><?php echo $pDesc; ?></textarea>
                            </div>


                              </div>
                            <div class="col-sm-4">
                              <div class="input-group" style="margin: auto;">
                                  <img src="<?php echo $img_display;?>" name="img_display" id="img_display"  style="width:200px;height:200px;">
                                  <br>
                                  <br>
                                  <input type="file" name="file">
                                  <input type="checkbox" name="check_dis" id="check_dis" value="YES" <?php if($disc == 1){ echo "checked";}?> ><label>Discontinued</label>
                                  <br>
                                  <br>
                                  
                                  <div style="margin-left:180px;margin-top: -10px;">
                                    
                                   <button type="submit" name="ProductEdit" class="btn btn-danger" tabindex="9">Save Changes</button>
                                  </div>
                                </div>      
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

            
          </script>      
</body>
</html>