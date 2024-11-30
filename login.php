<!DOCTYPE html>
<html>
<meta charset="utf-8">
<title>Paws & Purrs Pet Grooming</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php
require('db.php');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: index.php");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>
<div class="form">
<h1>Paws & Purrs Pet Grooming</h1>
<form action="" method="post" name="login">
<input type="text" name="username" placeholder="username/email" required />
<input type="password" name="password" placeholder="password" required />
<br>
<input name="submit" type="submit" value="Login" />
</form>
<p>New? <a href='registration.php'>Register here.</a></p>
</div>
<?php } ?>
</body>
</html>
