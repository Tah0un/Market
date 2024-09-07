<?php
session_start();
if (!$_SESSION['logged_in']){
    header("location:login.php?err=Please Login First!");
    exit;    
} 
?>

<?php
require 'connection.php';

$display_query = "SELECT * FROM products";
$data = $connection->query($display_query);

if (isset($_GET["id"])){
    $id_to_delete = $_GET["id"];
    $delete_query = "DELETE FROM products WHERE id = $id_to_delete";
    if($connection->query($delete_query)){
        echo 
            "<script>
                alert('Product Deleted successfully');
                window.location.href = 'products.php';
            </script>";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        h1.AP {
            margin: 20px 0;
            font-size: 2em;
            text-align: center;
        }

        main.card-container {
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            flex: 1;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.8s;
            display: flex;
            flex-direction: column;
            height: 350px;
        }

        .card:hover {
            transform: scale(1.06);
        }

        .card-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            text-align: center;
            flex: 1;
        }

        .card-name {
            font-size: 1.5em;
            margin: 0;
        }

        .card-price {
            color: #333;
            font-size: 1.2em;
            margin: 10px 0;
        }

        .card-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        button {
            padding: 10px 15px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .edit-btn {
            background-color: #4CAF50;
            color: #fff;
        }

        .edit-btn:hover {
            background-color: #45a049;
        }

        .delete-btn {
            background-color: #f44336;
            color: #fff;
        }

        .delete-btn:hover {
            background-color: #e53935;
        }

        footer {
            background-color: #333;
            color: #fff;
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
            <button onclick="window.location.href='shop.php'">Shop</button>
            <button onclick="window.location.href='logout.php'">Log out</button>
        </div>
    </header>
    <h1 class="AP">All Products</h1>
    <main class="card-container">
        <?php  
            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    $send = $row["id"] .",". $row["name"] .",". $row["price"] .",". $row["image"];
                    echo '
                    <div class="card">
                        <img src="'. $row["image"] .'" alt="Product Image" class="card-image">
                        <div class="card-content">
                            <h2 class="card-name">'. $row["name"] .'</h2>
                            <p class="card-price">$'. $row["price"] .'</p>
                            <div class="card-buttons">
                                <a href="editproduct.php?send='. $send .'"><button class="edit-btn">Edit</button></a>
                                <a href="products.php?id='. $row["id"] .'"><button class="delete-btn">Delete</button></a>
                            </div>
                        </div>
                    </div>';
                }
            }
        ?>
    </main>

    <footer>
        <p>Beta version</p>
    </footer>
</body>
</html>
