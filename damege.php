<?php
$con=mysqli_connect("localhost","root","","login");
if(!$con){
  die("connection Failed");
}
if(isset($_POST['search'])){
  $barcode=$_POST['barcode'];
  $sql = "SELECT barcode,
               product_name,
               quantity,
               selling_price,
               image
        FROM products
        WHERE barcode = '$barcode'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      //  echo "product name:",$row['product_name']."<br>";
      // echo "quantity:",$row['quantity']."<br>" ;
      // echo" selling price:",$row['selling_price']."<br>";
      // echo "<img src='images/".$row['image']."' width='180' height='180' alt='Product Image'>";

    }
}
    if(isset($_POST['submit'])){
      $barcode=$_POST['barcode'];
      $damage_qty=$_POST['damage_qty'];
      $reason=$_POST['reason'];
      $remarks=$_POST['remarks'];
      $sql="INSERT INTO `damaged_products`( `barcode`, `damage_qty`, `reason`, `remarks` ) VALUES ('$barcode','$damage_qty','$reason','$remarks')";
      if(mysqli_query($con,$sql)){
        // echo "Inserted Successfully";
        // Update stock
        $update="UPDATE products
                 SET quantity=quantity-$damage_qty
                 WHERE barcode=$barcode";

        mysqli_query($con,$update);

        echo "Damage Recorded Successfully";
       
    }
    else{
       echo mysqli_error($con);
    }
    }
    


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="damege.css">
  <title>damege product</title>
</head>
<body>
  <div class="container">
    <form action="damege.php" method="post">
      <input type="text" name="barcode" placeholder="enter the barcode">
      <button type="submit" name="search">
        Search
    </button>
      
    </form>
    <?php if(isset($row)){ ?>

<div class="product-card">

    <div class="product-image">
        <img src="images/<?php echo $row['image']; ?>" alt="Product Image">
    </div>

    <div class="product-details">

        <h2>Product Details</h2>

        <p><strong>Product Name:</strong> <?php echo $row['product_name']; ?></p>

        <p><strong>Barcode:</strong> <?php echo $row['barcode']; ?></p>

        <p><strong>Available Stock:</strong> <?php echo $row['quantity']; ?></p>

        <p><strong>Selling Price:</strong> ₹<?php echo $row['selling_price']; ?></p>

        <div class="damage-form">
          <form action="damege.php" method="post">

            <label>Damage Quantity</label>
            <input type="hidden" name="barcode"
       value="<?php echo $row['barcode']; ?>">
            <input type="number" name="damage_qty" placeholder="Enter Damage Quantity" required>

            <label>Reason</label>
            <select name="reason" required>
                <option>Expired</option>
                <option>Broken</option>
                <option>Leakage</option>
                <option>Manufacturing Defect</option>
                <option>Other</option>
            </select>

            <label>Remarks</label>
            <textarea placeholder="Enter Remarks" name="remarks"></textarea>

             <button type="submit" name="submit">
              submit
             </button>
          </form>

        </div>


    </div>

</div>

<?php } ?>
  </div>
</body>
</html>