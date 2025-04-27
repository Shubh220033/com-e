<?php
$conn = new mysqli("localhost", "root", "", "ecom");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
            echo "<strong>₹" . $row["price"] . "</strong>";
            echo "</div>";
        }
    } else {
        echo "No items found.";
    }
    ?>
    </div>
</body>
</html>
