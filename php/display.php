<?php
session_start();
require_once 'db/connect.php';
// SQL query to select data from database
$sql = "SELECT * FROM products ";
$result = $conn->query($sql);

$sql_two = "SELECT * FROM products ";
$result_two = $conn->query($sql_two);



/// Adding to Cart
if(isset($_POST['cart']))
{	
   $p_id=$_POST['atc'];
	 $p_name = $_POST['pname'];
	 $p_price = $_POST['pprice'];
	 $category = $_POST['pcategory'];
   $uidd = $_POST['uid'];
   $qty=1;
  //  $array = array();
  //  $array[] = $rows;
  //  $_SESSION['arrayy']=$array;
  $existing="SELECT * FROM cart WHERE uid='$uidd' AND cid='$p_id' ";
  $resultt=mysqli_query($conn,$existing); 

  if(mysqli_num_rows($resultt)===1)
  {
    echo "existed";
  }else{
    $sqll= "INSERT INTO cart (cid,uid,c_Category,c_name,c_price,cart_qty)
	 VALUES ('$p_id','$uidd','$category','$p_name','$p_price','$qty')";
    $res = $conn->query($sql);

	 if (mysqli_query($conn, $sqll)) 
	 {
		echo "New Details Entry inserted successfully !";
    header('location:http://localhost/dashboard/Project/Project/php/display.php');
	 } 
	 else
     {
		echo "Error: " . $sqll . "" . mysqli_error($conn);
	 }
  }
}
// ADD TO CART END
// CART COUNT 
  $uiddd=$_SESSION["uid"];
    
    $sq ="SELECT COUNT(*) AS cartt FROM cart WHERE uid='".$uiddd."';";
    $qresult=$conn->query($sq);
    if (mysqli_query($conn, $sq)) {
     $r=mysqli_fetch_assoc($qresult);
    $count=$r['cartt'];
    $_SESSION["cartqty"]=$count;

    }
   else{
     echo "Error: " . $sq . "" . mysqli_error($conn);
   }
   $_SESSION["user__id"]=$uiddd;
    $conn->close();
// CART COUNT END   
//REDIRECTING TO LOGIN PAGE
    if(isset($_POST['lgnbtn'])){
      ?>
      <script type="text/javascript">
      window.location.href ='http://localhost/dashboard/Project/Project/php/login.php';
      </script>
      <?php
    }
//PRODUCT REDIRECTING TO VIEW PRODUCT    

if(isset($_POST['view'])){
  $p_id=$_POST['atc'];
  $_SESSION['detailid']=$p_id;
  $_SESSION['uid']=$_POST['uid'];
  header('location:http://localhost/dashboard/Project/Project/php/products-details.php'); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/display.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <title>Shopping Cart</title>
</head>
<body>
    <div class="full">

        <nav>
            <a href="#">Shopping Cart</a>
            <input type="search" name="search" placeholder="Search for Products.." id="">
            <a class="ccount" href="cart.php"><img src="../images/shopping-cart.png" width="40px" height="40px" alt="r"><p><?php echo $count;?></p></a>
            <a href="http://localhost/dashboard/Project/Project/php/login.php">Logout</a>
           
        </nav>
        
        <main>
            <div class="img"><img src="../images/Banner.jpg" width="100%" height="100%" alt="q"></div>
            <div class="catefull">
                <div class="cate">
                    <div class="cateimg"><img src="../Figma/gro.webp" width="90px" height="90px" alt=""></div>
                    <div class="catename"><p>Grocery</p></div>
                </div>
                <div class="cate">
                    <div class="cateimg"><img src="../Figma/elec.webp" width="90px" height="90px" alt=""></div>
                    <div class="catename"><p>Electronics</p></div>
                </div>
                <div class="cate">
                    <div class="cateimg"><img src="../Figma/mobile.webp"  width="90px" height="90px"  alt=""></div>
                    <div class="catename"><p>Mobiles</p></div>
                </div>
                <div class="cate">
                    <div class="cateimg"><img src="../Figma/ap.webp" width="90px" height="90px"  alt=""></div>
                    <div class="catename"><p>Appliances</p></div>
                </div>
                <div class="cate">
                    <div class="cateimg"><img src="../Figma/f.webp" width="90px" height="90px"   alt=""></div>
                    <div class="catename"><p>Fashion</p></div>
                </div>
                <div class="cate">
                    <div class="cateimg"><img src="../images/Toys&More.png"  width="90px" height="90px"   alt=""></div>
                    <div class="catename"><p>Toys&More</p></div>
                </div>
            </div>
            <div class="p">
            <p>Featured Products</p>
            </div>
            <div class="container">
                <div class="product-container">
                    <button class="pre-btn" style="font-size:50px; color:grey;">❯</button>
                    <button class="nxt-btn" style="font-size:50px; color:grey;">❯</button>             
                    <?php
                        // LOOP TILL END OF DATA
                        while($rows=$result->fetch_assoc())
                        {
                     ?> 
                      <form action="" method="POST">
                          <!-- <a href="products-details.html" style="text-decoration: none;"> -->
                              <div class="card">
                              <div class="image">
                            <button type="submit" name="view"><img src="../Figma/m2.jpg" /></button>
                               
                              </div>
                              <div class="pcate">
                              <p><?php echo $rows['p_category'];?></p>
                              </div>
                              <div class="details">
                              <p><?php echo $rows['p_name'];?></p>
                              <p><?php echo $rows['p_price'];?></p>
                              </div>
                              <div class="button" >
                              <input type="submit" name="cart"   value="Buy">
                              <!-- <p><input type="submit" name="view"   value="View"></p> -->
                              </div>
                            </div>
                            <p><input type="hidden" name="atc" value=<?php echo $rows['id'];?>></p>
                            <p><input type="hidden" name="uid" value=<?php echo $_SESSION["uid"];?>></p>
                            <p><input type="hidden" name="atc" value=<?php echo $rows['id'];?>></p>
                            <p><input type="hidden" name="pname" value=<?php echo $rows['p_name'];?>></p>
                            <p><input type="hidden" name="pprice" value=<?php echo $rows['p_price'];?>></p>
                            <p><input type="hidden" name="pcategory" value=<?php echo $rows['p_category'];?>></p>
                          <!-- </a> -->
                      </form>
                    <?php
                      }
                    ?>
                </div>
                
            </div>
            <div class="container">
              <div class="product-container">
                  <button class="pre-btn" style="font-size:50px; color:grey;">❯</button>
                  <button class="nxt-btn" style="font-size:50px; color:grey;">❯</button>
                
                  <form action="" method="POST">
                      <a href="#" style="text-decoration: none;">
                          <div class="card">
                          <div class="image">
                            <img src="../Figma/m2.jpg" />
                          </div>
                          <div class="pcate">
                          <p>Electronics</p>
                          </div>
                          <div class="details">
                          <p>Product Name</p>
                          <p>20,000</p>
                          </div>
                          <div class="button" >
                          <input type="submit" name="cart"   value="Buy">
                          <!-- <p><input type="submit" name="view"   value="View"></p> -->
                          </div>
                        </div>
                      </a>
                  </form>
                  <form action="" method="POST">
                    <a href="#" style="text-decoration: none;">
                        <div class="card">
                        <div class="image">
                          <img src="../images/m2.jpg" />
                        </div>
                        <div class="pcate">
                        <p>Electronics</p>
                        </div>
                        <div class="details">
                        <p>Product Name</p>
                        <p>20,000</p>
                        </div>
                        <div class="button" >
                        <input type="submit" name="cart"   value="Buy">
                        <!-- <p><input type="submit" name="view"   value="View"></p> -->
                        </div>
                      </div>
                    </a>
                </form>
                  <form action="" method="POST">
                    <a href="#" style="text-decoration: none;">
                        <div class="card">
                        <div class="image">
                          <img src="../Figma/m2.jpg" />
                        </div>
                        <div class="pcate">
                        <p>Electronics</p>
                        </div>
                        <div class="details">
                        <p>Product Name</p>
                        <p>20,000</p>
                        </div>
                        <div class="button" >
                        <input type="submit" name="cart"   value="Buy">
                        <!-- <p><input type="submit" name="view"   value="View"></p> -->
                        </div>
                      </div>
                    </a>
                </form>
                  <form action="" method="POST">
                    <a href="#" style="text-decoration: none;">
                        <div class="card">
                        <div class="image">
                          <img src="../Figma/m2.jpg" />
                        </div>
                        <div class="pcate">
                        <p>Electronics</p>
                        </div>
                        <div class="details">
                        <p>Product Name</p>
                        <p>20,000</p>
                        </div>
                        <div class="button" >
                        <input type="submit" name="cart"   value="Buy">
                        <!-- <p><input type="submit" name="view"   value="View"></p> -->
                        </div>
                      </div>
                    </a>
                </form>
                <form action="" method="POST">
                  <a href="#" style="text-decoration: none;">
                      <div class="card">
                      <div class="image">
                        <img src="../Figma/m2.jpg" />
                      </div>
                      <div class="pcate">
                      <p>Electronics</p>
                      </div>
                      <div class="details">
                      <p>Product Name</p>
                      <p>20,000</p>
                      </div>
                      <div class="button" >
                      <input type="submit" name="cart"   value="Buy">
                      <!-- <p><input type="submit" name="view"   value="View"></p> -->
                      </div>
                    </div>
                  </a>
                </form>
                <form action="" method="POST">
                <a href="#" style="text-decoration: none;">
                    <div class="card">
                    <div class="image">
                      <img src="../Figma/m2.jpg" />
                    </div>
                    <div class="pcate">
                    <p>Electronics</p>
                    </div>
                    <div class="details">
                    <p>Product Name</p>
                    <p>20,000</p>
                    </div>
                    <div class="button" >
                    <input type="submit" name="cart"   value="Buy">
                    <!-- <p><input type="submit" name="view"   value="View"></p> -->
                    </div>
                  </div>
                </a>
                </form>
                <form action="" method="POST">
                  <a href="#" style="text-decoration: none;">
                      <div class="card">
                      <div class="image">
                        <img src="../Figma/m2.jpg" />
                      </div>
                      <div class="pcate">
                      <p>Electronics</p>
                      </div>
                      <div class="details">
                      <p>Product Name</p>
                      <p>20,000</p>
                      </div>
                      <div class="button" >
                      <input type="submit" name="cart"   value="Buy">
                      <!-- <p><input type="submit" name="view"   value="View"></p> -->
                      </div>
                    </div>
                  </a>
                </form>
                <form action="" method="POST">
                  <a href="#" style="text-decoration: none;">
                      <div class="card">
                      <div class="image">
                        <img src="../Figma/m2.jpg" />
                      </div>
                      <div class="pcate">
                      <p>Electronics</p>
                      </div>
                      <div class="details">
                      <p>Product Name</p>
                      <p>20,000</p>
                      </div>
                      <div class="button" >
                      <input type="submit" name="cart"   value="Buy">
                      <!-- <p><input type="submit" name="view"   value="View"></p> -->
                      </div>
                    </div>
                  </a>
              </form>
              <form action="" method="POST">
                <a href="#" style="text-decoration: none;">
                    <div class="card">
                    <div class="image">
                      <img src="../Figma/m2.jpg" />
                    </div>
                    <div class="pcate">
                    <p>Electronics</p>
                    </div>
                    <div class="details">
                    <p>Product Name</p>
                    <p>20,000</p>
                    </div>
                    <div class="button" >
                    <input type="submit" name="cart"   value="Buy">
                    <!-- <p><input type="submit" name="view"   value="View"></p> -->
                    </div>
                  </div>
                </a>
            </form>
            <form action="" method="POST">
              <a href="#" style="text-decoration: none;">
                  <div class="card">
                  <div class="image">
                    <img src="../Figma/m2.jpg" />
                  </div>
                  <div class="pcate">
                  <p>Electronics</p>
                  </div>
                  <div class="details">
                  <p>Product Name</p>
                  <p>20,000</p>
                  </div>
                  <div class="button" >
                  <input type="submit" name="cart"   value="Buy">
                  <!-- <p><input type="submit" name="view"   value="View"></p> -->
                  </div>
                </div>
              </a>
          </form>
          <form action="" method="POST">
            <a href="#" style="text-decoration: none;">
                <div class="card">
                <div class="image">
                  <img src="../Figma/m2.jpg" />
                </div>
                <div class="pcate">
                <p>Electronics</p>
                </div>
                <div class="details">
                <p>Product Name</p>
                <p>20,000</p>
                </div>
                <div class="button" >
                <input type="submit" name="cart"   value="Buy">
                <!-- <p><input type="submit" name="view"   value="View"></p> -->
                </div>
              </div>
            </a>
          </form>
          <form action="" method="POST">
            <a href="#" style="text-decoration: none;">
                <div class="card">
                <div class="image">
                  <img src="../Figma/m2.jpg" />
                </div>
                <div class="pcate">
                <p>Electronics</p>
                </div>
                <div class="details">
                <p>Product Name</p>
                <p>20,000</p>
                </div>
                <div class="button" >
                <input type="submit" name="cart"   value="Buy">
                <!-- <p><input type="submit" name="view"   value="View"></p> -->
                </div>
              </div>
            </a>
          </form>
          </div>     
          </div>

          <footer>
            <div class="fullfooter">
              <div class="logo">
                <h1>ShoppingCart</h1>
              </div>
                <div class="center">
                  <div class="social">
                <label id="bold">FOLLOW US</label>
                <div class="social-or">
                <img src="../images/facebook.png" width="40px" height="40px" alt="f">
                <img src="../images/twitter.png" width="40px" height="40px" alt="t">
                <img src="../images/instagram.png" width="40px" height="40px" alt="i">
              </div>
              </div>    
              <div class="social">
                <label  id="bold">VISIT US</label>
              <div class="v">
                <label>Maps & Directions</label>
                <label>Plan Your Visit</label>
                <label>Virtual Tour</label>
              </div>
            </div>
                </div>
                <div class="right">
                <div class="social">
                <label id="bold">SUPPORT US</label>
                <button>Donate</button>
                <label id="bold">WORK WITH US</label>
                <label for="">View Jobs</label>
              </div>
            </div>
         
              
          </footer>
        </main>

          
    
    </div>
  
    <script src="../js/script.js"></script>
</body>
</html>