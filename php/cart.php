<?php
session_start();
require_once 'db/connect.php';

$uid=$_SESSION["user__id"];

$sql_dup="SELECT `cid`, `uid`, `c_category`, `c_name`, `c_price`,sum(cart_qty) AS value_sum from `cart` WHERE uid='".$uid."' GROUP BY `cid`  ;" ;
$result = $conn->query($sql_dup);


$sq ="SELECT COUNT(*) AS cartt FROM cart WHERE uid='".$uid."';";
$qresult=$conn->query($sq);
if (mysqli_query($conn, $sq)) {
 $r=mysqli_fetch_assoc($qresult);
$qcount=$r['cartt'];
$_SESSION['count']=$qcount;

}
else{
 echo "Error: " . $sq . "" . mysqli_error($conn);
}
// $sql_query = "SELECT `cid`, `uid`, `c_category`, `c_name`, `c_price`,`cart_qty` FROM `cart` WHERE uid='".$uid."';";
// $result = $conn->query($sql_query);  
//// REDIRECT TO DISPLAY PAGE
if(isset($_POST['disbtn'])){
    ?>
    <script type="text/javascript">
window.location.href = 'http://localhost/dashboard/Project/Project/php/display.php';
</script>
<?php  
}
if(isset($_POST['chkoutbtn'])){
    if(mysqli_num_rows($result)===0)
    {echo "No Products";}
    else{
    $orderid=rand(100000,999999);
    $_SESSION['oid']=$orderid;

    ?>
    <script type="text/javascript">
window.location.href = 'http://localhost/dashboard/Project/Project/php/checkoutdemo.php';
</script>
<?php  
    }
}

    $total_amt="SELECT sum(c_price*cart_qty) AS total FROM `cart` WHERE uid='$uid'";
    $totalamt=$conn->query($total_amt);
        if (mysqli_query($conn, $total_amt)) 
        {
            $r=mysqli_fetch_assoc($totalamt);
            $count=$r['total']+100;
            $_SESSION['totalcart']=$count;
        } 
        else
        {
           echo "Error: " . $total_amt . "" . mysqli_error($conn);
        }
        mysqli_close($conn);
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script type="text/javascript" src="../js/custom.js"></script>
    <link rel="stylesheet" href="../css/cart.css">
    <title>Cart Page</title>
</head>
<body>
    <div class="full">
        <nav>
            <a href="#">Shopping Cart</a>
            <!-- <input type="search" name="search" placeholder="Search for Products.." id=""> -->
            <a href="display.php">Home</a>
            <a href="#">My Account</a>
        </nav>
<?php
$value=0;
    if(mysqli_num_rows($result)===0)
{

    ?>
<main>
<div class="main1">
    <h1>Cart Is Empty</h1>
    <a href="display.php"><button>Shop</button></a>
</div>
</main>
<?php
}else{
?>
<main>
<div class="main">

    <div class="col1">
        <div class="head">
        <h3>Cart Details</h3>
      
        </div>
     
     
        <div class="inner-nav">
            <p>Product Name</p>
            <p style="margin-left:16%;">Quantity</p>
            <p>Price</p>
            <p>Sub-Total</p>
        </div>
   <!-- end -->
<?php
$pids=[];

while($rows=$result->fetch_assoc())
{
    $pids[]=$rows['cid'];
 ?>
<form action="" method="POST">
<div class="card">
<div class="image">
<img src="../images/m2.jpg" alt="null" />
</div>
<div class="data">
<label><?php echo $rows['c_name']; ?></label>
<!-- <label class="price" name="price" value="<?php echo $rows['c_price'];?>"><?php echo $rows['c_price'];?></label> -->
<!-- <label><?php echo $rows['c_category']; ?></label> -->
<div class="dataa">
<button type="submit" class="decrement updateQty">-</button>
<input  type="text" name="input-qty" class="input-qty" value=<?php echo $rows['value_sum'];?>>
<button type="submit" class="increment updateQty">+</button>
</div>
<label class="price" name="price" value="<?php echo $rows['c_price'];?>"><?php echo $rows['c_price'];?></label>
<!-- <input  type="number" name="total" class="total" value="<?php echo $rows['c_price']*$rows['value_sum']?>" disabled> -->
<div class="dataa">
<button type="submit" class="remove">Remove</button>
<input  type="hidden" name="cartidd" class="cartidd" value="<?php echo $rows['cid']?>" disabled>
<input  type="hidden" name="useridd" class="useridd" value="<?php echo $rows['uid']?>" disabled>
</div>
</div>
</div>
</form>
<?php

}

$_SESSION['productid']=$pids;
?>


    <!-- </div> -->
</div>

<div class="col2">
    <h3>Price Details</h1>
    <div class="cate">
    <table>
        <tbody><tr class="order">
    </tr>

    <tr>
        <td style="text-align:start;padding-left: 10px;">Subtotal</td>
        <td><input id="amt" class="amt" name="amt" value="<?php echo "₹ ".$count;?>" disabled=""></td>
    </tr>
    <tr>
        <td style="text-align:start;padding-left: 10px;">
            Shipping Charges
        </td>
        <td><label style="text-align:end" name="ship" value="100">₹ 100</label></td>

    </tr>
    <tr>
        <td style="text-align:start;padding-left: 10px;">Total</td>
    <td><input id="amt" class="amt" name="amt" value="<?php echo "₹ ".$count+100;?>" disabled=""></td>
    </tr>


    </tbody>
    </table>
    <form action="" method="POST">
<div class="plor">

<input  type="submit" name="disbtn" value="More Shopping"></input>
<input type="submit" name="chkoutbtn" value="Place Order"></input>

</div>
</form>
</div>

</div>



</div>
</main>      

<?php
}
?>
    </div>
</body>
</html>