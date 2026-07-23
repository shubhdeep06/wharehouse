<?php

  $con=mysqli_connect("localhost","root","","login");
  if(!$con){
     die("connection failed");
  }
  $message="";
  if($_SERVER["REQUEST_METHOD"]=="POST"){
  $id=$_POST['id'];
  $paas=$_POST['paas'];
  $sql1=" SELECT * FROM `users` 
  WHERE id='$id'AND paas='$paas' ";
   
   $result=mysqli_query($con,$sql1);

        if( mysqli_num_rows($result)>0){
          $message="login  Successfully";
       
        }
        else{
          $message="invalid password" ;
        }
          
  }
  mysqli_close($con);
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="abc.css">
  <title>Document</title>
</head>
<body>
  <div class="cont">
    <form action="abc.php" method="post">
      <input type="text" name="id" placeholder="enter id" required>
      <input type="password" name="paas" placeholder="enetr the password" required>
      <button>submit</button>
     <p style="color:red; margin-top:15px;">
      <?php
        if (isset($message)) {
            echo $message;
        }
        ?>
    </p>
    <a href="/PHP/forget.php">forget password</a>
    </form>
    
  
  </div> 
</body>
</html>