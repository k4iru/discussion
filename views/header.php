<header>
    <nav class="navbar">
        <a href="/http-5202-group/index.php"><img src="/http-5202-group/images/newlogo.png" alt="php knights logo" class="logo" /></a>
        <ul class="nav-list">
            <li class="options"><a class="links" href="#">Movies</a></li>
            <li class="options"><a class="links" href="#">People</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/discussions.php">Discussions</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/profile.php">Profile</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/trailer-views/trailers.php">Trailers</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/posters.php">Posters</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/review.php">Reviews</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/list-views/user-lists.php">Movie Lists</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/polls/poll-list.php">Polls</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/subscribe/subscribe.php">Subscribe</a></li>
        </ul>
        <form class="search-form" action="/http-5202-group/views/search.php" method="GET">
            <input class="search-input" type="search" placeholder="Search" aria-label="Search" name="search" />
            <button class="search-btn" type="submit">Search</button>
        </form>
        <?php
        // logout button if logged in
        if (isset($_SESSION['valid']) == true) {
            echo "
            <form action='/http-5202-group/views/logout.php' method='POST'>
                <input type='submit' name='logout' value='Logout'>
            </form>";
        }
        ?>
    </nav>
</header>