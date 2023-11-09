<?php
$server_name="localhost:3307";
$username="root";
$password="";
$db_name="shoppingcart";

$conn=mysqli_connect($server_name,$username,$password,$db_name);
if(!$conn)
{
    die("Connection Failed:".mysqli_connect_errorr());

}
?>