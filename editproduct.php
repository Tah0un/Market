<?php
session_start();
if (!$_SESSION['logged_in'])  header("location:login.php?err=Please Login First!");
else echo "Hello ".$_SESSION['username'];
?>

<?php
require "connection.php";
require "client_sanitize.php";

if (isset($_GET["send"])){
    $old_data = explode(",", $_GET["send"]);
}

if (isset($_POST["submit"])){
    $name = client_sanitization($_POST["name"]);
    $price = $_POST["price"];
    $image_name = $_FILES["image"]["name"];
    $image_type = $_FILES["image"]["type"];
    $image_tmp = $_FILES["image"]["tmp_name"];
    $extension = explode(".", $image_name);
    $extension = strtolower(end($extension));

    $available_extension = array("jpg", "png", "jpeg");

    if (in_array($extension, $available_extension)){
        $image_location = "images/" . $image_name;
        move_uploaded_file($image_tmp, $image_location);
        $update_product_query = "UPDATE products SET `name` = '$name', `price` = '$price',`image`= '$image_location' WHERE id = $old_data[0]";
        if ($connection->query($update_product_query))
            echo "<script>alert('Product Updated Successfully');</script>";
        else 
            echo "<script>alert('Can't Update Product!');</script>";
    }
    else 
        echo "<script>alert('Invalid Data!');</script>";;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
            justify-content: space-between;
        }

        header {
            background-color: #333;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .title {
            color: white;
            font-size: 2.5em;
            margin: 0;
        }

        .header-buttons {
            display: flex;
            gap: 10px; 
        }

        .header-buttons button {
            padding: 10px 15px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            transition: background-color 0.3s ease;
        }

        .header-buttons button:hover {
            background-color: #45a049;
        }


        .edit-form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"], input[type="file"], input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
        }

        .save-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="title">Tahoun Market</h1>
        <div class="header-buttons">
            <button onclick="window.location.href='addproduct.php'">Add Product</button>
            <button onclick="window.location.href='products.php'">Show All Products</button>
            <button onclick="window.location.href='shop.php'">Shop</button>
            <button onclick="window.location.href='logout.php'">Log out</button>
        </div>
    </header>
    <div class="edit-form-container">
        <h1>Edit Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" placeholder="Enter product name" value="<?php echo $old_data[1]; ?>">
            </div>
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" placeholder="Enter price" value="<?php echo $old_data[2]; ?>">
            </div>
            <div class="input-group">
                <label for="imageUpload">Upload New Image</label>
                <input type="file" id="imageUpload" name="image" value="<?php echo $old_data[3]; ?>">
            </div>
            <div class="button-group">
                <button type="submit" class="save-btn" name="submit">Save Changes</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='products.php'">Cancel</button>
            </div>
        </form>
    </div>

    <footer>
        <p>Beta version</p>
    </footer>

</body>
</html>
