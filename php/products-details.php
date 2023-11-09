<?php
session_start();
require_once 'db/connect.php';
$productid=$_SESSION['detailid'];
$userid=$_SESSION['uid'];
$sql = "SELECT * FROM products WHERE id=".$productid."";
$result = $conn->query($sql);
// LOOP TILL END OF DATA
$rows=$result->fetch_assoc();
$sq ="SELECT COUNT(*) AS cartt FROM cart WHERE uid='".$userid."';";
$qresult=$conn->query($sq);
if (mysqli_query($conn, $sq)) {
 $r=mysqli_fetch_assoc($qresult);
$qcount=$r['cartt'];
$_SESSION['count']=$qcount;

}
else{
 echo "Error: " . $sq . "" . mysqli_error($conn);
}
/// Adding to Cart
if(isset($_POST['cart']))
{	
     $p_id=$productid;

   $qty=1;
  //  $array = array();
  //  $array[] = $rows;
  //  $_SESSION['arrayy']=$array;
  $existing="SELECT * FROM cart WHERE uid='$userid' AND cid='$p_id' ";
  $resultt=mysqli_query($conn,$existing); 
  $productname=$rows['p_name'];
  $productprice=$rows['p_price'];
  $category=$rows['c_category'];
  if(mysqli_num_rows($resultt)===1)
  {
    echo "existed";
  }else{
    $sqll= "INSERT INTO cart (cid,uid,c_Category,c_name,c_price,cart_qty)
	 VALUES ('$p_id','$userid','$category','$productname','$productprice','$qty')";
    $res = $conn->query($sql);

	 if (mysqli_query($conn, $sqll)) 
	 {
		echo "New Details Entry inserted successfully !";
        header('location:http://localhost/dashboard/Project/Project/php/cart.php');
	 } 
	 else
     {
		echo "Error: " . $sqll . "" . mysqli_error($conn);
	 }
  }
}
// ADD TO CART END

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product-Detail Page</title>
    <link rel="stylesheet" href="../css/pdetails.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="../js/image.js"></script>
</head>
<body>
    <div class="full">
    <nav>
        <a href="#">Shopping Cart</a>
        <input type="search" name="search" placeholder="Search for Products.." id="">
        <a class="ccount" href="cart.php"><img src="../images/shopping-cart.png" width="40px" height="40px" alt="r"><p><?php echo $qcount;?></p></a>
        <a href="#">My Account</a>
    </nav>


    <div class="main-detail">
    <div class="imgfull">
        <div class="imagesection">
                <img onmouseover="clickimg(this)" src="../Figma/m2.jpg" alt="">
                <img onmouseover="clickimg(this)" src="../Figma/m3.jpg" alt="">
                <img onmouseover="clickimg(this)" src="../Figma/m4.jpg" alt="">
                <img onmouseover="clickimg(this)" src="../Figma/mobile1.jpg" alt="">
        </div>
        <div class="imgrow">
            <img id="id" src="../Figma/m2.jpg" width="" alt="">
        </div>
        <form action="" method="post">
        <div class="details">

            <label id="h1"><?php echo $rows['p_name'];?></label>
            <label>+++++</label>
            <Label>INR <?php echo $rows['p_price'];?></Label>
            <div class="qty">
            <button>-</button>
            <label>1</label>
            <button>+</button>
            </div>
            <input type="submit" name="cart"   value="Buy">
            <button>Add To Cart</button>
           
        </div>
        </form>
    </div>

    </div>

    </div>
</body>
</html>