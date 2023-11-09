<?php
session_start();
require "db/connect.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up</title>
</head>
<body>
<form method="post">
    <div class="container">
        <h1>Shopping Cart</h1>
        <h1>Create your Shopping Account</h1>
        <div class="main">
            <div class="col2">
                <input type="text" placeholder="First Name" name="fname" id="fname">
                <input type="text"placeholder="Last Name"  name="lname" id="lname">
            </div>
            <div class="row3">
                <input type="email" placeholder="Enter Email Address"   name="email" id="email">
                <input type="password" class="" placeholder="Enter Password" name="pass" id="pass">
                <input type="password" placeholder="Enter Confirm Password" name="cpass" id="cpass">
            </div>
            <div class="bottom">
                <a href="login.html">Already have an account ? Login </a>
                <input type="submit" name="submit" value="Signup">
            </div>
        </div>
    </div>
</form>   
</body>
</html>
<?php

if(isset($_POST['submit']))
{	

  $name=$_POST['fname'];
  $email=$_POST['email'];
  $pass=$_POST['pass'];
  $confirmpass=$_POST['cpass'];
    $sql_query = "INSERT INTO user (username,email,pass,cpass)
    VALUES ('$name','$email','$pass','$confirmpass')";

    if (mysqli_query($conn, $sql_query)) 
    {
       echo "<alert>New Details Entry inserted successfully !</alert>";
       header("location:http://localhost/dashboard/Project/Project/php/login.php");
    } 
    else
    {
       echo "Error: " . $sql . "" . mysqli_error($conn);
    }
    mysqli_close($conn);
}else{
    echo "Signup Failed";
}


?>