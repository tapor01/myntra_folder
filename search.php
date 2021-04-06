<?php
session_start();
include("connection2.php");
include("function.php");
 $a="public";
 $query="select * from dresslist where DRESSLIST_ACCESS='$a'";
 $stmt=OCIParse($conn,$query);
 OCIExecute($stmt);
 if(isset($_POST['submit'])){
    $_SESSION['dresslist_name']=$_POST['dresslist_name'];
    header("Location:viewproductpublic.php");
    die();
 }
 if(isset($_POST['search'])){
  
    $a="public";
     $searched=$_POST['searched'];  
     
    $query="select * from dresslist where DRESSLIST_ACCESS='$a' AND DRESSLIST_NAME LIKE '%$searched%'";
    
    $stmt=OCIParse($conn,$query);
    OCIExecute($stmt);
    
 }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="search.css">
    </head>
    <body>
        <script src="wishlist.js"></script>
        <script src="backbutton.js"></script>
        <div class="header">
            <div class="header-logo">Myntra</div>
           
            
          
        </div>
        <div class="search">
              <form method="POST">
              <input type="search" name="searched" placeholder="Enter dresslistname">
              <input type="submit" value="Search Dresslist" name="search" >

              </form>
            </div>
     <?php
        
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
    
         </form>
     </div>
<?php } ?>



   
    </body>
</html>