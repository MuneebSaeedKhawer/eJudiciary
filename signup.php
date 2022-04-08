<?php

include 'dbconn.php';

//initialization
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$email_error = $password_error = $confirm_password_error = "";

// Validate EMAIL
if(empty(trim($_POST["email"]))){
  $email_error = "Please enter an email.";
      echo '<script language="javascript">';
      echo 'alert("Please enter email address");';
      echo 'window.location.href="login.html";';
      echo '</script>';
}
else {
  $email = trim($_POST["email"]);
}

 // Validate password
 if(empty(trim($_POST["password"]))){
  $password_err = "Please enter a password.";     
  function_alert($password_err);

} elseif(strlen(trim($_POST["password"])) < 6){
  $password_err = "Password must have atleast 6 characters.";
  function_alert($password_err);

} else{
  $password = trim($_POST["password"]);
}

// Validate confirm password
if(empty(trim($_POST["confirm_password"]))){
  $confirm_password_err = "Please confirm password.";     
  function_alert($confirm_password_err);
} else{
  $confirm_password = trim($_POST["confirm_password"]);
  if(empty($password_err) && ($password != $confirm_password)){
      $confirm_password_err = "Password did not match.";
      function_alert($confirm_password_err);

  }
}

//Prepare to insert in DB

if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
    $sql="INSERT INTO signup (email, firstname, lastname, password)
    VALUES('$email','$firstname','$lastname','$password')";
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

// Function definition
function function_alert($message) {
 echo "<script>alert('$message');</script>";
}
?>