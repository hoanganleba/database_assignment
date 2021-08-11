<?php require('core/database.php');
$sql = "SELECT productID, productImage, closeTime, name, minimumPrice, currentPrice, firstName, lastName FROM product JOIN user u on u.userID = product.userID;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<h1 class="title is-size-4 mt-5">All Products</h1>
<div class="columns is-multiline">
    <?php foreach ($data as $product) { ?>
        <div class="column is-3-widescreen is-4-tablet">
            <div class="card">
                <div class="card-image">
                    <figure class="image is-4by3">
                        <img src="<?php echo $product["productImage"]; ?>" alt="Product image">
                    </figure>
                </div>
                <div class="card-content">
                    <p class="title is-4"><?php echo $product["name"] ?></p>
                    <div class="content">
                        <p class="subtitle is-6">Current price:
                            <span class="has-text-weight-bold"><?php echo $product["currentPrice"] ?>$</span>
                        </p>
                        <p class="subtitle is-6">Minimum price:
                            <span class="has-text-weight-bold"><?php echo $product["minimumPrice"] ?>$</span>
                        </p>
                        <p>Available until:
                            <?php echo $product['closeTime'] ?>
                        </p>
                    </div>
                    <article class="media">
                        <figure class="media-left">
                            <p class="image is-32x32">
                                <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png"
                                     alt="avatar">
                            </p>
                        </figure>
                        <div class="media-content">
                            <p> <?php echo $product["firstName"] ?>  <?php echo $product['lastName'] ?></p>
                        </div>
                    </article>
                </div>
                <footer class="card-footer">
                    <a href="#" class="card-footer-item">Place a bid</a>
                </footer>
            </div>
        </div>
    <?php } ?>
</div>

