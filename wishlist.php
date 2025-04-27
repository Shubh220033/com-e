<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecom");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add to Wishlist
if (isset($_POST['add_wishlist'])) {
    $_SESSION['wishlist'][] = $_POST['product'];
}

// Remove from Wishlist
if (isset($_POST['remove_wishlist'])) {
    $id = $_POST['id'];
    unset($_SESSION['wishlist'][$id]);
}

$sql = "SELECT name, description, price, image FROM catalog";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catalogue</title>
    <style>
        .catalog-container {
            display: flex;
            flex-wrap: wrap;
        }
        .item {
            border: 1px solid #aaa;
            padding: 10px;
            margin: 10px;
            width: 200px;
            text-align: center;
        }
        img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h2>Product Catalogue</h2>

    <div class="catalog-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='item'>";
            echo "<img src='" . $row["image"] . "' alt='Product Image'><br>";
            echo "<h4>" . htmlspecialchars($row["name"]) . "</h4>";
            echo "<p>" . htmlspecialchars($row["description"]) . "</p>";
            echo "<strong>₹" . $row["price"] . "</strong><br><br>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='product' value='" . htmlspecialchars($row["name"]) . "'>";
            echo "<button type='submit' name='add_wishlist'>Add to Wishlist</button>";
            echo "</form>";
            echo "</div>";
        }
    } else {
        echo "No items found.";
    }
    ?>
    </div>

    <hr>

    <h3>My Wishlist </h3>
    <div>
    <?php
    if (!empty($_SESSION['wishlist'])) {
        foreach ($_SESSION['wishlist'] as $index => $item) {
            echo "<form method='post' style='display:inline;'>";
            echo "" . htmlspecialchars($item);
            echo "<input type='hidden' name='id' value='$index'>";
            echo " <button type='submit' name='remove_wishlist'>Remove</button>";
            echo "</form><br>";
        }
    } else {
        echo "<p>No items in wishlist.</p>";
    }
    ?>
    </div>

</body>
</html>
