<nav class="navbar">
    <div class="container py-4">
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
            <div class="navbar-end">
                <div class="media">
                    <div class="image is-48x48">
                        <img class="is-rounded" src="https://bulma.io/images/placeholders/128x128.png" alt="avatar">
                    </div>
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">Admin</a>
                        <br/>
                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="?controller=logout">
                                Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="columns">
        <div class="column is-2">
            <aside class="menu is-hidden-mobile">
                <p class="menu-label">
                    General
                </p>
                <ul class="menu-list">
                    <li><a href="?controller=dashboard">Dashboard</a></li>
                    <li><a href="?controller=customers">Customers</a></li>
                </ul>
            </aside>
        </div>
        <div class="column is-10">
            <?php require 'core/controller.php'; ?>
        </div>
    </div>
</div>
