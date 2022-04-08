<?php

include 'dbconn.php';

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

 // Check if username is empty
 if(empty(trim($_GET["email"]))){
  $email_err = "Please enter email.";
  echo $email_err;
} else{
  $email = trim($_GET["email"]);
}

// Check if password is empty
if(empty(trim($_GET["password"]))){
  $password_err = "Please enter your password.";
  echo $password_err;
} else{
  $password = trim($_GET["password"]);
}

// Validate credentials
if(empty($email_err) && empty($password_err)){
//insert to db
//$email=$_GET['email'];
//$password=$_GET['password'];
$sql="SELECT email, password FROM signup where email = '$email' and password = '$password'";
$result = $conn->query($sql);
    if (!$row = $result -> fetch_assoc())
    {
      echo "Incorrect username or password!";
    }
    else {
      echo   "You are logged in !";
       header ("Location:admin\home.html");
    }
}
else{
  echo "Oops! Something went wrong. Please try again later.";
}

?>