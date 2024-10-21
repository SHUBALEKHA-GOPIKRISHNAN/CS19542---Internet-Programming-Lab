
<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
// Add product to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['place_order'])) {
    if (isset($_POST['product_name'], $_POST['product_price'], $_POST['product_image'])) {
        $product = [
            'name' => $_POST['product_name'],
            'price' => (float)$_POST['product_price'],
            'image' => $_POST['product_image'],
        ];
        $_SESSION['cart'][] = $product;
    }
}
// Remove product from cart
if (isset($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    }
}

// Calculate total price
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalPrice += $item['price'];
}

// Handle order placement
$orderSuccess = false;
if (isset($_POST['place_order'])) {
    // Here you can process the order (e.g., save to a database, send email)
    // For now, just clear the cart
    $_SESSION['cart'] = [];
    $orderSuccess = true; // Set a flag for order success
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Centering the cart content */
        .cart-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .cart-content {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            text-align: center;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <div class="cart-content">
            <h2>Items in Your Cart</h2>
            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                        <li>
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 50px; height: 50px;" />
                            <?php echo htmlspecialchars($item['name']) . " - $" . htmlspecialchars($item['price']); ?>
                            <a href="cart.php?remove=<?php echo $index; ?>" style="color: red;">Remove</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <h3>Total Price: $<?php echo htmlspecialchars($totalPrice); ?></h3>
                <form action="cart.php" method="post">
                    <button type="submit" name="place_order">Place Order</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="thankYouModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Thank you for placing your order!Continue shopping with our Aurum Vault.</p>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Gold Shop</p>
    </footer>
    
    <script>
        // Show modal if the order was successful
        <?php if ($orderSuccess): ?>
            document.getElementById('thankYouModal').style.display = 'block';
        <?php endif; ?>

        function closeModal() {
            document.getElementById('thankYouModal').style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById('thankYouModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
