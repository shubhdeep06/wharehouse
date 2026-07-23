<?php
$conn = mysqli_connect("localhost","root","","login");

if(!$conn){
    die("Connection Failed");
}


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $barcode = $_POST['barcode'];

    $sql = "SELECT * FROM products WHERE barcode='$barcode'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        // Display product details here

    }else{
        echo "Product not found.";
    }

    if(isset($_POST['delete'])){
    // $barcode =$_POST['barcode'];
    $sql="DELETE FROM products WHERE barcode = '$barcode'";
    
    if(mysqli_query($conn,$sql)){
        echo"deleted succesfully";

    }
    else{
        echo mysqli_error($conn);
    } 
     }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Product</title>
    <link rel="stylesheet" href="delete.css">
</head>
<body>


<div class="container">

    <!-- <form action="delete.php" method="POST">
        ...
    </form> -->

    <?php if(isset($row)){ ?>
    <div class="product-card">

        <div class="product-image">
            <img src="images/<?php echo $row['image']; ?>">
        </div>

        <div class="product-details">

            <h2>Product Details</h2>

            <p><strong>Product Name:</strong> <?php echo $row['product_name']; ?></p>
            <p><strong>Barcode:</strong> <?php echo $row['barcode']; ?></p>
            <p><strong>Category:</strong> <?php echo $row['category_id']; ?></p>
            <p><strong>Supplier:</strong> <?php echo $row['supplier_id']; ?></p>
            <p><strong>Purchase Price:</strong> ₹<?php echo $row['purchase_price']; ?></p>
            <p><strong>Selling Price:</strong> ₹<?php echo $row['selling_price']; ?></p>
            <p><strong>Quantity:</strong> <?php echo $row['quantity']; ?></p>
            <p><strong>Minimum Stock:</strong> <?php echo $row['minimum_stock']; ?></p>
            <p><strong>Description:</strong> <?php echo $row['description']; ?></p>

            <form action="delete.php" method="POST">

    <input type="hidden"
           name="barcode"
           value="<?php echo $row['barcode']; ?>">

    <button type="submit" name="delete">
        Delete Product
    </button>

</form>

            <!-- <div class="btns">
                <button class="delete-btn">Delete Product</button>
                <button class="cancel-btn" type="button">Cancel</button>
            </div> -->

        </div>

    </div>
    <?php } ?>

</div>

</body>
</html>
