<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>LOGIN</title>
    <link href="assets/images/ec.png" rel="icon" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="Assets/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="Assets/font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="Assets/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="Assets/bootstrap/js/bootstrap.min.js"></script>
</head>
<body style="background-color:#aa0e15">

<div class="main">
    <div class="container">
        <center>
        <div class="container1">
        <h1> USER'S LOG IN</h1>
        </div>
            <div class="middle">
                <div class="logo"><img id="logo-img" class="logo-img" style="width:200px;" src="Assets/Images/EC.png"/><div class="clearfix"></div></div>
                  <div class="clearfix"></div>
                    <div class="clearfix"></div>

                <div id="login">
                    <form class="form-signin" method="post" action="login_validation.php">
                        <fieldset class="clearfix">
                            <p ><span class="fa fa-user"></span><input type="text" id="username" class="form-control" placeholder="Username" name="username" required autofocus></p> <!-- JS because of IE support; better: placeholder="Username" -->
                            <p><span class="fa fa-lock"></span><input type="password" id="password" class="form-control" placeholder="Password" name="password" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
                            
                            <div>
                            <span style="width:48%; text-align:left;  display: inline-block;"><a class="small-text" href="forgotpw.php">Forgot
                                                password?</a></span>
                            <span style="width:50%; text-align:right;  display: inline-block;"><input type="submit" value="LOG IN"></span>
                            </div>
                         </fieldset>

                      

                </div> <!-- end login -->
      

                </form>
            </div>
        </center>
    </div>
</div>


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

body {
   
  color: #606468;
  font: 87.5%/1.5em 'Open Sans', sans-serif;
  margin: 0;
}

a {
    color: #eee;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

input {
    border: none;
    font-family: 'Open Sans', Arial, sans-serif;
    font-size: 12px;
    line-height: 1.5em;
    padding: 0;
    -webkit-appearance: none;
}

p {
    line-height: 1.5em;
}

.clearfix {
  *zoom: 1;

  &:before,
  &:after {
    content: ' ';
    display: table;
  }

  &:after {
    clear: both;
  }

}

.container {
  margin-top: -60px;
  left: 50%;
  position: fixed;
  top: 50%;
  transform: translate(-50%, -50%);
}
.container1{
  width:500 px;
  color:white;
  margin-bottom: 50px;


}

/* ---------- LOGIN ---------- */

#login form{
    width: 250px;
}
#login, .logo{
    display:inline-block;
    width:40%;
}
#login{
  margin-top: 30px;
  margin-left: -150px;
  padding: 0px 22px;
  width: 59%;
}
.logo{
border-right:1px solid #fff;
color:#fff;
font-size:10px;
  line-height: 125px;
}

#login form span.fa {
    background-color: #fff;
    border-radius: 3px 0px 0px 3px;
    color: #d00000;
    display: block;
    float: left;
    height: 40px;
    font-size:21px;
    line-height: 40px;
    text-align: center;
    width: 50px;
}

#login form input {
    height: 40px;
}
fieldset{

    padding:0;
    border:0;
    margin: 0;

}
#login form input[type="text"], input[type="password"] {
    background-color: #fff;
    border-radius: 0px 3px 3px 0px;
    color: #000;
    margin-bottom: 1em;
    padding: 0 16px;
    width: 200px;
}

#login form input[type="submit"] {
  border-radius: 3px;
  -moz-border-radius: 3px;
  -webkit-border-radius: 3px;
  background-color: #ffda0f;
  color: #d00000;
  font-weight: bold;
  /* margin-bottom: 2em; */
  text-transform: uppercase;
  padding: 5px 10px;
  height: 40px;
}

#login form input[type="submit"]:hover {
    background-color: #ffed8c;
}

#login > p {
    text-align: center;
}

#login > p span {
    padding-left: 5px;
}
.middle {
  display: flex;
  width: 600px;
}
</style>

</body>
</html>