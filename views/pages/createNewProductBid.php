<?php require('core/mongoConnect.php');
if (isset($_POST['create'])) {
    if (
        $_POST['product_type'] &&
        $_POST['product_name'] &&
        $_POST['minPrice'] &&
        $_POST['closeTime'] &&
        $_POST['img_url'] &&
        $_POST['description']
    ) {
        $collection = $client->auction->products;

        $collection->insertOne([
            'product_name' => $_POST['product_name'],
            'product_type' => $_POST['product_type'],
            'minPrice' => $_POST['minPrice'],
            'createDate' => date('Y-m-d H:i:s'),
            'closeTime' => date('Y-m-d H:i:s', strtotime($_POST['closeTime'])),
            'belong_to' => (object)array(
                'user_id' => $_SESSION["user_id"],
                'last_name' => $_SESSION["last_name"],
                'first_name' => $_SESSION["first_name"],
                'profile_pic' => $_SESSION["profile_pic"]),
            'img_url' => $_POST['img_url'],
            'description' => $_POST['description'],

        ]);

        $productCount = $collection->countDocuments();
        if ($productCount > 0) {
            header("location: index.php");
        }
    }
}
?>
<div class="columns is-centered mt-3 px-4">
    <div class="column is-two-thirds">
        <form action="?controller=createNewProductBid" class="box" method="post">
            <div class="field-body mb-3">
                <div class="field">
                    <label for="product_type" class="label">Product Type</label>
                    <div class="control">
                        <input id="product_type" name="product_type" class="input" type="text" placeholder="eg Laptop">
                    </div>
                </div>
                <div class="field">
                    <label for="product_name" class="label">Product Name</label>
                    <div class="control">
                        <input id="product_name" name="product_name" class="input" type="text" placeholder="eg Razer">
                    </div>
                </div>
            </div>
            <div class="field">
                <label for="img_url" class="label">Product Image Url</label>
                <div class="control">
                    <input id="img_url" name="img_url" class="input" type="text" placeholder="eg ">
                </div>
            </div>
            <div class="field-body mb-3">
                <div class="field is-expanded">
                    <label for="minPrice" class="label">Minimum Price</label>
                    <div class="field has-addons">
                        <p class="control">
                            <a class="button is-static">
                                $
                            </a>
                        </p>
                        <p class="control is-expanded">
                            <input id="minPrice" name="minPrice" class="input" type="number"
                                   placeholder="Minimum Price">
                        </p>
                    </div>
                </div>
                <div class="field">
                    <label class="label" for="closeTime">Close Time (date and time)</label>
                    <div class="control">
                        <input class="input" type="datetime-local" id="closeTime" name="closeTime">
                    </div>
                </div>
            </div>
            <div class="field">
                <label class="label" for="description">Description</label>
                <div class="control">
                    <textarea id="description"
                              class="textarea"
                              placeholder="Product description"
                              name="description"
                              rows="10">
                    </textarea>
                </div>
            </div>
            <button type="submit" name="create" value="create" class="button is-primary">
                <strong>Create</strong>
            </button
        </form>
    </div>
</div>