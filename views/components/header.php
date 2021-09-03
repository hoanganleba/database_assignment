<nav class="navbar is-white" role="navigation" aria-label="main navigation">
    <div class="container py-4">
        <div class="navbar-brand">
            <a class="navbar-item" href="?">
                <img src="public/img/free-logo.jpg" alt="logo">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
               data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>
        <div id="navbarBasicExample" class="navbar-menu">

            <div class="navbar-end">
                <?php if (isset($_SESSION["user_id"]) && $_SESSION['user_id'] != "") { ?>
                    <div class="navbar-item">
                        <a href="?controller=createNewProductBid" class="button is-primary">
                            <strong>Create New Product Bid</strong>
                        </a>
                    </div>
                    <div class="image is-64x64">
                        <img src="<?php echo $_SESSION["profile_pic"] ?>" alt="avatar">
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <?php echo $_SESSION["last_name"] ?>
                            <?php echo $_SESSION["first_name"] ?>
                        </a>
                        <br/>
                        <div class="navbar-dropdown">
                            <div class="navbar-item">
                                Balance:
                                <span class="ml-2">
                                   <strong> <?php echo $_SESSION["balance"] ?> $</strong>
                                </span>
                            </div>
                            <a class="navbar-item" href="?controller=logout">
                                Logout
                            </a>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button is-primary" href="?controller=register">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-light" href="?controller=login">
                                Log in
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
