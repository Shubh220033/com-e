<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "", "ecom");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Initialize wallet if not set
if (!isset($_SESSION['wallet_balance'])) {
    $_SESSION['wallet_balance'] = 1000; // ₹1000 default
}

$wallet_balance = $_SESSION['wallet_balance'];

$order_placed = false;
$error_message = "";

// Handle Refill Wallet
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['refill_amount']) && isset($_POST['payment_method'])) {
    $refill_amount = floatval($_POST['refill_amount']);
    $payment_method = $_POST['payment_method'];

    if ($refill_amount > 0 && in_array($payment_method, ['credit_card', 'paypal'])) {
        $_SESSION['wallet_balance'] += $refill_amount;
        $_SESSION['success_message'] = "Wallet refilled successfully using $payment_method!";
    } else {
        $_SESSION['error_message'] = "Please enter a valid amount and select a payment method.";
    }
    header("Location: cartorder.php"); // Refresh page after POST
    exit();
}

// Handle Order Form
if (!empty($_SESSION['cart'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['payment_method'])) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $payment_method = $_POST['payment_method'];

        $products = "";
        $total = 0;
        foreach ($_SESSION['cart'] as $item) {
            $products .= $item['n'] . ", ";
            $total += $item['p'];
        }
        $products = rtrim($products, ", ");

        // Wallet payment check
        if ($payment_method == 'wallet') {
            if ($wallet_balance >= $total) {
                $_SESSION['wallet_balance'] -= $total; // Deduct balance
                $wallet_balance = $_SESSION['wallet_balance'];
            } else {
                $error_message = "Not enough balance in wallet!";
            }
        }

        // Place order if no error
        if (empty($error_message)) {
            $stmt = $conn->prepare("INSERT INTO orders (name, address, product, total, payment_method) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssds", $name, $address, $products, $total, $payment_method);

            if ($stmt->execute()) {
                echo "<p>Order placed successfully using <b>$payment_method</b>!</p>";
                echo "<a href='cart.php'>Back to Shop</a>";
                unset($_SESSION['cart']);
                $order_placed = true;
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
} else {
    echo "Cart is empty. <a href='cart.php'>Go back</a>";
    exit;
}

// Set Messages
$success_message = $_SESSION['success_message'] ?? null;
$error_message = $_SESSION['error_message'] ?? null;

// Clear messages
unset($_SESSION['success_message'], $_SESSION['error_message']);
?>

<h2>My Wallet</h2>
<p>Wallet Balance: ₹<?= number_format($wallet_balance, 2) ?></p>

<?php if ($success_message): ?>
    <p style="color: green;"><?= htmlspecialchars($success_message) ?></p>
<?php elseif ($error_message): ?>
    <p style="color: red;"><?= htmlspecialchars($error_message) ?></p>
<?php endif; ?>

<h3>Refill Wallet</h3>
<form method="post" action="">
    Amount: <input type="number" name="refill_amount" step="0.01" min="1" required><br><br>
    Payment Method:
    <select name="payment_method" required>
        <option value="">Select Payment Method</option>
        <option value="credit_card">Credit Card</option>
        <option value="paypal">PayPal</option>
    </select><br><br>
    <input type="submit" value="Refill Wallet">
</form>

<h2>Order Form</h2>

<?php if (!empty($error_message)) echo "<p style='color:red;'>$error_message</p>"; ?>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Address: <textarea name="address" required></textarea><br><br>

    <b>Cart:</b><br>
    <ul>
    <?php
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            echo "<li>" . htmlspecialchars($item['n']) . " - ₹" . $item['p'] . "</li>";
        }
    }
    ?>
    </ul>

    <br>
    Payment Method:
    <select name="payment_method" required>
        <option value="">Select Payment Method</option>
        <option value="wallet">Wallet (Balance: ₹<?= number_format($wallet_balance, 2) ?>)</option>
        <option value="credit_card">Pay Pal</option>
    </select><br><br>

    <input type="submit" value="Place Order">
</form>
