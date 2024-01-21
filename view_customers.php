<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Customers - Banking System</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class = "customerlist-page">
    <h1>Customers</h1>
    <table class = "customer-table">
        <tr>
            <th>Customer ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Current Balance</th>
            <th>View</th>
        </tr>
        <?php
        $sql = "SELECT customer_id, name, email, current_balance FROM customers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["customer_id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["current_balance"] . "</td>";
                echo "<td><a href='http://localhost/BankingSystem/php/view_onecustomer.php?id=" . $row["customer_id"] . "'>View</a></td>";
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }
        ?>
    </table>

    <footer>
        <p>Copyright &copy; 2023 The Sparks Bank - Developed by Yash Sharma | YS25</p>
    </footer> 
</body>
</html>
