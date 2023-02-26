<?php
include('db.php');
use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';
require("phpmailer/Exception.php");
require("phpmailer/PHPMailer.php");
require("phpmailer/SMTP.php");
$msg = "";
if(isset($_POST['submit'])){
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $check = mysqli_num_rows(mysqli_query($conn,"select * from user where email = '$email'"));
    if($check >0){
          $msg = "Email id already exist!!! Give new email id";
    }
    else{
        mysqli_query($conn,"insert into user(name,email,password,status) values('$name','$email','$password',0)");
        $msg = "Sent a verification link to your <strong>$email</strong>";
        $id=mysqli_insert_id($conn);
        $mailHTML='Please confirm your account registration by clicking the button or link bellow:
        http://localhost/EMAILVERIFICATION/send.php?id='.$id ;
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = 'srinjonsadhukhan9163@gmail.com';
        $mail->Password = 'uinzohgsczgzpijh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('srinjonsadhukhan9163@gmail.com');
        $mail->addAddress($_POST["email"]);
        $mail->isHTML(true);
        // $mail->Subject = $_POST["subject"];
        $mail->Body = $mailHTML;
        $mail->send();
 
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<title>Registration Form</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
	body{
		color: #fff;
		background: #63738a;
		font-family: 'Roboto', sans-serif;
	}
    .form-control{
		height: 40px;
		box-shadow: none;
		color: #969fa4;
	}
	.form-control:focus{
		border-color: #5cb85c;
	}
    .form-control, .btn{        
        border-radius: 3px;
    }
	.signup-form{
		width: 400px;
		margin: 0 auto;
		padding: 30px 0;
	}
	.signup-form h2{
		color: #636363;
        margin: 0 0 15px;
		position: relative;
		text-align: center;
    }
	.signup-form h2:before, .signup-form h2:after{
		content: "";
		height: 2px;
		width: 30%;
		background: #d4d4d4;
		position: absolute;
		top: 50%;
		z-index: 2;
	}	
	.signup-form h2:before{
		left: 0;
	}
	.signup-form h2:after{
		right: 0;
	}
    .signup-form .hint-text{
		color: #999;
		margin-bottom: 30px;
		text-align: center;
	}
    .signup-form form{
		color: #999;
		border-radius: 3px;
    	margin-bottom: 15px;
        background: #f2f3f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
	.signup-form .form-group{
		margin-bottom: 20px;
	}
	.signup-form input[type="checkbox"]{
		margin-top: 3px;
	}
	.signup-form .btn{        
        font-size: 16px;
        font-weight: bold;		
		min-width: 140px;
        outline: none !important;
    }
	.signup-form .row div:first-child{
		padding-right: 10px;
	}
	.signup-form .row div:last-child{
		padding-left: 10px;
	}    	
    .signup-form a{
		color: #fff;
		text-decoration: underline;
	}
    .signup-form a:hover{
		text-decoration: none;
	}
	.signup-form form a{
		color: #5cb85c;
		text-decoration: none;
	}	
	.signup-form form a:hover{
		text-decoration: underline;
	}  
	.signup-form .message{
		color:red;
	}
</style>
<body>
<div class="signup-form">
    <form method="post" action="">
		<h2>Register</h2>
		<p class="hint-text">Create your account. It's free and only takes a minute.</p>
         <div class="form-group">
        	<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
        </div>
		
		<div class="form-group">
            <button type="submit"  name="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
		<div class="message">
            <?php
            // $msg = "";
            echo $msg;
            ?>
		</div>
    </form>
	<!-- <div class="text-center">Already have an account? <a href="login.php">Sign in</a></div> -->
</div>
</body>
</html>                   
