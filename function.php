<?php 

function createwishlist($user_id){
    include("connection2.php");
    $name=$_POST['wishlistname'];
    $query="select * from dresslist where DRESSLIST_NAME='$name'";
    $stmt=OCIParse($conn,$query);
    $res=OCIExecute($stmt);
    $row=oci_fetch_array($stmt);
    if($row>0){
        echo '<script>alert("wishlist already exist")</script>';

    }else{
    $query2="insert into dresslist values('$name','private',$user_id)";
    $stmt2=OCIParse($conn,$query2);
    OCIExecute($stmt2);
    }
}

function showwishlist(){
    header("Location:wishlist.php");
    die();
  }
  
  function deletedresslist($user_id){
      include("connection2.php");
      $dresslist_name=$_POST['dresslist_name'];
      $delete_dresslist="Select *  from dresslist  where DRESSLIST_NAME='$dresslist_name' AND USER_ID='$user_id'";
      $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
      OCIExecute($delete_dresslist_stmt);
      if($row=oci_fetch_array($delete_dresslist_stmt)<=0){
        $delete_dresslist="Delete from sharedresslist  where DRESSLIST_NAME='$dresslist_name' AND SHARE_ID='$user_id'";
        $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
        OCIExecute($delete_dresslist_stmt);
      

      }else{
      $delete_dresslist="Delete from dresslist  where DRESSLIST_NAME='$dresslist_name' AND USER_ID='$user_id'";
      $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
      OCIExecute($delete_dresslist_stmt);
      $delete_dresslist="Delete from addproduct  where DRESSLIST_NAME='$dresslist_name'";
      $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
      OCIExecute($delete_dresslist_stmt);
      $delete_dresslist="Delete from sharedresslist  where DRESSLIST_NAME='$dresslist_name' AND USER_ID='$user_id'";
        $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
        OCIExecute($delete_dresslist_stmt);
      }

  }
  function deleteproduct($product_id){
    include("connection2.php");
     
    $delete_dresslist="Delete from addproduct  where PRODUCT_ID='$product_id' ";
    $delete_dresslist_stmt=OCIParse($conn,$delete_dresslist);
    OCIExecute($delete_dresslist_stmt);
   }
   
   function changeAccess($dresslist_name,$access){
       include("connection2.php");
      $update_access= "UPDATE dresslist  SET DRESSLIST_ACCESS = '$access' WHERE DRESSLIST_NAME = '$dresslist_name'";  
      $update_access_stmt=OCIParse($conn,$update_access);
      OCIExecute($update_access_stmt);
  
    }

    function share_product($user_id,$dresslist_name,$email){
        include("connection2.php");
      $query="select * from users where USER_EMAIL='$email'";
      $stmt=OCIParse($conn,$query);
      OCIExecute($stmt);
      $row=oci_fetch_array($stmt);
      $user_id1=$row['USER_ID'];
      $query="insert into sharedresslist values('$user_id','$dresslist_name','$user_id1')";
      $stmt=OCIParse($conn,$query);
      OCIExecute($stmt);
      }
    
           
      
  ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="other.css">
</head>
</html>
