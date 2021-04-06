<?php
include("connection2.php");
   session_start();
   if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    
    $query="select * from users where USER_EMAIL='$email'";
    $stmt = OCIParse($conn, $query);
    OCIExecute($stmt);
    $row=oci_fetch_array($stmt);
   
    if($row<=0){
        echo '<script>alert("User does not exist")</script>';
    }else{
        $_SESSION['user_id']=$row['USER_ID'];
         header("Location:index.php");
         die();
    }

   }

?>
<!DOCTYPE html>
<html lang="en">
    <head>

    </head>
    <body>
        <div class="header">
            <div class="header-logo">Myntra</div>
        </div>

        <div class="container">
            <form method="POST">
             <label for="email">Enter Email</label><br>
             <input type="email" name="email" placeholder="Enter email" required><br>
             <lable for ="password">Enter password</lable><br>
             <input type="password" name="password" placeholder="enter password" required><br>
             <input type="submit" name="login" value="Login">
            </form>
        </div>


    </body>
</html>