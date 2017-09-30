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


<div class="container" >
    <div class="card card-container" style="background-color: #d9c5c6;opacity: 20;">
        <img id="logo-img" class="logo-img" src="Assets/Images/EC.png"/>
        <form class="form-signin" method="post" action="login_validation.php">
            <input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus>
            <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
            
                    <button  class="btn btn-primary btn-lg " type="submit" >Login</button>
                
               
                    <button  class=" btn btn-danger btn-lg " type="reset" >Clear</button>                     
                
                
               
            
        </form><!-- /form -->
        <div class="signin-help">
            <p>forgot your password? <a href="forgotpw.php">click here</a></p>
        </div>
    </div>
</div>




<style>
.card-container.card {
    max-width: 350px;
    padding: 40px 40px;
    height: 500px;
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


</body>
</html>