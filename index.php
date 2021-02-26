<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Movie Database</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <script src="scripts/script.js"></script>
</head>

<body>
    <?php require_once 'views/header.php'; ?>
    <main id="main">
        <h1>The Movie Tracker</h1>
        <p> Keep track of the movies you love so you can spend more time with the people you love </p>
        <div class="homepage-bio">
            <p> The Movie Tracker is a web application that allows you to keep track of all the movies you have watched, and want to watch!</p>
            <p> Register today to join our community, giving you access to movie recommendations, community currated movie lists, and much more!</p>
        </div>

        <!-- <div class="homepage-header"> -->
        <!-- <a href="http://www.freepik.com">Designed by Freepik</a> -->
        <!-- <img src="family-watching-movies.jpg" alt="family watching movies"> -->
        <!-- </div> -->


        <div class="homepage-grid">
            <div class="card">
                <!-- Image Sourced from fontawesome.com -->
                <!-- https://fontawesome.com/license -->
                <!-- Reduced Size of Image -->
                <div class="black">
                    <img src="resources/sign-in-alt-solid-black.svg" alt="login image">
                </div>
                <div class="white hide">
                    <img src="resources/sign-in-alt-solid-white.svg" alt="login image">
                </div>
                <div class="card-container">
                    <h2>Login!</h2>
                    <p>Continue Watching Your Favourite Movies</p>
                </div>
            </div>
            <div class="card">
                <!-- Image Sourced from fontawesome.com -->
                <!-- https://fontawesome.com/license -->
                <!-- Reduced Size of Image -->
                <div class="black">
                    <img src="resources/door-open-solid-black.svg" alt="register image">
                </div>
                <div class="white hide">
                    <img src="resources/door-open-solid-white.svg" alt="register image">
                </div>
                <div class="card-container">
                    <h2>Register!</h2>
                    <p>Watch Movies With Us</p>
                </div>
            </div>
        </div>
    </main>
    <?php require_once 'views/footer.php'; ?>
</body>

</html>