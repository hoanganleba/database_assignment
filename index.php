<?php
require 'views/index.php';
require 'core/database.php';

$query = file_get_contents("assignment.sql");

$stmt = $conn->prepare($query);
$stmt->execute();

