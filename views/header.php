<?php 

$root = getenv('ROOT');
?>
<header>
    <nav class="navbar">
        <a href="<?= $root ?>/index.php"><img src="<?= $root ?>/images/newlogo.png" alt="php knights logo" class="logo" /></a>
        <ul class="nav-list">
            <li class="options"><a class="links" href="#">Movies</a></li>
            <li class="options"><a class="links" href="#">People</a></li>
            <li class="options"><a class="links" href="<?= $root ?>/views/discussion/discussions.php">Discussions</a></li>
            <li class="options"><a class="links" href="<?= $root ?>/views/authentication/profile.php">Profile</a></li>
        </ul>
        <div class="btn-container">
            <form class="search-form" action="<?= $root ?>/views/search.php" method="GET">
                <input class="search-input" type="search" placeholder="Search" aria-label="Search" name="search" />
                <button class="btn" type="submit">Search</button>
            </form>
            <?php
            // logout button if logged in
            if (isset($_SESSION['valid']) == true) { ?>

                <form action='<?= $root ?>/Model/logout.php' method='POST'>
                    <input class='btn' type='submit' name='logout' value='Logout'>
                </form>
        </div>
    <?php  } ?>
    </nav>
</header>