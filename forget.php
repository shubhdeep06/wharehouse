<?php

$conn = mysqli_connect("localhost","root","","login");

if(!$conn){
    die("Connection Failed");
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $id=$_POST['id'];
    $email=$_POST['email'];
    $paas=$_POST['paas'];
    $name=$_POST['name'];
    $post=$_POST['post'];
    $phon_no=$_POST['phon_no'];

    $sql="INSERT INTO users(id,email,paas,name,post,phon_no)
          VALUES('$id','$email','$paas','$name','$post','$phon_no')";

    if(mysqli_query($conn,$sql)){
        // echo "Inserted Successfully";
       
    }else{
        echo mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Document</title>
</head>
<body>
  <div class="main">
    <h2>student login</h2>
    <form action="forget.php" method="POST">

<input type="text" name="id" placeholder="Enter ID" required>

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="paas" placeholder="Enter Password" required>


<input type="name" name="name" placeholder="Enter NAME" required>


<select name="post" id="post" required>
    <option value="">-- Select Post --</option>
    <option value="Admin">Admin</option>
    <option value="Manager">Manager</option>
    <option value="Staff">Staff</option>
</select>

<input type="text" name="phon_no" placeholder="Enter phone no" required>
<button type="submit">Submit</button>

</form>
  </div>
  <script src="ind.js"></script>
</body>
<!-- INSERT INTO `student` (`id`, `email`, `password`) VALUES ('11111', 'shubhdeep@gmail.com', 'shubh@2006'); -->
</html>