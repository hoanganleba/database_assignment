<?php
session_start();
$_SESSION['user_id'] = "";
$_SESSION['first_name'] = "";
$_SESSION['last_name'] = "";
$_SESSION['role'] = "";
if(empty($_SESSION['user_id'])) header("location: index.php");