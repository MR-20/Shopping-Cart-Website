
<?php
 session_start();

 $server_name="localhost:3306";
 $username="root";
 $password="";
 $db_name="shoppingcart";
 $conn=mysqli_connect($server_name,$username,$password,$db_name);
//products adding to Cart Page
if(!$conn)
{
    die("Connection Failed:".mysqli_connect_errorr());
    
}
$amt=$_SESSION['totalcart'];

//$max=sizeof($_SESSION['productid']);
$array = array($_SESSION['productid']);

$serialized_array=serialize($array);
$unserialized_array = unserialize($serialized_array); 

//var_dump($serialized_array); // gives back a string, perfectly for db saving!
var_dump($unserialized_array); // gives back the array again

// for($i=0; $i<$max; $i++) 
// { 
//     $productid[$i]=$_SESSION['productid'][$i];
//     echo $productid[$i];

// } // outer array for loop
/// SAVE ORDER AND DELIVER
if(isset($_POST['save'])){
    $userid=$_SESSION['user__id'];
    $orderid=$_SESSION["oid"];
    $name=$_POST['name'];
    $aph=$_POST['phone_number'];
    $pincode=$_POST['pincode'];
    $locality=$_POST['locality'];
    $address=$_POST['address'];
    $city=$_POST['city/town/district'];
    $state=$_POST['state'];
    $landmark=$_POST['landmark'];
    $sph=$_POST['alter_phone'];
    $addtype=$_POST['g1'];
    $productids = serialize($array);

    $_SESSION["orderid"]=$orderid;
    $_SESSION["userid"]=$userid;
    $_SESSION["totatamt"]=$amt;
    
    

    $save="INSERT INTO checkoutdetails (u_id,c_Id,name,primary_ph,pincode,locality,address,city,state,landmark,sec_ph,address_type,productids)
    VALUES ('$userid','$orderid','$name','$aph','$pincode','$locality','$address','$city','$state','$landmark','$sph','$addtype','$productids')";


    if (mysqli_query($conn, $save)) 
    {

        $getid="SELECT id from checkoutdetails WHERE u_id='$uid' AND c_Id='$orderid'";
        $cancel="DELETE FROM cart WHERE uid='".$_SESSION["user__id"]."'";
        $result = $conn->query($cancel);
        header('location:http://localhost/dashboard/Project/main/php/payment.php');
      
    } 
    else
    {
       echo "Error: " . $sqll . "" . mysqli_error($conn);
    }
}
//// ORDER CANCEL
if(isset($_POST['cancel'])){

    $cancel="DELETE FROM cart WHERE uid='".$_SESSION["user__id"]."'";
    $result = $conn->query($cancel);
    ?>
        <script type="text/javascript">
            alert('Order Cancel');
    window.location.href = 'http://localhost/dashboard/Project/Project/php/display.php';
    </script>
     <?php
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="../js/custom.js"></script>
    <link rel="stylesheet" href="../css/checkoutstyle.css">
    
    <title>Check Out</title>

    
   
    </head>
<body>

     <!-- nav -->

  <!-- top -->
  <section>
 <!-- Top navigation -->
 <div class="topnav">
<!-- Centered link -->
<div class="topnav-centered">
 
  <form class="example" action="/action_page.php">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><img src="../images/iconsearch.png" alt="d"></button>
</form>
  
</div>
<!-- Left-aligned links (default) -->
<a href="#news">Shoppping cart</a>
<!-- Right-aligned links -->
<div class="topnav-right">
<!-- <p class="cart"><?php echo $qcount;?></p>
<a class="cartimg" href="cart.php"><img src="../images/cart.png"  alt="alternatetext" ></a> -->
  <a href="#search">My Account</a>
  <a href="login.php">Login</a>
</div>
</div>
<!-- <cate> -->
<!-- <div class="cate">
  <a href="">Grocery</a>
  <a href="">Electronics</a>
  <a href="">Fashion</a>
  <a href="">Mobiles</a>
  <a href="">Home Appliances</a>
  <a href="">Toys & More</a>
</div> -->
</section>
    <!-- nav end -->

    <div class="main">
    <button  id="down">Click</button>
<table id="formadd">

<tr><th></th><th></th></tr>
<tr>
<td>
<div class="col1">
<form method="POST">
<h1>CheckOut</h1>
<div class="m">
<table style="border:1px solid black;">
<tr><th></th><th></th><th></th></tr>
<tr>
<td><label>Total Amount : <?php echo $amt;?></label></td>
<td><label>User ID : <?php echo $_SESSION["user__id"];?></label></td>
<td><label>Order ID : <?php echo $_SESSION["oid"];?></label></td>

</tr>
<tr><td><label>Enter Name</label></td><td><input type="text" name="name" value=""></td></tr>
<tr><td><label>Enter Phone Number</label></td><td><input type="text" name="phone_number" value=""></td></tr>
<tr><td><label>Enter Pincode</label></td><td><input type="number" name="pincode" value="" size="5"></td></tr>
<tr><td><label>Enter Locality</label></td><td><input type="text" name="locality" value=""></td></tr>
<tr><td><label>Enter Address</label></td><td><input type="text" name="address" value=""></td></tr>
<tr><td><label>Enter City/Town/District</label></td><td><input type="text" name="city/town/district" value=""></td></tr>
<tr><td>Enter State</td><td><input type="text" name="state" value=""></td></tr>
<tr><td>Enter Landmark</td><td><input type="text" name="landmark" value=""></td></tr>
<tr><td>Enter Alternate Phone</td><td><input type="text" name="alter_phone" value=""></td></tr>
<tr><td>Address type</td><td><input type="radio" name="g1" value="Home">Home</input>
<input type="radio" name="g1" value="Work">Work</input></td></tr>



</table>

<input type="submit" name="save" value="SAVE AND DELIVER HERE">
<input type="submit" name="cancel" value="CANCEL">
<button><a href="cart.php">Cart</a></button>

</div>
</form>
</div>
</td>

<td>
       
<div class="col2">
    <div class="row">
<label>Total Amount : <?php echo $amt;?></label>
<label>User ID : <?php echo $_SESSION["user__id"];?></label>
<label>Order ID : <?php echo $_SESSION["oid"];?></label>
</div>
</div>

</td></tr>

</table>
</div>

    
</body>
</html>