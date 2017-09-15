<!-- USER ACCOUNT SETTINGS-->
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
        for ($i=0; $i < strlen($passwords); ++$i) { 
          $b=$a[$i];
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
        if ($UC && $LC && $NUM) {
          echo "Password changed!";
        }
        else
          echo "Password needs ...";
        if (strlen($confirm_password) < 8) {
          echo "<script type='text/javascript'> alert ('Password must be at least 8 character long!'); </script>";
        }
        elseif ($UC && $LC && $NUM ) {
          $query1= mysql_query("UPDATE tbl_users SET username='$username', password='$new_password' WHERE id='$ids'") or die (mysql_error());
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