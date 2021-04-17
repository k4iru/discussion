<?php
namespace PhPKnights\Model;

class Movie
{
    public static string $id;
    public static string $title;
    public static string $fullTitle;
    public static int    $rank;
    public static int    $year;

    public static string $imageUrl;
    public static string $crew;
    public static float  $IMDbRating;
    public static int    $IMDbRatingCount;

    public static string $errorMessage;

    function __construct()
    {

    }



    public static function makeTrailer($url) {
        $embedLink = '<iframe height="400px" width="800px" src="'.$url.'" title="Trailer Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        return $embedLink;
    }

    public static function makePoster($url) {
        $poster = "<img class='movie-poster' src='$url' alt='Movie Poster'>";
        return $poster;
    }

    public static function searchMovie($movieName) {
        $queryString = "https://imdb-api.com/en/API/SearchMovie/k_tlju98cy/$movieName";
        return $queryString;
    }
}
?>