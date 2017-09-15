<?php
        session_start();
        include 'connection.php';

?>

<?php 
    if (isset($_POST['send'])) {
        $aemail=$_POST['email'];


        $display_users=mysqli_query($open_connection,"SELECT * FROM tbl_users WHERE email='$aemail'") or die(mysql_error());
        $count = mysqli_num_rows($display_users);
        if ($count==0) 
        {
                echo "<script type='text/javascript'>alert('There is no user with this e-mail !');</script>";    
                        }
            else{
                        echo "<script type='text/javascript'>alert('Email and Password Successfully Send!');</script>";
                        while($row=mysqli_fetch_array($display_users)){
                            $username=$row['username'];
                            $fname=$row['firstname'];
                            $lname=$row['lastname'];
                            $password=$row['password'];

                 $query=mysqli_query($open_connection,"SELECT * FROM tbl_users Where username ='$username' AND password = '$password'") or die(mysql_error());

                            
                    
      }

    /*$message=   
            'Username: '.$username.'<br> 
            Password: '.$password;*/
    $message='Dear '.$fname.' '.$lname.',<br> A request has been sent to reset your password. Please the following link to reset your password';
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
    <title>FORGOT PASSWORD!</title>
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

    <script type="text/javascript">
        function sent_confirmation()
        {
            alert("Successfully Sent")
        }
    </script>

  </head>
  

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
</head>
<body style="background-color:#aa0e15">

    <!-- Page Content -->
        <!-- Portfolio Grid Section -->
    <section id="login">
     
                
   <div class="container" >
    <div class="card card-container" style="background-color: #d9c5c6;opacity: 20;">
        <img id="logo-img" class="logo-img" src="Assets/Images/EC.png"/>
        <form role="form" class="form-signin"  method="post" id="login">
                        <label style="font-size: 18px;margin-top: 10px">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="xxx@gmail.com" required="">
                     <button type="submit" name="send" class="btn btn-primary btn-lg" > Send</button>
                     <button type="reset" name="clear" class="btn btn-default btn-lg"  value="Cancel" > Clear</button>
                    
            
                      <span class="help-block" id="erruser" style="display: none;font-size: 9px;color: #fff;margin-left: 600px;margin-top: 350px;"></span>
                    <span class="help-block" id="pwordlmt" style="display: none;font-size: 9px;color: #fff;margin-left: 900px;">    </span>
                    </form>
        </div>
        </div>
                
                   
            </div>
         </div>    
        </div>         
    
</section>

        <!-- Footer -->
      

    <!-- /.container -->

    <!-- jQuery -->
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

    

</body>

</html>
<style>
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
    height: 400px;
}

/*
 * Card
 */
.card {
    background-color: #F7F7F7;
    /* just in case there no content*/
    padding: 20px 25px 30px;
    margin: 0 auto 25px;
    margin-top: 50px;
    /* shadows and rounded borders */
    -moz-border-radius: 2px;
    -webkit-border-radius: 2px;
    border-radius: 2px;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}

.logo-img {
    width: 180px;
    height: 180px;
    margin: 0 auto;
    margin-top: -40px;
    display: block;
}

.form-signin #username,
.form-signin #password {
    direction: ltr;
    height: 44px;
    font-size: 16px;
}

.form-signin input[type=email],
.form-signin input[type=password],
.form-signin input[type=text],
.form-signin button {
    width: 100%;
    display: block;
    margin-bottom: 10px;
    z-index: 1;
    position: relative;
    -moz-box-sizing: border-box;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}

.form-signin .form-control:focus {
    border-color: rgb(104, 145, 162);
    outline: 0;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
}
</style>


