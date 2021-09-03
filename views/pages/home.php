<?php require('core/mongoConnect.php');

$collection = $client->auction->products;

$data = $collection->find([])

?>
<h1 class="title is-size-4 mt-5">All Products</h1>
<div class="columns is-multiline">
    <?php foreach ($data as $key => $product) { ?>
        <div class="column is-3-widescreen is-4-tablet">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="<?php echo $product["img_url"]; ?>" alt="Product image">
                    </figure>
                </div>
                <div class="card-content">
                    <p class="title is-4"><?php echo $product["product_name"] ?></p>
                    <div class="content">
                        <p class="subtitle is-6">Current price:
                            <span class="has-text-weight-bold">
                        <?php
                        require 'core/database.php';
                        $product_id = $product["_id"];
                        $sql = "SELECT MAX(value) as value FROM bid WHERE product_id=:product_id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam('product_id', $product_id);
                        $stmt->execute();
                        $count = $stmt->rowCount();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($row > 0) {
                            echo $row['value'];
                        }
                        echo $product["minPrice"];
                        ?>$</span>
                        </p>
                        <p class="subtitle is-6">Minimum price:
                            <span class="has-text-weight-bold"><?php echo $product["minPrice"] ?>$</span>
                        </p>
                        <p>Available until:
                            <?php echo $product['closeTime'] ?>
                        </p>
                    </div>
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-32x32">
                                <img class="is-rounded"
                                     src="<?php echo $product["belong_to"]["profile_pic"] ?>"
                                     alt="avatar">
                            </p>
                        </figure>
                        <div class="media-content">
                            <p>
                                <?php echo $product["belong_to"]["last_name"] ?>
                                <span>
                                    <?php echo $product["belong_to"]["first_name"] ?>
                                </span>
                            </p>
                        </div>
                    </article>
                </div>
                <footer class="card-footer">
                    <a class="card-footer-item">Place a bid</a>
                </footer>
            </div>
        </div>
    <?php } ?>
</div>


