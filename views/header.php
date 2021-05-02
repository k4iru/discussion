<header>
    <nav class="navbar">
        <a href="/index.php"><img src="/images/newlogo.png" alt="php knights logo" class="logo" /></a>
        <ul class="nav-list">
            <li class="options"><a class="links" href="#">Movies</a></li>
            <li class="options"><a class="links" href="#">People</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/discussion/discussions.php">Discussions</a></li>
            <li class="options"><a class="links" href="/views/authentication/profile.php">Profile</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/trailer-views/trailers.php">Trailers</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/posters.php">Posters</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/reviews/review.php">Reviews</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/list-views/user-lists.php">Movie Lists</a>
            </li>
            <li class="options"><a class="links" href="/http-5202-group/views/polls/poll-list.php">Polls</a></li>
            <li class="options"><a class="links" href="/http-5202-group/views/subscribe/subscribe.php">Subscribe</a>
            </li>
        </ul>
        <div class="btn-container">
            <form class="search-form" action="/http-5202-group/views/search.php" method="GET">
                <input class="search-input" type="search" placeholder="Search" aria-label="Search" name="search" />
                <button class="btn" type="submit">Search</button>
            </form>
            <?php
            // logout button if logged in
            if (isset($_SESSION['valid']) == true) { ?>

                <form action='/functions/logout.php' method='POST'>
                    <input class='btn' type='submit' name='logout' value='Logout'>
                </form>
        </div>
    <?php  } ?>
    </nav>
</header>