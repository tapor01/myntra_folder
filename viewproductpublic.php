<?php
session_start();
$user_id=$_SESSION['user_id'];
$dresslist_name=$_SESSION['dresslist_name'];

include("connection2.php");
include("function.php");

if(isset($_POST['submit'])){
  deleteproduct($_POST['product_id']);
}
if(isset($_POST['Access1'])){
    
    changeAccess($dresslist_name,$_POST['access']);
}

if(isset($_POST['email_shared'])){
    share_product($user_id,$dresslist_name,$_POST['email']);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="viewproduct.css">
        <link rel="stylesheet" href="other.css">
</head>
<body>
<script src="backbutton.js"></script>
<?php  
        $count="select * from addproduct where DRESSLIST_NAME='$dresslist_name'";
        $count_stmt=OCIParse($conn,$count);
        OCIExecute($count_stmt);
      
         $num=0;
        while(oci_fetch_array($count_stmt)){
          $num=$num+1;
        }?>
   

        <div class="header">
            <div class="header-logo">Myntra</div>
            <div class="heading"><?php echo $dresslist_name;?></div>
            <div class="count">Number of items~ <?php echo $num;?></div>
            <div class="Access">
           <label for="access">Access: Public</label>
               
            </div>
             <div class="back">
              <button onclick="backfunction()">Back</button>
           </div>

        </div>
   <?php $query="select *  from addproduct where DRESSLIST_NAME='$dresslist_name' ";
$stmt = OCIParse($conn, $query);
OCIExecute($stmt);
   while($row1=oci_fetch_array($stmt,OCI_ASSOC)){
       $product_id=$row1['PRODUCT_ID'];
       $query1="select *  from product where PRODUCT_ID='$product_id'";
       $stmt1 = OCIParse($conn, $query1);
       OCIExecute($stmt1);
       while($row=oci_fetch_array($stmt1,OCI_ASSOC)){
      ?>
    <div class="container" >
     
           
       <label for="product_id">Product id</label>
         <input name="product_id" value=<?php echo $row['PRODUCT_ID'];?> onkeydown="return false"><br>
         <label for="product_name">Product Name</label>
         <input name="product_name" value=<?php echo $row['PRODUCT_NAME']; ?> onkeydown="return false"><br>
         <label for="product_price">Product Price</label>
         <input name="product_price" value=<?php echo $row['PRODUCT_PRICE'];?> onkeydown="return false"><br>
         <label for="product_desc">Product Description</label>
         <input name="product_desc" value=<?php echo $row['PRODUCT_DESC'];?> onkeydown="return false"><br>
       
     </div>
     <?php }}?>
   
    </body>
</html>
