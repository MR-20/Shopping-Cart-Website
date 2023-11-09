<?php
session_start();

require_once "db/connect.php";

echo $_SESSION["otpp"];
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="otpsender.css">
    
    <title>Document</title>
</head>
<body>

<form action="" method="POST">

    <div class="container">
<input type="text" name="otp1" maxlength="1" />
<input type="text" name="otp2" maxlength="1" />
<input type="text" name="otp3" maxlength="1" />
<input type="text" name="otp4" maxlength="1" />
<input type="text" name="otp5" maxlength="1" />
<input type="text" name="otp6" maxlength="1" />
<label id="qw"></label>
    </div>
    <input type="submit" id="submit" name="submit" value="Continue">
    <a href="../signup.php">Want to Change Email Address</a>

</form>

    
</body>
</html>

<?php

if(isset($_POST['submit'])){

$conotp=$_POST['otp1'].$_POST['otp2'].$_POST['otp3'].$_POST['otp4'].$_POST['otp5'].$_POST['otp6'];
// echo $conotp;



    if(isset($conotp)==$_SESSION['otpp']){

        $name = $_SESSION['u_name'];
        $email = $_SESSION['e_mail'];
        $pass = $_SESSION['u_pass'];
        $confirmpass = $_SESSION['u_conpass'];
        
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
        echo "Login Failed";
    }
    
    
}

?>
<script>
var container = document.getElementsByClassName("container")[0];
container.onkeyup = function(e) {
    var target = e.srcElement || e.target;
    var maxLength = parseInt(target.attributes["maxlength"].value, 10);
    var myLength = target.value.length;
    if (myLength >= maxLength) {
        var next = target;
        while (next = next.nextElementSibling) {
            if (next == null)
                break;
            if (next.tagName.toLowerCase() === "input") {
                next.focus();
                break;
            }
        }
    }
    // Move to previous field if empty (user pressed backspace)
    else if (myLength === 0) {
        var previous = target;
        while (previous = previous.previousElementSibling) {
            if (previous == null)
                break;
            if (previous.tagName.toLowerCase() === "input") {
                previous.focus();
                break;
            }
        }
    }
}
</script>
