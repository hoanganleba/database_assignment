<?php
require('core/database.php');

$sql = "SELECT * FROM transaction";
$stmt = $conn->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Seller Id</th>
        <th>Buyer Id</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($rows as $row) { ?>
        <tr>
            <th><?php echo $row['id'] ?></th>
            <td><?php echo $row['seller_id'] ?></td>
            <td><?php echo $row['buyer_id'] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
