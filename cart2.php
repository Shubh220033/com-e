<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ecom");

if (isset($_POST['add'])) $_SESSION['cart'][] = ['n' => $_POST['n'], 'p' => $_POST['p']];
if (isset($_POST['clear'])) unset($_SESSION['cart']);
if (isset($_POST['remove'])) unset($_SESSION['cart'][$_POST['id']]);

$res = $conn->query("SELECT name, description, price, image FROM catalog");
?>
<html><body>
<h2>Catalogue</h2>

<?php if (!empty($_SESSION['cart'])) {
    $t = 0;
    foreach ($_SESSION['cart'] as $i => $c) {
        echo $c['n']." - ₹".$c['p'];
        echo " <form method='post' style='display:inline;'>
                <input type='hidden' name='id' value='$i'>
                <button name='remove'>Remove</button></form><br>";
        $t += $c['p'];
    }
    echo "<b>Total: ₹$t</b><br>";

    echo "<form method='post' style='display:inline;'><button name='clear'>Clear Cart</button></form> ";
    echo "<form action='cartorder.php' method='post' style='display:inline; margin-left:10px;'>
            <button type='submit'>Order Now</button>
          </form><hr>";
} ?>

<?php while($r = $res->fetch_assoc()) { ?>
<div style="border:1px solid #aaa; padding:10px; margin:10px; width:200px; display:inline-block;">
    <img src="<?= $r['image'] ?>" style="width:100%;height:200px;"><br>
    <b><?= htmlspecialchars($r['name']) ?></b><br>
    <?= htmlspecialchars($r['description']) ?><br>
    ₹<?= $r['price'] ?><br>
    <form method="post">
        <input type="hidden" name="n" value="<?= htmlspecialchars($r['name']) ?>">
        <input type="hidden" name="p" value="<?= $r['price'] ?>">
        <button name="add">Add to Cart</button>
    </form>
</div>
<?php } ?>

</body>
</html>
