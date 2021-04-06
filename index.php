<?php
session_start();
$user_id=$_SESSION['user_id'];

include("connection2.php");
include("function.php");
$query="select *  from product";
$stmt = OCIParse($conn, $query);
OCIExecute($stmt);
if(isset($_POST['submit'])){
   $_SESSION['product_id']=$_POST['product_id'];
   header("Location: addproduct.php");
}
if(isset($_POST['create'])){
     createwishlist($user_id);
}

if(isset($_POST['showwishlist'])){
    showwishlist();
}
if(isset($_POST['logout'])){
    session_start();
    session_destroy();
header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style2.css">
        <link rel="stylesheet" href="other.css">
        <link rel="stylesheet" href="logout.css">
</head>
<body>
    <script src="javascript.js"></script>

        <div class="header">
            <div class="header-logo">Myntra</div>
            <div class="wishlist">
                <button onclick="myFunction()">Create wishlist</button>
            </div>
            <div class="showwishlist">    
                <form method="POST">
                <input class="button" name="showwishlist" type="submit" value=" Go to Wishlist"></form>
            </div>
          
        </div>
        <div class="logout1">
                <form method="POST">
                <input type="submit" name="logout" value="Logout" class="lehar">
              </form>
        </div>

   <?php while($row=oci_fetch_array($stmt,OCI_ASSOC)){
      ?>
    <div class="container" >
       <form method="POST">
           
       <label for="product_id">Product id</label>
         <input name="product_id" value=<?php echo $row['PRODUCT_ID'];?> onkeydown="return false"><br>
         <label for="product_name">Product Name</label>
         <input name="product_name" value=<?php echo $row['PRODUCT_NAME']; ?> onkeydown="return false"><br>
         <label for="product_price">Product Price</label>
         <input name="product_price" value=<?php echo $row['PRODUCT_PRICE'];?> onkeydown="return false"><br>
         <label for="product_desc">Product Description</label>
         <input name="product_desc" value=<?php echo $row['PRODUCT_DESC'];?> onkeydown="return false"><br>
         <input type="submit" class="button" name="submit" value="wishlist">
        
          </form>
     </div>
     <?php }?>

     <div class=wishlistcontainer id="wishlistcontainer">
        <form method="POST">
         <h6>    Create Your own dresslist!<h6>   
        <input  type="text" name="wishlistname" placeholder="Enter name" required><br>
        <input type="submit" name="create" class="button" value="Create">
         </form>
        <button  class="cancel" onclick="cancel()">Cancel</button>
        <div class="popup" id="popup">Dress Already Exist</div>
    </div>
     
    
    </body>
</html>
