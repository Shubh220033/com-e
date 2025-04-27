<?php
$conn = new mysqli("localhost", "root", "", "ecom");
if (isset($_GET['q'])) {
    $q = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT name, price, image FROM catalog WHERE name LIKE '%$q%'";
    $result = $conn->query($sql);
}
?>
<form method="get">
    <input type="text" name="q" placeholder="Search products..." required>
    <input type="submit" value="Search">
</form>
<?php
if (isset($result)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div><img src='{$row["image"]}' width='100'><br>";
            echo "<strong>{$row["name"]}</strong> - ₹{$row["price"]}</div><br>";
        }
    } else {
        echo "No results found.";
    }
}
?>
