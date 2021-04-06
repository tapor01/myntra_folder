<?php
session_start();
$user_id=$_SESSION['user_id'];
$product_id=$_SESSION['product_id'];

include("connection2.php");
include("function.php");

if(isset($_POST['submit'])){
$dresslist_name=$_POST['dresslist_name'];
$query3="select * from addproduct where DRESSLIST_NAME='$dresslist_name' AND  PRODUCT_ID='$product_id'"  ; 
$stmt3=OCIParse($conn,$query3);
OCIExecute($stmt3);
$row3=oci_fetch_array($stmt3);
if($row3<=0){
$query3="insert into addproduct values('$dresslist_name','$product_id')";
$stmt3=OCIParse($conn ,$query3);
OCIExecute($stmt3);


}else{
$query3="delete from addproduct where DRESSLIST_NAME='$dresslist_name' AND PRODUCT_ID='$product_id'";
$stmt3=OCIParse($conn ,$query3);
OCIExecute($stmt3);

}

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="addproduct.css">
        <link rel="stylesheet" href="addproduct1.css">
    </head>
    <body>
        <script src="backbutton.js"></script>
       
        
        <div class="header">
            <div class="header-logo">Myntra</div>
            <div class="heading">Your Wishlist</div>
            <div class="wishlist">
                <button onclick="myFunction()">Create</button>
             </div>
        </div>
        <div class="back">
            <button onclick="backfunction()">Back</button>
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
            $query4="select * from addproduct where DRESSLIST_NAME='$dresslist_name' AND  PRODUCT_ID='$product_id'"  ; 
            $stmt4=OCIParse($conn,$query4);
            OCIExecute($stmt4);
            $row4=oci_fetch_array($stmt4);
            if($row4<=0){
                $value="Addtoyourdresslist";
            }else{
                $value="Removefromwishlist";
            }

             ?>
    <div class="dresslistdisplay">
    <label name="dresslist_name ">Your Dresslist -</label>
        <form method="POST">
    <input type="text" value=<?php echo $dresslist_name;?> name="dresslist_name" class="name" readonly><br>
   
    <label for="user">Created By</label>
    <input type="text" value=<?php echo $user_name;?> name="user_id"  class="user" readonly><br>
    <input type="submit" value=<?php echo $value;?> name="submit" id="change">
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
            $query4="select * from addproduct where DRESSLIST_NAME='$dresslist_name' AND  PRODUCT_ID='$product_id'"  ; 
            $stmt4=OCIParse($conn,$query4);
            OCIExecute($stmt4);
            $row4=oci_fetch_array($stmt4);
            if($row4<=0){
                $value="Addtoyourdreslist";
            }else{
                $value="Removefromdresslist";
            }

             ?>
    <div class="dresslistdisplay">
    <label name="dresslist_name ">Your Dresslist -</label>
        <form method="POST">
    <input type="text" value=<?php echo $dresslist_name;?> name="dresslist_name" class="name" readonly><br>
   
    <label for="user">Created By</label>
    <input type="text" value=<?php echo $user_name;?> name="user_id"  class="user" readonly><br>
    <input type="submit" value=<?php echo $value;?> name="submit" id="change">
         </form>
     </div>
<?php } ?>


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