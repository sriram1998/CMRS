<?php
$servername = "localhost";
$username = "root";// Enter mysql username
$password = "AthlonY2";// Enter mysql password
$dbname = "hospital";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$pass=$_POST['password'];
$name=$_POST["userName"];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
$sql = "SELECT name,pass,type FROM USERS";
$result = $conn->query($sql);
$k=1;
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $stored_name=$row["name"];
      $stored_pass=$row['pass'];
      $stored_type=$row['type'];
      if($name==$stored_name && password_verify($pass,$stored_pass))
    {
      $k=0;
      if($stored_type=='patient')
      $_SESSION['patient'] = $name;
      else {
          $_SESSION['doctor'] = $name;
      }
      echo "Success";
      exit();
    }
    }
}
$conn->close();
if($k==1)
{
  echo "fail";
  exit();
}
}
?>
