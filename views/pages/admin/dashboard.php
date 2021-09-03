<?php
require('core/mongoConnect.php');
require('core/database.php');

$sql = "SELECT COUNT(*) AS numOfCustomers FROM customer;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$customerCount = $stmt->fetch(PDO::FETCH_ASSOC);

$collection = $client->auction->products;
$productCount = $collection->countDocuments();
?>
<section class="info-tiles">
    <div class="tile is-ancestor has-text-centered">
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title"><?php echo $customerCount['numOfCustomers']; ?></p>
                <p class="subtitle">Customers</p>
            </article>
        </div>
        <div class="tile is-parent">
            <article class="tile is-child box">
                <p class="title"><?php echo $productCount; ?></p>
                <p class="subtitle">Products</p>
            </article>
        </div>
    </div>
</section>