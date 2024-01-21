<?php
include 'config.php';
if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $sql = "SELECT customer_id, name, email, current_balance FROM customers WHERE customer_id = $customer_id";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View One Customer - Banking System</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class = "customerdata-page">
    <h1>Customer Details</h1>
    <div class="customer-details">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<p>Customer ID: " . $row["customer_id"]. "</p>";
                echo "<p>Name: " . $row["name"]. "</p>";
                echo "<p>Email: " . $row["email"]. "</p>";
                echo "<p>Current Balance: " . $row["current_balance"]. "</p>";
            }
        } else {
            echo "<p>No results</p>";
        }
        ?>
    </div>
    <a href="transfer_money.php?id=<?php echo $customer_id; ?>">Transfer Money</a>
    <nav>
        <a href="http://localhost/BankingSystem/php/view_customers.php">Go to View All Customers</a>
    </nav>
    <footer>
        <p>Copyright &copy; 2023 The Sparks Bank - Developed by Yash Sharma | YS25</p>
    </footer> 
</body>
</html>
