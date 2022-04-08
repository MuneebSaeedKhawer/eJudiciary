<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lawyerdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("DB not connected: " . $conn->connect_error);
}


?>