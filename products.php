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
  //=========================================================[ ADD PRODUCT ]============================================================
    if(isset($_POST['ProductSubmit']))
       {
        $bc=$_POST['barcode'];    
        $pName=$_POST['ProductName'];
        $cat=$_POST['select_cat'];
        $scat=$_POST['radio_sc'];
        $supp=$_POST['supp'];
        $sp=$_POST['StandardPrice'];
        $lp=$_POST['ListPrice'];
        $disc = 0;
        $storedFile="images/products/".basename($_FILES["file"]["name"]);
        move_uploaded_file($_FILES["file"]["tmp_name"], $storedFile);
        mysql_query("INSERT into tbl_products(`barcode`, `product_name`, `Category_ID`, `SCat_ID`, `supplier_ID`, `standard_price`, `list_price`, `discontinue`, `image`)VALUES('$bc','$pName','$cat','$scat','$supp',$sp,$lp,$disc,'$storedFile')") or die(mysql_error()); 
        

      }
?>
<!DOCTYPE html>
<html>
 <head>
  	<title>Dashboard</title>
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
    <script>
      function showUser(str) {
          if (str == "") {
              document.getElementById("txtHint").innerHTML = "";
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
              xmlhttp.open("GET","getcategory.php?q="+str,true);
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
        function number3(e) 
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
                  <li ><a href="dashboard.php"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a></li>
                  <li><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
                  <li><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
                  <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
                  <li class="active"><a href="products.php"><span class="fa fa-shopping-bag"></span> Items</a></li>
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
              <span class="glyphicon glyphicon-list"></span>Products
            </div>
            <div class="panel-body">
              <table class="table table-stripped table-hover">
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
                    <th>View</th>
                    <th>Edit</th>
                  </tr>
                </thead>
                <tr>
                <?php 
                          $sql_display="SELECT product_ID,barcode,product_name,Category_Name,SubCategory_Name,supplier_name,standard_price,list_price,discontinue,image FROM `tbl_products` INNER JOIN tbl_category USING(`Category_ID`) INNER JOIN tbl_subcategory USING (`SCat_ID`) Inner JOIN tbl_supplier USING (`supplier_ID`)";
                          $display_users=mysql_query($sql_display) or die(mysql_error());
                            
                            while($row=mysql_fetch_array($display_users)){
                              $id = $row['product_ID'];
                              $bc=$row['barcode'];
                              $pn=$row['product_name'];
                              $cn=$row['Category_Name'];
                              $scn=$row['SubCategory_Name'];
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
                  <td>
                    <a data-target="#viewModal<?php echo $id; ?>" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" ><i class="fa fa-eye"></i></a>
                  </td>
                  <td>
                    <a data-target="#editModal<?php echo $id; ?>" class="btn btn-success btn-sm" title="Edit Menu" data-toggle="modal" ><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <div id="editModal<?php echo $id; ?>" class="modal fade" role="dialog">
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
                            <div class="col-md-6">
                              <div class="col-md-12">
                                <label>Barcode</label>
                                <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)" value="<?php echo $bc; ?>">  
                              </div>
                              <div class="col-md-12">
                              <label>Product Name</label>   
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3" value="<?php echo $pn; ?>">
                            </div>
                               
                            </div>
                            
                            
                            <div class="col-md-6">
                                <div class="input-group">
                                  <img src="<?php echo $img_display; ?>" style="width:100px;height:100px">
                                  <input type="file" name="">
                                </div>            
                              </div> 
                            <div class="col-md-12">
                              <label>Catergory</label>
                              <select class="form-control" name="select_cat" id="select_cat" tabindex="4" onchange="showUser(this.value)" required >
                                <option value="" disabled selected>Select Category</option>
                                  <?php 
                                    $display_cat=mysql_query("SELECT * FROM tbl_category") or die(mysql_error());
                                    $i=1;
                                    while($row=mysql_fetch_array($display_cat)){
                                      $Cat_ID=$row['Category_ID'];
                                      $Cat_Name=$row['Category_Name'];
                                  ?>
                                <option value="<?php echo $Cat_ID; ?>"><?php echo $Cat_Name; ?></option>
                                <?php } ?>        
                              </select>     
                            </div>
                            <div class="col-md-12">
                              <div id="txtHint"></div>       
                            </div>
                            <div class="col-md-12">
                              <label>Supplier</label>
                              <select class="form-control" id="supp" name="supp" tabindex="6">
                                <option value="" disabled selected>Select Supplier</option>
                                  <?php 
                                    $display_supplier=mysql_query("SELECT * FROM tbl_supplier") or die(mysql_error());
                                    $i=1;
                                    while($row=mysql_fetch_array($display_supplier)){
                                      $Supplier_ID=$row['supplier_ID'];
                                      $Supp_Name=$row['supplier_name'];
                                  ?>
                                <option value="<?php echo $Supplier_ID; ?>"><?php echo $Supp_Name; ?></option>
                                  <?php } ?> 
                              </select>       
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Standard Price</label>
                                <input type="number" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number3(event)" value="<?php echo $sp; ?>">
                                <label >List Price</label>
                                <input type="number" class="form-control" id="ListPrice" name="ListPrice" placeholder="List Price" tabindex="8" onKeyPress="return number3(event)" value="<?php echo $lp; ?>">
                              </div>         
                            </div>  
                            <div class="col-md-2">
                              <button type="submit" name="ProductSubmit" class="btn btn-default" tabindex="9">Submit</button>
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
              <div id="viewModal<?php echo $id; ?>" class="modal fade" role="dialog">
                 <div class="modal-dialog">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">View Product Information</h4>
                    </div>
                    <div class="modal-body">
                      <form class="form-signin" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-6">
                              <label>Barcode</label>
                              <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)" value="<?php echo $bc; ?>">  
                            </div>
                            <div class="col-md-6">
                              <div class="input-group">
                                <img src="<?php echo $img_display; ?>" style="width:100px;height:100px">
                                <input type="file" name="">
                              </div>            
                            </div>
                            <div class="col-md-6">
                              <label>Product Name</label>   
                              <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3" value="<?php echo $pn; ?>">
                            </div>
                            <div class="col-md-12">
                              <label>Catergory</label>
                              <input type="text" class="form-control" name="c_name" value="<?php echo $cn; ?>">    
                            </div>
                            <div class="col-md-12">
                              <label>Sub Catergory</label>
                              <input type="text" class="form-control" name="sc_name" value="<?php echo $scn; ?>">    
                            </div>
                            <div class="col-md-12">
                              <label>Supplier</label>
                              <input type="text" class="form-control" name="sc_name" value="<?php echo $sn; ?>">       
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label>Standard Price</label>
                                <input type="number" class="form-control" id="StandardPrice" name="StandardPrice" placeholder="Standard Price" tabindex="7" onKeyPress="return number3(event)" value="<?php echo $sp; ?>">
                                <label >List Price</label>
                                <input type="number" class="form-control" id="ListPrice" name="ListPrice" placeholder="List Price" tabindex="8" onKeyPress="return number3(event)" value="<?php echo $lp; ?>">
                              </div>         
                            </div>  
                            <div class="col-md-2">
                              <button type="submit" name="ProductSubmit" class="btn btn-default" tabindex="9">Submit</button>
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
                  <div class="col-md-6">
                    <div class="col-md-12">
                      <label for="Category">Barcode (Optional)</label>
                      <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" onmouseover="this.focus();" tabindex="1" onKeyPress="return number(event)">  
                    </div>  
                    <div class="col-md-12">
                      <label>Product Name</label>   
                      <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" tabindex="3">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="input-group">
                      <label>Product Image</label>
                      <input type="file" name="file" id="image" class="form-control" placeholder="Image" required>
                    </div>            
                  </div>
                  
                  <div class="col-md-12">
                    <label>Catergory</label>
                    <select class="form-control" name="select_cat" id="select_cat" tabindex="4" onchange="showUser(this.value)" required>
                      <option value="" disabled selected>Select Category</option>
                        <?php 
                          $display_cat=mysql_query("SELECT * FROM tbl_category") or die(mysql_error());
                          $i=1;
                          while($row=mysql_fetch_array($display_cat)){
                            $Cat_ID=$row['Category_ID'];
                            $Cat_Name=$row['Category_Name'];
                        ?>
                      <option value="<?php echo $Cat_ID; ?>"><?php echo $Cat_Name; ?></option>
                      <?php } ?>        
                    </select>     
                  </div>
                  <div class="col-md-12">
                    <div id="txtHint"></div>       
                  </div>
                  <div class="col-md-12">
                    <label>Supplier</label>
                    <select class="form-control" id="supp" name="supp" tabindex="6">
                      <option value="" disabled selected>Select Supplier</option>
                        <?php 
                          $display_supplier=mysql_query("SELECT * FROM tbl_supplier") or die(mysql_error());
                          $i=1;
                          while($row=mysql_fetch_array($display_supplier)){
                            $Supplier_ID=$row['supplier_ID'];
                            $Supp_Name=$row['supplier_name'];
                        ?>
                      <option value="<?php echo $Supplier_ID; ?>"><?php echo $Supp_Name; ?></option>
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
                    <button type="submit" name="ProductSubmit" class="btn btn-default" tabindex="9">Submit</button>
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
                                      <input type="text"  name="old_password" id="old_password" placeholder="Enter Old Password" class="form-control" aria-describedby="basic-addon1" >
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
                                   
                                   $query1= mysql_query("UPDATE tbl_users SET username='$username', password='$new_password' WHERE id='$ids'") or die (mysql_error());

                                    echo "<script type='text/javascript'>alert('SUCCESS!');</script>";
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
  </body>
</html>