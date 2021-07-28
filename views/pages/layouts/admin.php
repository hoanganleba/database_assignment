<nav class="navbar py-4 container">
    <div class="navbar-brand">
        <a class="navbar-item">
            <img src="public/img/free-logo.jpg" alt="logo">
        </a>
        <div class="navbar-burger burger" data-target="navMenu">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div id="navMenu" class="navbar-menu">
        <div class="navbar-start">
            <a class="navbar-item">
                Home
            </a>
            <a class="navbar-item">
                Orders
            </a>
            <a class="navbar-item">
                Payments
            </a>
            <a class="navbar-item">
                Exceptions
            </a>
            <a class="navbar-item">
                Reports
            </a>
        </div>
        <div class="navbar-end">
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
        </div>
    </div>
</nav>
<?php
require 'core/controller.php';
?>

