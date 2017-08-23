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
  
  if(isset($_POST['deleteCat'])){
      $no=$_POST['Cate_ID'];
        mysql_query("DELETE from tbl_category WHERE Category_ID='$no'") or die(mysql_error());
        mysql_query("DELETE from tbl_subcategory WHERE Category_ID='$no'") or die(mysql_error());
        //header("location:category.php");
  }

  if(isset($_POST['deleteSCat'])){
    $no=$_POST['SCate_ID'];
    mysql_query("DELETE from tbl_subcategory WHERE SCat_ID='$no'") or die(mysql_error());;
    //header("location:category.php");
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
  </head>
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
                  <li><a href="user.php"><span class="fa fa-user"></span> User Management</a></li>
                  <li class="active"><a href="category.php"><span class="fa fa-tasks"></span> Category</a></li>
                  <li><a href="supplier.php"><span class="fa fa-truck"></span> Supplier</a></li>
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
              <span class="glyphicon glyphicon-list"></span>Categories and Sub Categories
            </div>
          <div class="panel-body">
            <?php 
                    $display_cat=mysql_query("SELECT * FROM tbl_category") or die(mysql_error());
                    $i=1;
                    
                    while($row=mysql_fetch_array($display_cat)){
                      $Cat_ID=$row['Category_ID'];
                      $collap="collapse{$Cat_ID}";
                      $Cat_Name=$row['Category_Name'];

                      $display_scat=mysql_query("SELECT * FROM tbl_subcategory WHERE Category_ID='{$Cat_ID}'") or die(mysql_error());          
            ?>
            <!--Categories with collapsable Sub Categories-->
            <div class="panel-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">
                      <form method="post">
                        <a data-toggle="collapse" href=<?php echo "#{$collap}"?> ><?php echo $Cat_Name ?></a>
                        <div style="margin-left: 900px;margin-top: -20px;">
                        <a class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-cat-id='<?php echo $Cat_ID;?>' data-name='<?php echo $Cat_Name; ?>' data-target="#EditCat">
                        <i class="fa fa-pencil"></i>
                        </a>
                        <input type="hidden" name="Cate_ID" value="<?php echo $Cat_ID; ?>">
                        <button type="submit" name="deleteCat" id="deleteCat" class="btn btn-danger btn-sm" onClick="del_confirmation();return false;"> <span class="fa fa-trash"></span></button>
                        </div>
                      </form>          
                  </h4>
                </div>

                <div id=<?php echo "{$collap}"?> class="panel-collapse collapse">
                  <ul class="list-group">
                    <?php 
                      while($row2=mysql_fetch_array($display_scat)){
                        $SCat_ID=$row2['SCat_ID'];
                        $SCat_Name=$row2['SubCategory_Name'];
                    ?>
                    <li class="list-group-item">
                      <form method="post">
                      <?php echo $SCat_Name ?>
                        <div style="margin-left: 900px;margin-top: -20px;">
                        <a class="btn btn-success btn-sm" title="Edit" data-toggle="modal" data-scat-id="<?php echo $SCat_ID;?>"  data-scat-name="<?php echo $SCat_Name;?>" data-target="#EditSCat">
                        <i class="fa fa-pencil"></i>
                        </a>
                        <input type="hidden" name="SCate_ID" value="<?php echo $SCat_ID; ?>">
                        <button type="submit" name="deleteSCat" id="deleteSCat" class="btn btn-danger btn-sm" onClick="del_confirmation();return false;"> 
                          <span class="fa fa-trash"></span>
                        </button>
                        </div>
                        
                            
                      </form>
                    </li>        
                  </ul>
                    <?php } ?>
                  <div class="panel-footer">        
                    <button type="button" class="btn btn-success" data-toggle="modal" data-cat-id="<?php echo $Cat_ID ?>" data-target="#SubCat">
                      Add New Sub Category
                    </button>
                  </div>

                </div>
              </div>
            </div>
            <?php }?>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-md-6">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Cat"><i class="fa fa-plus"></i> Add New Category</button>
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
    	
  <!--Modals Below-->
    <!--=================================================[ ADD CATEGORY ]==================================================-->
    <div id="Cat" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
          </div>
          <div class="modal-body">
            <form class="form-signin" method="post" action="category_CRUD.php">
              <div class="form-group">
                <label for="exampleInputEmail1">Enter Category Name</label>
                <input type="text" class="form-control" id="Category" name="Category" placeholder="Category Name" required>
              </div>

              <a href="#" class="btn btn-success" id="filldetails" onclick="addFields()">Add Sub Category</a>
              <div id="container">
                <input type="hidden" id="SC_v" name="SC_v">
              </div>
              <br>
              <button type="submit" name="CategorySubmit" class="btn btn-default">Save</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--=================================================[ ADD SUB CATEGORY ]==================================================-->
    <div id="SubCat" class="modal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Adding</h4>
          </div>
          <div class="modal-body">
            <form class="form-signin" method="post" action="category_CRUD.php">
              <div class="form-group">
                <label for="exampleInputEmail1">Enter SubCategory Name</label>
                <input type="hidden" class="form-control" name="Sub" value="" />
                <input type="text" class="form-control" id="SubCategory" name="SubCategory" placeholder="Sub Category Name" required>
              </div>
              <button type="submit" name="SubCategorySubmit" class="btn btn-default">Save</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--=================================================[ EDIT CATEGORY ]==================================================-->
    <div id="EditCat" class="modal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editing</h4>
          </div>
          <div class="modal-body">
            <form class="form-signin" method="post" action="category_CRUD.php">
              <div class="form-group">
                <label>Enter Category Name</label>
                <input type="hidden" class="form-control" name="C_ID" value="" />
                <input type="text" class="form-control" id="Ctgry" name="Ctgry" placeholder="Category Name" >
              </div>
              <button type="submit" name="EditCategorySubmit" class="btn btn-default">Save Changes</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!--=================================================[ EDIT SUB CATEGORY ]==================================================-->
    <div id="EditSCat" class="modal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Editing</h4>
          </div>
          <div class="modal-body">
            <form class="form-signin" method="post" action="category_CRUD.php">
              <div class="form-group">
                <label>Enter Category Name</label>
                <input type="hidden" class="form-control" name="SC_ID" value="" />
                <input type="text" class="form-control" id="SCtgry" name="SCtgry" placeholder="Category Name">
              </div>
              <button type="submit" name="EditSCategorySubmit" class="btn btn-default">Save Changes</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
       <!-- USER ACCOUNT SETTINGS-->
                  <?php include 'connection.php' ?>
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
                   
    <!--=====================================[ SCRIPTS ]==========================================-->
    <script>
      $('#SubCat').on('show.bs.modal', function(e) {
        var CatID = $(e.relatedTarget).data('cat-id');
        $(e.currentTarget).find('input[name="Sub"]').val(CatID);
      });

      $('#EditCat').on('show.bs.modal', function(e) {
        var CatID = $(e.relatedTarget).data('cat-id');
        var CatName = $(e.relatedTarget).data('name');
        $(e.currentTarget).find('input[name="C_ID"]').val(CatID);
        $(e.currentTarget).find('input[name="Ctgry"]').val(CatName);
      });

      $('#EditSCat').on('show.bs.modal', function(e) {
        var SCatID = $(e.relatedTarget).data('scat-id');
        var SCatName = $(e.relatedTarget).data('scat-name');
        $(e.currentTarget).find('input[name="SC_ID"]').val(SCatID);
        $(e.currentTarget).find('input[name="SCtgry"]').val(SCatName);
      });

    </script>

    <script type="text/javascript">
      i=1;

      function del_confirmation()
      {
        if(confirm("Are you sure?")==1)
        {
          document.getElementById('deleteUser').submit();
        }
      }

      function addFields(){
        var container = document.getElementById("container");
            
            
        container.appendChild(document.createTextNode("Sub Category " + i));
        var SC = document.getElementById("SC_v");
        SC.value = i;
        var input = document.createElement("input");
        input.type = "text";
        input.className = "form-control input-sm";
        input.name = "SC" + i;
        container.appendChild(input);
        container.appendChild(document.createElement("br"));
        i++;
            
      }
    </script>

  </body>
</html>