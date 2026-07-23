<?php
$conn = mysqli_connect("localhost","root","","login");

  if(!$conn){
    die("Connection Failed");
  }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      $product_name=$_POST['product_name'];
      $barcode=$_POST['barcode'];
      $category=$_POST['category'];
      $supplier=$_POST['supplier'];
      $purchase_price=$_POST['purchase_price'];
      $selling_price=$_POST['selling_price'];
      $quantity=$_POST['quantity'];
      $minimum_stock=$_POST['minimum_stock'];
      $description=$_POST['description'];
     $image = $_FILES['image']['name'];
      $sql= "INSERT INTO products(product_name,barcode, category_id, supplier_id, purchase_price, selling_price, quantity, minimum_stock, description, image)
VALUES('$product_name',$barcode, $category, $supplier,  $purchase_price,$selling_price, $quantity, $minimum_stock, '$description', '$image')";
    if(mysqli_query($conn,$sql)){
      echo"succsfully inserted";
    }
    else{
        echo  mysqli_error($conn);
    }
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="add_product.css">
</head>
<body>

<div class="container">

    <h1>Add New Product</h1>

    <form action="add_product.php" method="POST" enctype="multipart/form-data">

        <label>Product Name</label>
        <input type="text" name="product_name" placeholder="Enter Product Name" required>

        <label>Barcode</label>
        <input type="text" name="barcode" placeholder="Enter Barcode" required>

        <select name="category">
    <option value="1">Cold Drinks</option>
    <option value="2">Snacks</option>
    <option value="3">Dairy</option>
</select>

<select name="supplier">
    <option value="1">Coca-Cola Distributor</option>
    <option value="2">Pepsi Distributor</option>
    <option value="3">Local Supplier</option>
</select>

        <label>Purchase Price (₹)</label>
        <input type="number" name="purchase_price" step="0.01" required>

        <label>Selling Price (MRP ₹)</label>
        <input type="number" name="selling_price" step="0.01" required>

        <label>Quantity</label>
        <input type="number" name="quantity" required>

        <label>Minimum Stock</label>
        <input type="number" name="minimum_stock" required>

        <label>Description</label>
        <textarea name="description" rows="4" placeholder="Enter Product Description"></textarea>

        <label>Product Image</label>
        <input type="file" name="image">

        <div class="buttons">
            <button type="submit" class="save">Save Product</button>
            <button type="reset" class="reset">Reset</button>
        </div>

    </form>

</div>

</body>
</html>