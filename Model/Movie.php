<?php
namespace PhPKnights\Model;

class Movie
{
    private static string $id;
    private static string $title;
    private static string $fullTitle;
    private static int    $rank;
    private static int    $year;

    private static string $imageUrl;
    private static string $crew;
    private static float  $IMDbRating;
    private static int    $IMDbRatingCount;

    private static string $errorMessage;

    function __construct()
    {

    }



    public static function makePoster($url) {
        $poster = "<img class='movie-poster' src='$url' alt='Movie Poster'>";
        return $poster;
    }
}
?>