<?php
if (!isset($page_name)) $page_name = ''; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        列表
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="./banner.php"> Banner</a>
                        <a class="dropdown-item" href="./hot_products.php">熱門商品</a>
                        <a class="dropdown-item" href="./events.php">活動公告</a>
                        <a class="dropdown-item" href="./farmers.php">小農介紹</a>
                        <a class="dropdown-item" href="./article.php">好文推薦</a>
                    </div>
                </div>

                </li>

            </ul>

            <ul class="navbar-nav ">
                <!-- <?php if (isset($_SESSION['admins'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link"><?= $_SESSION['admins']['nickname'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php">Log out</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item <?= $page_name == 'login' ? 'active' : '' ?>">
                        <a class="nav-link" href="./login.php">Log in</a>
                    </li>

                <?php endif; ?> -->
            </ul>

        </div>
    </div>
</nav>
<style>
    .navbar .nav-item.active {
        background-color: #7abaff;
        border-radius: 8px;
    }
</style>