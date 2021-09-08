<?php
require 'core/database.php';
require 'views/services/placeBid.php';
$sql = " SELECT * FROM bid WHERE customer_id = :customer_id";
$stmt = $conn->prepare($sql);
$customer_id = get_customer_id($_SESSION['user_id']);
$stmt->bindParam('customer_id', $customer_id);
$stmt->execute();
$bid_history = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table">
    <thead>
    <tr>
        <th>Customer Id</th>
        <th>Product Id</th>
        <th>Value</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($bid_history as $item) { ?>
        <tr>
            <td><?php echo $item['customer_id'] ?></td>
            <td><?php echo $item['product_id'] ?></td>
            <td><?php echo $item['value'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
