<?php
$servername = 'localhost';
$username = 'root';
$password = 'root123!';
$db_name = 'assignment';
$conn = '';

try {
    $dsn = "mysql:host=$servername;dbname=$db_name";
    $conn = new PDO($dsn, $username, $password);
} catch (PDOException $pe) {
    die("Could not connect:" . $pe->getMessage());
}






