<?php
require 'connection.php';

if (isset($_GET["ids"]) && $_GET["ids"] != NULL){
    $ids = $_GET["ids"];
    $display_query = "SELECT * FROM products WHERE id IN ($ids)";
    $data = $connection->query($display_query);
}
if (isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    echo gettype($remove_id);
    $array = explode(",", $ids);
    $array = array_filter($array, function($value) use ($remove_id) {
        return $value != $remove_id;
    });
    $ids = implode(",", $array);
    if ($ids === ""){
        $ids = NULL;
        header("location:cart.php");
    }
    else
        header("location:cart.php?ids=$ids");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
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

        main.cart-container {
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            justify-content: center;
            flex: 1;
        }

        .cart-section {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 10px;
            gap: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-image {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 4px;
        }

        .cart-details {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cart-name {
            font-size: 1.5em;
            margin: 0;
        }

        .cart-price {
            color: #333;
            font-size: 1.2em;
            margin: 10px 0;
        }

        .cart-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cart-quantity label {
            font-size: 1em;
        }

        .cart-quantity input {
            width: 50px;
            padding: 5px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .cart-buttons {
            display: flex;
            gap: 10px;
        }

        .remove-btn {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-btn:hover {
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
        <h1 class="title">Your Cart</h1>
        <div class="header-buttons">
            <button onclick="window.location.href='shop.php'">Continue Shopping</button>
            <button onclick="window.location.href='logout.php'">Log out</button>
        </div>
    </header>
    <?php if (isset($_GET["ids"])) :?>
        <h1 class="AP">Your Products</h1>
    <?php else :?>
        <h1 class="AP">No Products In Your Cart</h1>
    <?php endif; ?>
    <main class="cart-container">
        <?php  
        if (isset($_GET["ids"]) && $_GET["ids"] != NULL) {
            if ($data->num_rows > 0) {
                while ($row = $data->fetch_assoc()) {
                    echo '
                    <div class="cart-section">
                        <img src="'. $row["image"] .'" alt="Product Image" class="cart-image">
                        <div class="cart-details">
                            <h2 class="cart-name">'. $row["name"] .'</h2>
                            <p class="cart-price">$'. $row["price"] .'</p>
                            <div class="cart-quantity">
                                <label for="quantity-'. $row["id"] .'">Quantity:</label>
                                <input type="number" id="quantity-'. $row["id"] .'" name="quantity" value="1" min="1">
                            </div>
                        </div>
                        <form action="" method="POST" style="display: inline;">
                            <input type="hidden" name="remove_id" value="'. $row["id"] .'">
                            <button class="remove-btn" type="submit">Remove</button>
                        </form>
                    </div>';
                }
            }
        }
        ?>
    </main>
    <footer>
        <p>Beta version</p>
    </footer>

    <script>
        // Example function to handle item removal from the cart
        function removeItem(productName) {
            alert("Removing (" + productName + ") from your cart");
            // You can implement a reload or remove the product section from the DOM
        }
    </script>
</body>
</html>
