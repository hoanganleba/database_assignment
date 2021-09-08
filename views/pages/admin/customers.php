<?php
require('core/database.php');
$sql = "SELECT * FROM customer JOIN wallet w on customer.id = w.customer_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['add_balance'])) {
    if ($_POST['balance'] && $_POST['customer_id']) {
        require('core/database.php');
        $balance = $_POST['balance'];
        $customer_id = $_POST['customer_id'];
        $sql = "UPDATE wallet SET balance = balance + :balance WHERE customer_id = :customer_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam('balance', $balance);
        $stmt->bindParam('customer_id', $customer_id);
        $stmt->execute();

        $sql_customers = "SELECT * FROM customer JOIN wallet w on customer.id = w.customer_id";
        $stmt = $conn->prepare($sql_customers);
        $stmt->execute();
        $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Balance</th>
        <th>Add Balance</th>
    </tr>
    </thead>

    <tbody>
    <?php foreach ($customers as $customer) { ?>
        <tr>
            <th><?php echo $customer['id'] ?></th>
            <td><?php echo $customer['first_name'] ?></td>
            <td><?php echo $customer['last_name'] ?></td>
            <td><?php echo $customer['balance'] ?></td>
            <td>
                <form class="field-body" method="post" action="?controller=customers">
                    <input aria-label="customer_id" type="hidden" id="customer_id" name="customer_id"
                           value="<?php echo $customer['id'] ?>">
                    <input id="balance" aria-label="balance" name="balance" class="input" type="number"
                           placeholder="Amount add"/>
                    <button class="button is-primary" name="add_balance" value="add_balance" type="submit">
                        <strong>Add</strong>
                    </button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
