<?php
require '../server/connection.php';
require '../server/client_sanitize.php';

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
        $add_product_query = "INSERT INTO products VALUES (NULL, '$name', '$price', '$image_location');";
        if ($connection->query($add_product_query)){
            echo "<script>alert('Product added successfully');</script>";
        }
    }
    else 
        echo "Invalid Data!";
}?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Light gray background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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


        .content {
            padding: 20px;
            width: 100%;
            max-width: 500px;
            margin: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {   
            font-size: 2em;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555; /* Dark gray label text */
        }

        input[type="text"], input[type="file"], input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            font-size: 1em;
            color: #fff;
            background-color: #4CAF50; /* Green buttons */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button.submitBtn{
            width: 100%;
        }

        button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        footer {
            background-color: #333; /* Match the header color */
            color: #fff;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="title">Tahoun Market</h1>
        <div class="header-buttons">
            <button onclick="window.location.href='products.php'">Show All Products</button>
            <button onclick="window.location.href='shop.php'">Shop</button>
            <button onclick="window.location.href='logout.php'">Log out</button>
        </div>
    </header>
    <div class="content">
        <h1 class="form-title">Add New Product</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" placeholder="Enter product name" name="name" required>
            </div>
            <div class="input-group">
                <label for="price">Price</label>
                <input type="number" id="price" placeholder="Enter price" name="price" required>
            </div>
            <div class="input-group">
                <label for="imageUpload">Upload Image</label>
                <input type="file" id="imageUpload" name="image" required>
            </div>
            <div class="input-group">
                <button class="submitBtn" id="submitBtn" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <footer>
        <p>Beta version</p>
    </footer>
</body>
</html>
