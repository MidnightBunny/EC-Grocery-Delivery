<?php
        session_start();
        include 'connection.php';

?>

<?php 
    if (isset($_POST['send'])) {
        $aemail=$_POST['email'];


        $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_user WHERE email='$aemail'") or die(mysql_error());
        $count = mysqli_num_rows($display_users);
        if ($count==0) 
        {
                echo "<script type='text/javascript'>alert('There is no user with this e-mail !');</script>";    
        }
        else{
                        echo "<script type='text/javascript'>alert('Email and Password Successfully Send!');</script>";
                        while($row=mysqli_fetch_array($display_users)){
                            $i= $row['id'];
                            $username=$row['username'];
                            $fname=$row['firstname'];
                            $lname=$row['lastname'];
                            $password=$row['password'];
                            $email=$row['email'];
                        
                 $query=mysqli_query($open_connection,"SELECT * FROM tbl_user Where username ='$username' AND password = '$password'") or die(mysql_error());

                            
                    
      }

    /*$message=   
            'Username: '.$username.'<br> 
            Password: '.$password;*/

    $message='Dear '.$fname.' '.$lname.',<br> A request has been sent to reset your password. Please the following link to reset your Password. <br> Here\'s the link to reset to the default password:<br> localhost/ecnd_new/reset_pass.php?q='.$i.'' ;
    require "phpmailer/class.phpmailer.php"; //include phpmailer class
      
    // Instantiate Class  
    $mail = new PHPMailer();  
      
    // Set up SMTP  
    $mail->IsSMTP();                // Sets up a SMTP connection  
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
    $mail->SMTPSecure = "ssl";      // Connect using a TLS connection  
    $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
    $mail->Port = 465;  //Gmail SMTP port
    $mail->Encoding = '7bit';
    // Authentication   
    $mail->Username   = "ecnd17@gmail.com"; // Your full Gmail address
    $mail->Password   = "ecnd2017"; // Your Gmail password
      
    // Compose
    $mail->SetFrom($aemail, 'EC NEW DEAL');
    $mail->AddReplyTo($aemail, 'EC NEW DEAL');
    $mail->Subject = "New Contact Form Enquiry";      // Subject (which isn't required)  
    $mail->MsgHTML($message);
 
    // Send To  
    $mail->AddAddress($aemail, "EC NEW DEAL"); // Where to send it - Recipient
    $result = $mail->Send();        // Send!  
    $message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
    unset($mail);
     echo "<script type='java/script'>alert('Email and Password Successfully Send!');</script>";
   
}
    }


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="Assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript">
        function sent_confirmation()
        {
            alert("Successfully Sent")
        }
    </script>
</head>
<body style="background-color:#aa0e15">

<div class="main">
    <div class="container">
        <center>
        <div class="container1">
        <h1>FORGOT PASSWORD</h1>
        </div>
            <div class="middle">
                

                <div class="login">
                    <form  role="form" class="form-signin"  method="post" id="login">
                        <div class="col-sm-12">
                          <div class="col-sm-2"></div>
                          <div class="col-md-6" style="margin-bottom: 10px;">
                         <div class="input-group">
                            <span class="input-group-addon"> <i class="fa fa-envelope-o"></i></span>
                              <input type="email" name="email" class="form-control" placeholder="xxx@gmail.com" required="">  
                          </div>
                        </div>
                        <div class="col-sm-2"><button type="submit" name="send" class="btn btn-danger btn-block" > Send</button></div>
                        
                        </div>
                        <div class="col-sm-12">
                          <div class="col-sm-5"></div>
                          <div class="col-sm-2" style="margin-top: 10px;">
                          <a href="index.php" class="back"><span class="fa fa-lock"></span> Back to login page</a>
                        </div>
                          <div class="col-sm-5"></div>
                        </div>

                      
                      <span class="help-block" id="erruser" style="display: none;font-size: 9px;color: #fff;margin-left: 600px;margin-top: 350px;"></span>
                    <span class="help-block" id="pwordlmt" style="display: none;font-size: 9px;color: #fff;margin-left: 900px;">    </span>

                </div> <!-- end login -->
      

                </form>
            </div>
        </center>
    </div>
</div>
  <script src="js1/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js1/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <!-- jQuery -->





<script src="../bootstrap/js/jquery.min.js"> </script>
 <!-- Theme JavaScript -->
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Theme JavaScript -->
    <script src="../js/freelancer.js"></script>
    <script src="../js/freelancer.min.js"></script>
    <script src="../js/scrolling-nav.js"></script>
 
<script type="text/javascript">
        
        var specialKeys = new Array();
        specialKeys.push(8);//backspace
        specialKeys.push(9);//tab
        specialKeys.push(46);//delete
        specialKeys.push(36);//home
        specialKeys.push(35);//end
        specialKeys.push(37);//left
        specialKeys.push(39);//right


        function userlmt(e){
            var keyCode = e.keyCode==0 ? e.charCode : e.keyCode;
            var ret = ((keyCode>=48 && keyCode<=57) || (keyCode >=65 && keyCode <=90) || (keyCode>=97 && keyCode <=122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("erruser").style.display = ret ? "none" : "inline";
            return ret;
        }
        function pwordlmt(e){
            var keyCode = e.keyCode==0 ? e.charCode :e.keyCode;
            var ret = ((keyCode>=48 && keyCode<=57) || (keyCode >=65 && keyCode <=90) || (keyCode>=97 && keyCode <=122) || (specialKeys.indexOf(e.keyCode) != -1 && e.charCode != e.keyCode));
            document.getElementById("pwordlmt").style.display = ret ? "none" : "inline";
            return ret;
        }
        </script>

    <script type="text/javascript">
       var timeoutId = 0;
var $button = $("#bt");
var $box = $("#Password");
var $chk = $("#chk");

$button.mousedown(function() {
    timeoutId = setTimeout(function(){
        showPass('text');
    }, 300);
}).bind('mouseup', function() {
    clearTimeout(timeoutId);
    if( !( $chk.prop("checked") ) )
        showPass('password');
});

function showPass(val){
    $box.prop('type', val);
}

    </script>

    

<style type="text/css">
    @charset "utf-8";
div.main{
background-image: url("Assets/Images/bg2.jpg");
background-repeat: no-repeat;
background-position: center;
background-attachment: fixed;
opacity: 20;
height:calc(100vh);
width:100%;
color:white;
}

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* ---------- GENERAL ---------- */

* {
  box-sizing: border-box;
    margin:0px auto;

  &:before,
  &:after {
    box-sizing: border-box;
  }

}
.back{
  color:white;
text-decoration: none;
font-size: 12px;

}
.back:hover{
  color:red;
  text-decoration: none;
}
body {
   
  color: #606468;
  font: 87.5%/1.5em 'Open Sans', sans-serif;
  margin: 0;
}

.login{
  margin-top:50px;
}
.container1{
  padding-top: 100px;
}
i{
  color:red;
}
</style>

</body>
</html>