<?php require('core/database.php');
$sql = "SELECT COUNT(*) AS numOfProducts FROM product;";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="container mt-5">
    <div class="columns">
        <div class="column is-2">
            <aside class="menu is-hidden-mobile">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a class="is-warning">Dashboard</a></li>
                    <li><a>Customers</a></li>
                    <li><a>Other</a></li>
                </ul>
            </aside>
        </div>
        <div class="column is-10">
            <section class="info-tiles">
                <div class="tile is-ancestor has-text-centered">
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">439k</p>
                            <p class="subtitle">Users</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title"><?php echo $result['numOfProducts']; ?></p>
                            <p class="subtitle">Products</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">3.4k</p>
                            <p class="subtitle">Open Orders</p>
                        </article>
                    </div>
                    <div class="tile is-parent">
                        <article class="tile is-child box">
                            <p class="title">19</p>
                            <p class="subtitle">Exceptions</p>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>