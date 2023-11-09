<?php
session_start();
require_once "db/connect.php"
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=inter">
    </head>
    <body>    
        <form action="" method="post">
            <div class="Container">
                <div class="head">
                <h1>Shopping Cart</h1>
                <h1>Sign in</h1>
                </div>
                <div class="mid">
                <input type="text" name="e_mail" placeholder="Enter Email Address" id="email">
                <input type="password" name="u_pass" placeholder="Enter Password" id="password">
                <a href="forgetpass.html" >Forget Password ?</a>
                </div>
                <div class="bottom">
                <a href="Signup.php">Create Account</a>
                <input type="submit" name="submit" value="Login">
                </div>
            </div>    
        </form>
        <?php
            if(isset($_POST['submit']))
            {	
                $email = $_POST['e_mail'];
                $pass = $_POST['u_pass'];
                $_SESSION["u_email"]=$email;
                $_SESSION["u_pass"]=$pass;
                if(empty($email) && empty($pass)){

                    die("Enter Details");

                }
                $sql="SELECT * FROM user WHERE email='".$email."' AND pass='".$pass."'";
                $result=mysqli_query($conn,$sql); 

                if(mysqli_num_rows($result)===1)
                {
                    $row = mysqli_fetch_assoc($result);
                        if($row ['email']===$email && $row['pass']===$pass){
                            $_SESSION["uid"]=$row['id'];
                            header('location:http://localhost/dashboard/Project/Project/php/display.php');
                        }  
                }
                else 
                        {
                            die("Unsuccesfull");
                        }
                
            }
    ?>
    </body>
    </html>