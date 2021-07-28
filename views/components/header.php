<nav class="navbar container py-4" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="?">
            <img src="public/img/free-logo.jpg" alt="logo">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">

        <div class="navbar-end">
            <?php if (isset($_SESSION["user_id"]) && $_SESSION['user_id'] != "") { ?>
                <div class="media">
                    <div class="image is-48x48">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png" alt="avatar">
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <?php echo $_SESSION["first_name"] ?>
                            <?php echo $_SESSION["last_name"] ?>
                        </a>
                        <br/>
                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                About
                            </a>
                            <a class="navbar-item">
                                Jobs
                            </a>
                            <a class="navbar-item">
                                Contact
                            </a>
                            <a class="navbar-item" href="?controller=logout">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-warning" href="?controller=register">
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
</nav>
