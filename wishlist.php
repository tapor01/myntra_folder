<?php
session_start();
$user_id=$_SESSION['user_id'];
$product_id=$_SESSION['product_id'];

include("connection2.php");
include("function.php");

if(isset($_POST['submit'])){
$_SESSION['dresslist_name']=$_POST['dresslist_name'];

header("Location:viewproduct.php");
die();
}
if(isset($_POST['create'])){
    createwishlist($user_id);
}

if(isset($_POST['delete'])){
    deletedresslist($user_id);
}
if(isset($_POST['search'])){
    header("Location:search.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="wishlist1.css">
    </head>
    <body>
        <script src="wishlist.js"></script>
        <script src="backbutton.js"></script>
        <?php 
        $count="select * from dresslist where USER_ID='$user_id'";
        $count_stmt=OCIParse($conn,$count);
        OCIExecute($count_stmt);
         $num=0;
        while(oci_fetch_array($count_stmt)){
          $num=$num+1;
        }
        
        
        ?>
        <div class="header">
            <div class="header-logo">Myntra</div>
            <div class="heading">Your Wishlist</div>
            <div class="count">Number of dresslist~ <?php echo $num?></div>
            <div class="wishlist">
                <button  id ="button1" onclick="myFunction1()">Create</button>
             </div>
             <div class="back">
              <button onclick="backfunction()">Back</button>
           </div>
          
        </div>
        <div class="search">
              <form method="POST">

              <input type="submit" value="Search Dresslist" name="search" >

              </form>
            </div>
     <?php
         $query="select * from dresslist where USER_ID='$user_id'";
         $stmt=OCIParse($conn,$query);
         OCIExecute($stmt);
         while($row=oci_fetch_array($stmt)){
            $dresslist_name=$row['DRESSLIST_NAME'] ;
            $user_id=$row['USER_ID'];
            $query2="select * from users where USER_ID='$user_id'";
            $stmt2=OCIParse($conn,$query2);
            OCIExecute($stmt2);
            $row2=oci_fetch_array($stmt2);
            $user_name=$row2['USER_NAME'];
            $count_product="select * from addproduct where DRESSLIST_NAME='$dresslist_name'";
            $count_product_stmt=OCIParse($conn,$count_product);
            OCIExecute($count_product_stmt);
            $count_product_number=0;
            while(oci_fetch_array($count_product_stmt)){
                $count_product_number=$count_product_number+1;
            }
        ?><div class="dresslistdisplay">
    <label name="dresslist_name ">Your Dresslist -</label>
        <form method="POST">
    <input type="text" value=<?php echo $row['DRESSLIST_NAME'] ;?> name="dresslist_name" class="name" readonly><br>
    <lable class="number_item">Number of items~<?php echo $count_product_number?></lable><br>
    <label for="user">Created By-</label>
    <input type="text" value=<?php echo $user_name;?> name="user_id"  class="user" readonly><br>
    <input type="submit" class="view" value="View DressList" name="submit" id="change">
    <input type="submit" value="Delete DressList" name="delete" id="delete" class="delete">
         </form>
     </div>
<?php } ?>

<?php
         $query="select * from sharedresslist where SHARE_ID='$user_id'";
         $stmt=OCIParse($conn,$query);
         OCIExecute($stmt);
         while($row=oci_fetch_array($stmt)){
            $dresslist_name=$row['DRESSLIST_NAME'] ;
            $user_id=$row['USER_ID'];
            $query2="select * from users where USER_ID='$user_id'";
            $stmt2=OCIParse($conn,$query2);
            OCIExecute($stmt2);
            $row2=oci_fetch_array($stmt2);
            $user_name=$row2['USER_NAME'];
            $count_product="select * from addproduct where DRESSLIST_NAME='$dresslist_name'";
            $count_product_stmt=OCIParse($conn,$count_product);
            OCIExecute($count_product_stmt);
            $count_product_number=0;
            while(oci_fetch_array($count_product_stmt)){
                $count_product_number=$count_product_number+1;
            }
        ?><div class="dresslistdisplay">
    <label name="dresslist_name ">Your Dresslist -</label>
        <form method="POST">
    <input type="text" value=<?php echo $row['DRESSLIST_NAME'] ;?> name="dresslist_name" class="name" readonly><br>
    <lable class="number_item">Number of items~<?php echo $count_product_number?></lable><br>
    <label for="user">Created By-</label>
    <input type="text" value=<?php echo $user_name;?> name="user_id"  class="user" readonly><br>
    <input type="submit" class="view" value="View DressList" name="submit" id="change">
    <input type="submit" value="Delete DressList" name="delete" id="delete" class="delete">
         </form>
     </div>
<?php } ?>
<div class=wishlistcontainer1 id="wishlistcontainer1">
        <form method="POST">
         <h6>    Create Your own dresslist!<h6>   
        <input  type="text" name="wishlistname" placeholder="Enter name" required><br>
        <input type="submit" name="create" class="button" value="Create">
         </form>
         <button  class="cancel" onclick="cancel1()">Cancel</button>
        
    </div>
   
    </body>
</html>