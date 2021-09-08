<?php

function update_seller_balance($seller_id, $seller_balance)
{
    require('core/database.php');
    $sql = "UPDATE wallet SET balance = balance + :balance WHERE customer_id = :seller_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('balance', $seller_balance);
    $stmt->bindParam('seller_id', $seller_id);
    $stmt->execute();
}

function update_buyer_balance($buyer_id, $buyer_balance)
{
    require('core/database.php');
    $sql = "UPDATE wallet SET balance = balance - :balance WHERE customer_id = :buyer_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam('balance', $buyer_balance);
    $stmt->bindParam('buyer_id', $buyer_id);
    $stmt->execute();
}


function transaction($current_price, $seller_id, $buyer_id)
{
    require('core/database.php');
    try {
        $conn->beginTransaction();
        update_seller_balance($seller_id, $current_price);
        update_buyer_balance($buyer_id, $current_price);
        $transaction_date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO transaction(seller_id, buyer_id, transaction_date) VALUES (:seller_id, :buyer_id, :transaction_date)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('seller_id', $seller_id);
        $stmt->bindParam('buyer_id', $buyer_id);
        $stmt->bindParam('transaction_date', $transaction_date);
        $stmt->execute();
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}