<?php
include 'config.php';
$errors = [];
$transactionSuccessful = false;
if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $to_customer_id = $_POST['to_customer_id'];
    $amount = $_POST['amount'];

    // Check if the amount is valid
    if ($amount <= 0) {
        $errors[] = 'Please enter a valid amount.';
    }

    // Fetch the from customer's balance
    $sql = "SELECT current_balance FROM customers WHERE customer_id = $customer_id";
    $result = $conn->query($sql);
    $from_customer_balance = $result->fetch_assoc()['current_balance'];

    // Check if the from customer has enough balance
    if ($amount > $from_customer_balance) {
        $errors[] = 'Insufficient balance.';
    }

    if(empty($errors)) {
        // Update balances of the from and to customers
        $sql = "UPDATE customers SET current_balance = current_balance - $amount WHERE customer_id = $customer_id";
        $conn->query($sql);
    
        $sql = "UPDATE customers SET current_balance = current_balance + $amount WHERE customer_id = $to_customer_id";
        $conn->query($sql);
    
        // Record the transfer
        $sql = "INSERT INTO transfers (from_customer_id, to_customer_id, amount) VALUES ($customer_id, $to_customer_id, $amount)";
        $conn->query($sql);
    
        echo "<div class='success'>Transaction Successful!</div>";
        echo "<a class='back-button' href='view_customers.php'>Back to View All Customers</a>";
        $transactionSuccessful = true; 
    } else {
        foreach($errors as $error) {
            echo $error . '<br>';
        }
    }    
}
// Fetch customers for the dropdown
$sql = "SELECT customer_id, name FROM customers WHERE customer_id != $customer_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transfer Money</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class = "transfermoney-page">
    <h1>Transfer Money</h1>
    <div class="form-container">
        <form action="" method="POST">
            <label for="from_customer_id">From:</label>
            <input type="number" id="from_customer_id" name="from_customer_id" value="<?php echo $customer_id; ?>" readonly>

            <label for="to_customer_id">To:</label>
            <select id="to_customer_id" name="to_customer_id">
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='". $row["customer_id"]. "'>" . $row["name"]. "</option>";
                    }
                }
                ?>
            </select>

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required>

            <input type="submit" value="Transfer">
        </form>
        <?php
        if(!empty($errors)) {
            foreach($errors as $error) {
                echo '<p class="error">' . $error . '</p>';
            }
        }
        ?>
    </div>
    <?php if (!$transactionSuccessful): ?>
    <nav>
        <a href="http://localhost/BankingSystem/php/view_customers.php">Go to View All Customers</a>
    </nav>
<?php endif; ?>

<footer>
        <p>Copyright &copy; 2023 The Sparks Bank - Developed by Yash Sharma | YS25</p>
    </footer>  
</body>
</html>
