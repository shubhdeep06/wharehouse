<?php
$conn = mysqli_connect("localhost", "root", "", "login");

if (!$conn) {
    die("Connection Failed");
}

$row = [];

// SEARCH PRODUCT
if (isset($_POST['search'])) {

    $barcode = $_POST['barcode'];

    $sql = "SELECT * FROM products WHERE barcode='$barcode'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "<script>alert('Product not found!');</script>";
    }
}


// UPDATE MRP
if (isset($_POST['changeMRP'])) {

    $barcode = $_POST['barcode'];
    $selling_price = $_POST['selling_price'];

    $sql = "UPDATE products
            SET selling_price='$selling_price'
            WHERE barcode='$barcode'";

    if (mysqli_query($conn, $sql)) {

        echo "<script>alert('MRP Changed Successfully');</script>";

        // Fetch Updated Data
        $sql = "SELECT * FROM products WHERE barcode='$barcode'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

    } else {

        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Change MRP</title>

<link rel="stylesheet" href="changemrp.css">

</head>

<body>

<div class="container">

<!-- SEARCH FORM -->

<form action="" method="POST">

    <input
        type="text"
        name="barcode"
        placeholder="Enter Barcode"
        required>

    <button type="submit" name="search">
        Search
    </button>

</form>


<?php if(isset($row['barcode'])) { ?>

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

        <hr>

        <!-- UPDATE FORM -->

        <form action="" method="POST">

            <input
                type="hidden"
                name="barcode"
                value="<?php echo $row['barcode']; ?>">

            <input
                type="number"
                step="0.01"
                name="selling_price"
                value="<?php echo $row['selling_price']; ?>"
                required>

            <button type="submit" name="changeMRP">

                Update MRP

            </button>

        </form>

    </div>

</div>

<?php } ?>

</div>

</body>

</html>