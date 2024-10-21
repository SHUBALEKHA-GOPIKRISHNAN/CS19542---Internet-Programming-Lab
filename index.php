
<?php
// Sample product data with images
$products = [
    ['name' => 'Gilded Grace', 'price' => 65000, 'image' => 'images/necklace 1.jpg'],
    ['name' => 'Mariglow', 'price' => 70000, 'image' => 'images/necklace 2.webp'],
    ['name' => 'Couples Knot', 'price' => 80000, 'image' => 'images/bracelet 1.webp'],
    ['name' => 'Aurelia Heart', 'price' => 50000, 'image' => 'images/bracelet 2.webp'],
    ['name' => 'Whispering Wings', 'price' => 60000, 'image' => 'images/earring 1.webp'],
    ['name' => 'Cherished Gleam', 'price' => 85000, 'image' => 'images/earring 2.jpeg'],
    ['name' => 'Fluttering Glow', 'price' => 90000, 'image' => 'images/ring 1.webp'],
    ['name' => 'Golden Amour', 'price' => 100000, 'image' => 'images/ring 2.avif'],
    ['name' => 'Stardust Anklet', 'price' => 55000, 'image' => 'images/anklet 1.jpg'],
    ['name' => 'Leaf Trail Anklet', 'price' => 75000, 'image' => 'images/anklet 2.jpg'],
    ['name' => 'Royal Enchantment Bangle', 'price' => 95000, 'image' => 'images/bangles 1.jpg'],
    ['name' => 'Elegance Curve Bangle', 'price' => 45000, 'image' => 'images/bangles 2.webp'],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Shop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>AURUM VAULT</h1>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" />
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p>Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['price']); ?>">
                        <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
                        <button type="submit">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Gold Shop</p>
    </footer>
</body>
</html>
