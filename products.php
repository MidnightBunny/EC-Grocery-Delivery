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
        }
  else{
          header("location:dashboard.php");
      } 
  //=========================================================[ ADD PRODUCT ]============================================================
  if(isset($_POST['ProductSubmit']))
    {
      $bc=$_POST['barcode'];    
      $pName=$_POST['ProductName'];
      $cat=$_POST['select_cat'];
      $scat=$_POST['radio_sc2'];
      $supp=$_POST['supp'];
      $sp=$_POST['StandardPrice'];
      $lp=$_POST['ListPrice'];

      $quantity=$_POST['quantity'];
      $disc = 0;
      $storedFile="images/products/".basename($_FILES["file"]["name"]);
      move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
      mysqli_query($open_connection,"INSERT into tbl_products(`barcode`, `product_name`, `Category_ID`, `SCat_ID`, `supplier_ID`, `standard_price`, `list_price`, `discontinue`, `image`,`quantity`)VALUES('$bc','$pName','$cat','$scat','$supp',$sp,$lp,$disc,'$storedFile','$quantity')") or die(mysqli_error($open_connection));
      $id=mysqli_insert_id('$id');

      mysqli_query($open_connection,"INSERT into tbl_inventory(product_ID) VALUES($id)") or die(mysqli_error($open_connection));  
    }
  //=========================================================[ EDIT PRODUCT ]============================================================
  if(isset($_POST['ProductEdit']))
    {
      $bc=$_POST['barcode'];  
      $pID=$_POST['productID'];    
      $pName=$_POST['ProductName'];
      $cat=$_POST['select_cat'];
      $scat=$_POST['radio_sc'];
      $supp=$_POST['supp'];
      $sp=$_POST['StandardPrice'];
      $lp=$_POST['ListPrice'];
      $ds=$_POST['check_dis'];
      if ($ds == 'YES') {
        $disc = 1;
      }
      else{
        $disc = 0;

      }
      $storedFile="images/products/".basename($_FILES["file"]["name"]);
      if ($storedFile == "images/products/") {
        mysqli_query($open_connection,"UPDATE tbl_products SET `barcode`='$bc',`product_name`='$pName',`Category_ID`=$cat,`supplier_ID`=$supp,`standard_price`=$sp,`list_price`=$lp,`discontinue`=$disc WHERE product_ID=$pID"); 
      }
      else{
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysqli_query($open_connection,"UPDATE tbl_products SET `barcode`='$bc',`product_name`='$pName',`Category_ID`=$cat,`supplier_ID`=$supp,`standard_price`=$sp,`list_price`=$lp,`discontinue`=$disc,`image`='$storedFile' WHERE product_ID=$pID"); 
      }
    }
?>
<!DOCTYPE html>
<html>
 <head>

    <title>Product</title>

    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="Assets/js/jquery-1.10.2.min.js"></script>
    <!-- Sources -->
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="Assets/bootstrap/css/admin_style.css"/>
    <link rel="stylesheet" href="Assets/bootstrap/css/bootstrap.css"/>
     <link rel="stylesheet" href="Assets/css/nav.css"/> 
    <script src="Assets/js/admin_style.js"></script>
     <link rel="stylesheet" href="Assets/css/nav.css"/> 
    <script src="Assets/bootstrap/js/jquery.min.js"></script>
    <script src="Assets/bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/shieldui-all.min.js"></script>
    <script type="text/javascript" src="js/gridData.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="DataTables/css/jquery.dataTables.min.css" />

    <script type="text/javascript" src="DataTables/js/jquery.dataTables.min.js"></script>   
    <script type="text/javascript" src="DataTables/js/dataTables.bootstrap.min.js"></script>  
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
      function showCat(str) {
          if (str == "") {

              return;
          } else { 
              if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("txtHint").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET","getcategory1.php?q="+str,true);
              xmlhttp.send();
          }
      }

      function showUser2(str) {
          if (str == "") {
              document.getElementById("txtHint2").innerHTML = "";
              return;
          } else { 
              if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("txtHint2").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET","getcategory2.php?q="+str,true);
              xmlhttp.send();
          }
      }

      function showUser2(str) {
          if (str == "") {
              document.getElementById("txtHint2").innerHTML = "";
              return;
          } else { 
              if (window.XMLHttpRequest) {
                  // code for IE7+, Firefox, Chrome, Opera, Safari
                  xmlhttp = new XMLHttpRequest();
              } else {
                  // code for IE6, IE5
                  xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
              }
              xmlhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                      document.getElementById("txtHint2").innerHTML = this.responseText;
                  }
              };
              xmlhttp.open("GET","getcategory2.php?q="+str,true);
              xmlhttp.send();
          }
      }

      // Keypress

     
    
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
                if ((("0123456789.").indexOf(keychar) > -1))
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
                    
                $("StandardPrice").keypress(function(event) {
                    if(event.which == 8 || event.which == 0){
                    return true;
                      }
                    if(event.which < 46 || event.which > 59) {
                    return false;
                    //event.preventDefault();

                    }              
                     // prevent if not number/dot
    
    if(event.which == 46 && $(this).val().indexOf('.') != -1) {
        return false;
        //event.preventDefault();
    } // prevent if already dot
});

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

    <script type="text/javascript">
      
    </script>

    </head>
  

  <body>

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
                <li><a href="#" data-toggle="modal" data-target="#accountSettings"><i class="fa fa-user fa-fw"></i>Profile</li>
               
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
                <ul class="nav navbar-nav" >
                  <li ><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                  <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
                  <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
                  <li class="active"><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
                  <li><a href="inventory.php"><span class="fa fa-pie-chart"></span> Inventory</a></li>
                  <li><a href="reports.php"><span class="fa fa-database"></span> Reports</a></li>
                  <li><a href="orders.php"><span class="fa fa-list"></span> Orders</a></li>
                  <li><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
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
              <span class="fa fa-shopping-bag"></span>Products
            </div>
            <div class="panel-body">
              <form method="POST">
                    
              </form>
              <table class="table table-striped" style="font-size:14px;" id="myTable"> 
                <thead>
                  <tr>
                    <th>Barcode</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Supplier</th>
                    <th>Standard Price</th>
                    <th>List Price</th>
                    <th>Status</th>
                    <th class="no-sort">Actions</th>
                    
                  </tr>
                </thead>
                <tr>
                <?php 

                       $sql_display="SELECT product_ID,barcode,product_name,p.Category_ID,Category_Name,p.SCat_ID,SubCategory_Name,s.supplier_ID,supplier_name,standard_price,list_price,discontinue,image FROM tbl_products p INNER JOIN tbl_category USING(`Category_ID`) INNER JOIN tbl_subcategory USING (`SCat_ID`) Inner JOIN tbl_supplier s USING (`supplier_ID`) ORDER BY product_ID ASC";

                          $display_users=mysqli_query($open_connection,$sql_display) or die(mysqli_error($open_connection));
                            
                            while($row=mysqli_fetch_array($display_users)){
                              $id = $row['product_ID'];
                              $bc=$row['barcode'];
                              $pn=$row['product_name'];
                              $cid=$row['Category_ID'];
                              $cn=$row['Category_Name'];
                              $sid=$row['SCat_ID'];
                              $scn=$row['SubCategory_Name'];
                              $suid=$row['supplier_ID'];
                              $sn=$row['supplier_name'];
                              $sp=$row['standard_price'];
                              $lp=$row['list_price'];
                              $disc=$row['discontinue'];
                              $img_display = $row['image'];                        
                        ?>
                
                  <td><?php echo $bc; ?></td>
                  <td><?php echo $pn; ?></td>
                  <td><?php echo $cn; ?></td>
                  <td><?php echo $scn; ?></td>
                  <td><?php echo $sn; ?></td>
                  <td><?php echo $sp; ?></td>
                  <td><?php echo $lp; ?></td>
                  <td><?php if ($disc == 0) {echo "Available";}else{echo "Discontinued";}  ?></td>
                  <?php //$test = json_encode(array("a"=>$id,"b"=>$bc,"c"=>$pn,"d"=>$cn,"e"=>$scn,"f"=>$sp,"g"=>$lp,"h"=>$disc,"i"=>$img_display)); ?>
                  <?php $test = '['.$id.',"'.$bc.'","'.$pn.'",'.$cid.','.$sid.','.$suid.','.$disc.','.$sp.','.$lp.',"'.$img_display.'"]'; ?>
                  <td>
                    <div class="col-md-12" style="padding:0px;">
                      <div class="col-md-6">
                        <a data-target="#viewModal<?php echo $id; ?>" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" ><i class="fa fa-eye"></i></a>
                      </div>
                      <div class="col-md-6">
                        <a href="editproduct.php?product_ID=<?php echo $id; ?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                      </div>  
                    </div>
                   
                  </td>
                </tr>
    
              <div id="viewModal<?php echo $id; ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Product Information</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-signin" method="post" enctype="multipart/form-data">

                     <img src="<?php echo $img_display; ?>" style="width:200px;height:200px;margin-left: 200px;">  
                     <hr>
                      <div class="row">
                    <div class="col-md-6" style="margin-bottom: 10px;">
                          <div class="input-group">
                              <span class="input-group-addon">Name</span>  
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3" value="<?php echo $pn; ?>" style="background-color:white;" readonly>
                          </div>
                        </div>

                       <div class="col-md-6" style="margin-bottom: 10px;">
                          <div class="input-group">
                              <span class="input-group-addon">Category</span>
                              <input type="text" class="form-control" name="c_name" value="<?php echo $cn; ?>" style="background-color:white;" readonly>    
                          </div>
                        </div>

                       <div class="col-md-6" style="margin-bottom: 10px;">
                         <div class="input-group">
                              <span class="input-group-addon">Sub-Category</span>
                              <input type="text" class="form-control" name="sc_name" value="<?php echo $scn; ?>" style="background-color:white;" readonly>    
                          </div>
                        </div>

                        <div class="col-md-6" style="margin-bottom: 10px;">
                         <div class="input-group">
                              <span class="input-group-addon">Supplier</span>
                              <input type="text" class="form-control" name="sc_name" value="<?php echo $sn; ?>" style="background-color:white;" readonly>       
                          </div>
                        </div>

                        <div class="col-md-6" style="margin-bottom: 10px;">
                         <div class="input-group">
                            <span class="input-group-addon"> Standard Price</span>
                              <input type="text" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" value="<?php echo $sp; ?>" style="background-color:white;" readonly>    
                          </div>
                        </div>

                        <div class="col-md-6" style="margin-bottom: 10px;">
                         <div class="input-group">
                              <span class="input-group-addon">List Price</span>
                                <input type="text" class="form-control" id="ListPrice" name="ListPrice" placeholder="List Price" tabindex="8" value="<?php echo $lp; ?>" style="background-color:white;" readonly>
                          </div>  
                        </div>

                      </form>
                      </div>
                      
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div> 
              </div>
                   


                          <?php } ?>
                        </table>
                      </div>
                      <div class="panel-footer">
                        <div class="row">
                          <div class="col-md-6">
                            <button type="button" class="btn btn-success" title="Add Product" data-toggle="modal" data-target="#AddProduct">Add Product</button>
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
    <!--===================================[ MODALS BELOW ]==============================================-->

    <!--===================================[ ADD PRODUCT ]==============================================-->
    <div id="AddProduct" class="modal fade" role="dialog">
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
                   <div class="col-md-6" style="margin-bottom: 20px;">
                    <div class="input-group">
                      <label for="Category">Barcode (Optional)</label>
                      <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)">  
                    </div>  

                    </div>

                    <div class="col-md-6">
                      <label>Product Image</label>
                      <input type="file" name="file" id="image" class="form-control" placeholder="Image" required>

                    </div>

                    </div>
                    <div class="row">
                   <div class="col-md-6"> 
                 <div class="input-group">
                 <span class="input-group-addon" id="basic-addon1">Product Name&nbsp</span>
                       
                      <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3">
                    </div>
                    </div>

                     <div class="col-md-6" style="margin-bottom: 20px;"> 
                 <div class="input-group">
                 <span class="input-group-addon" id="basic-addon1">Category</span>

                    <select class="form-control" name="select_cat" id="select_cat" tabindex="4" onchange="showUser2(this.value)">
                      <option value="" disabled selected>Select Category</option>
                        <?php 
                          $display_cat=mysqli_query($open_connection,"SELECT * FROM tbl_category") or die(mysqli_error($open_connection));
                          $i=1;
                          while($row=mysqli_fetch_array($display_cat)){
                            $Cat_ID=$row['Category_ID'];
                            $Cat_Name=$row['Category_Name'];
                        ?>
                      <option value="<?php echo $Cat_ID; ?>"><?php echo $Cat_Name; ?></option>
                      <?php } ?>        
                    </select>     
                  </div>

                 </div>
                 </div>
                 <div class="row">
                 
                <div class="col-md-6"> 
                 <div class="input-group">
                 <span class="input-group-addon" id="basic-addon1">Supplier Name</span>

                    <select class="form-control" id="supp" name="supp" tabindex="6">
                      <option value="" disabled selected>Select Supplier</option>
                        <?php 
                          $display_supplier=mysqli_query($open_connection,"SELECT * FROM tbl_supplier") or die(mysqli_error($open_connection));
                          $i=1;
                          while($row=mysqli_fetch_array($display_supplier)){
                            $Supplier_ID=$row['supplier_ID'];
                            $Supp_Name=$row['supplier_name'];
                        ?>
                      <option value="<?php echo $Supplier_ID; ?>"><?php echo $Supp_Name; ?></option>
                        <?php } ?> 
                    </select>     
                 </div>
                 </div>
                 <div class="col-md-6" style="margin-bottom: 20px;"> 
                 <div class="input-group">
                 <span class="input-group-addon" id="basic-addon1">Quantity&nbsp</span>
                  <input type="text" name="quantity" id="quantity" class="form-control"  
                  onKeyPress="return number2(event)"  maxlenght="50" placeholder="Quantity Per Unit" required="">
                    </div>
                  </div>

                 </div>
                  <div class="row">
                    <div class="col-md-6"> 
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Standard Price</span>
                      <input type="text" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number2(event)">
                    </div>
                    </div>
                    <div class="col-md-6"> 
                    <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">List Price</span>
                    <input type="text" class="form-control" id="ListPrice" name="ListPrice" placeholder="List Price" tabindex="8" onKeyPress="return number2(event)">
                    </div>         
                    </div>
                    </div>
                    

                
                </div>
              
            </form>
          </div>
          <div class="modal-footer">
           <button type="submit" name="ProductSubmit" class="btn btn-success" tabindex="9">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div> 

    </div>
    <!-- ============================================================[ USER ACCOUNT SETTINGS ]==========================================================-->
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

          $('#StandardPrice').keypress(function(event) {
    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
}).on('paste', function(event) {
    e
         </script>       
  </body>
</html>