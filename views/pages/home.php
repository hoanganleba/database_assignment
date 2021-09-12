<?php use MongoDB\Bson\ObjectID;

require('core/mongoConnect.php');
require('views/services/placeBid.php');
require('views/services/checkDate.php');

$collection = $client->auction->products;
$message = '';
$type_message = '';
$data = $collection->find([]);
if (isset($_POST['asc'])) {
    if (!empty($_POST['select'])) {
        $selected = $_POST['select'];
        $data = $collection->find([], ['sort' => [$selected => 1]]);
    } else {
        echo 'Please select the value.';
    }
}
if (isset($_POST['desc'])) {
    if (!empty($_POST['select'])) {
        $selected = $_POST['select'];
        $data = $collection->find([], ['sort' => [$selected => -1]]);
    } else {
        echo 'Please select the value.';
    }
}

if (isset($_POST['transaction'])) {
    if ($_POST['current_price'] && $_POST['seller_id'] && $_POST['buyer_id']) {
        require('views/services/transaction.php');
        transaction($_POST['current_price'], $_POST['seller_id'], $_POST['buyer_id']);
        $message = 'Transaction successfully';
        $type_message = 'is-success';
    }
}

if (isset($_POST['bid'])) {
    if (
        $_POST['bid_value'] &&
        $_POST['user_id'] &&
        $_POST['product_id'] &&
        $_POST['minPrice']
    ) {
        if ($_SESSION['balance'] < $_POST['bid_value']) {
            $message = 'Not enough balance. Please add more to your balance';
            $type_message = 'is-danger';
        } else if ($_POST['bid_value'] < $_POST['minPrice']) {
            $message = 'You must bind higher than min price';
            $type_message = 'is-danger';
        } else if ($_POST['bid_value'] < $_POST['currentPrice']) {
            $message = 'You must bind higher than current price';
            $type_message = 'is-danger';
        } else {
            $customer_id = get_customer_id($_POST['user_id']);
            place_bid($customer_id, $_POST['product_id'], $_POST['bid_value']);
            $message = 'Bid successfully';
            $type_message = 'is-success';
        }
    }
}

?>
<?php if ($message != '') { ?>
    <div class="notification <?php echo $type_message; ?> is-light">
        <button class="delete"></button>
        <strong><?php echo $message; ?></strong>
    </div>
<?php } ?>
<h1 class="title is-size-4 mt-5">All Products</h1>
<form method="post" action="?" class="mb-5">
    <div class="select">
        <select name="select" aria-label="select">
            <option value="numOfBid">NumOfBid</option>
        </select>
    </div>
    <button type="submit" name="asc" value="asc" class="button">ASC</button>
    <button type="submit" name="desc" value="desc" class="button">DESC</button>
</form>
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
                        if ($row['value'] != null) {
                            $collection->updateOne([
                                '_id' => new ObjectID($product_id)
                            ], ['$set' => ['currentPrice' => $row['value']]]
                            );
                            echo $row['value'];
                        } else {
                            $collection->updateOne([
                                '_id' => new ObjectID($product_id)
                            ], ['$set' => ['currentPrice' => $product["minPrice"]]]
                            );
                            echo $product["minPrice"];
                        }
                        ?>$</span>
                        </p>
                        <p class="subtitle is-6">
                            NumOfBid: <span class="has-text-weight-bold">
                                <?php
                                $sql = "SELECT COUNT(DISTINCT customer_id) as numOfBid FROM bid WHERE product_id=:product_id";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam('product_id', $product_id);
                                $stmt->execute();
                                $bid_num = $stmt->fetch(PDO::FETCH_ASSOC);
                                $collection->updateOne([
                                    '_id' => new ObjectID($product_id)
                                ], ['$set' => ['numOfBid' => $bid_num['numOfBid']]]
                                );
                                echo $bid_num['numOfBid']
                                ?>
                            </span>
                        </p>
                        <p class="subtitle is-6">Minimum price:
                            <span class="has-text-weight-bold"><?php echo $product["minPrice"] ?>$</span>
                        </p>
                        <p>Available until:
                            <span class="has-text-weight-bold">
                                <?php echo $product['closeTime'] ?>
                            </span>
                        </p>
                        <p>Status:
                            <span class="has-text-weight-bold">
                                <?php echo check_date($product['closeTime']) ?>
                            </span>
                        </p>
                        <form method="post" action="?">
                            <?php
                            $get_customer_max_bid_sql = "SELECT customer_id, MAX(value) FROM bid WHERE product_id=:product_id GROUP BY customer_id";
                            $get_customer_max_bid_stmt = $conn->prepare($get_customer_max_bid_sql);
                            $get_customer_max_bid_stmt->bindParam('product_id', $product_id);
                            $get_customer_max_bid_stmt->execute();
                            $bid_row = $get_customer_max_bid_stmt->fetch(PDO::FETCH_ASSOC);
                            ?>
                            <input aria-label="current_price" type="hidden" id="current_price" name="current_price"
                                   value="<?php echo $row['value']; ?>"
                            >
                            <input aria-label="seller_id" type="hidden" id="seller_id" name="seller_id"
                                   value="<?php echo $product["belong_to"]["user_id"]; ?>"
                            >
                            <input aria-label="buyer_id" type="hidden" id="buyer_id" name="buyer_id"
                                   value="<?php echo $bid_row['customer_id']; ?>"
                            >
                            <button name="transaction" value="transaction" type="submit">Transaction</button>
                        </form>
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
                <?php if (isset($_SESSION["user_id"]) &&
                    $_SESSION['user_id'] != "" &&
                    $_SESSION['user_id'] != $product["belong_to"]["user_id"] &&
                    check_date($product['closeTime']) === 'Active'
                ) { ?>
                    <footer class="card-footer">
                        <a class="card-footer-item">
                            <form class="field-body" method="post" action="?">
                                <input aria-label="currentPrice" type="hidden" id="currentPrice" name="currentPrice"
                                       value="<?php echo $row['value']; ?>"
                                >
                                <input aria-label="minPrice" type="hidden" id="minPrice" name="minPrice"
                                       value="<?php echo $product["minPrice"]; ?>"
                                >
                                <input aria-label="user_id" type="hidden" id="user_id" name="user_id"
                                       value="<?php echo $_SESSION['user_id']; ?>"
                                >
                                <input aria-label="product_id" type="hidden" id="product_id" name="product_id"
                                       value="<?php echo $product['_id']; ?>"
                                >
                                <input id="bid_value" aria-label="bid_value" name="bid_value" class="input"
                                       type="number"
                                       placeholder="Amount"/>
                                <button class="button is-primary" name="bid" value="bid" type="submit">
                                    <strong>Bid</strong>
                                </button>
                            </form>
                        </a>
                    </footer>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>


