<?php
$conn = new mysqli("localhost", "root", "", "ecom");
$sql = "SELECT DISTINCT category FROM catalog";
$categories = $conn->query($sql);
$items = null;
$selectedCat = "";
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['category']) && $_GET['category'] != "") {
    $selectedCat = $conn->real_escape_string($_GET['category']);
    $items = $conn->query("SELECT * FROM catalog WHERE category = '$selectedCat'");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Browse by Category</title>
</head>
<body>
<h2>Select Product Category</h2>
<form method="get" action="">
    <select name="category" onchange="this.form.submit()">
        <option value="">-- Choose a category --</option>
        <?php while ($row = $categories->fetch_assoc()) {
            $selected = ($selectedCat == $row['category']) ? 'selected' : '';
            echo "<option value='{$row['category']}' $selected>{$row['category']}</option>";
        } ?>
    </select>
</form>
<hr>
<?php
if ($items && $items->num_rows > 0) {
    while ($item = $items->fetch_assoc()) {
        echo "<div style='margin:10px; padding:10px; border:1px solid #ccc; display:inline-block; width:200px;'>";
        echo "<img src='{$item["image"]}' width='150' height='150'><br>";
        echo "<strong>{$item["name"]}</strong><br>";
        echo "₹{$item["price"]}";
        echo "</div>";
    }
} elseif ($selectedCat) {
    echo "No products found in this category.";
}
?>
</body>
</html>
