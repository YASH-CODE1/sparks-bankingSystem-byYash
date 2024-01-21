<?php
$host = "localhost";
$username = "root"; // XAMPP default
$password = ""; // XAMPP default
$dbname = "banking_system"; // your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("SET time_zone='+05:30'");

?>
