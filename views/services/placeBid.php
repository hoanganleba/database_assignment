<?php

function get_customer_id($user_id) {
    require('core/database.php');
    $get_customer_sql = "SELECT id FROM customer WHERE user_id = :user_id";
    $get_customer_stmt = $conn->prepare($get_customer_sql);
    $get_customer_stmt->bindParam('user_id', $user_id);
    $get_customer_stmt->execute();
    $customer_row = $get_customer_stmt->fetch(PDO::FETCH_ASSOC);
    return $customer_row['id'];
}

function place_bid($customer_id, $product_id, $value) {
    require('core/database.php');
    $bid_sql = "INSERT INTO bid(customer_id, product_id, value) VALUES (:customer_id, :product_id, :value)";
    $bid_stmt = $conn->prepare($bid_sql);
    $bid_stmt->bindParam('customer_id', $customer_id);
    $bid_stmt->bindParam('product_id', $product_id);
    $bid_stmt->bindParam('value', $value);
    $bid_stmt->execute();
}