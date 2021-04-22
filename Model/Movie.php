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

    /**
     * GETTER/SETTER FOR $id
     */
    function set_id(string $id)
    {
        $this->id = $id;
    }
    function get_id()
    {
        return $this->id;
    }

    /**
     * GETTER/SETTER FOR $title
     */
    function set_title(string $title)
    {
        $this->title = $title;
    }
    function get_title()
    {
        return $this->title;
    }

    /**
     * GETTER/SETTER FOR $fullTitle
     */
    function set_fullTitle(string $fullTitle)
    {
        $this->fullTitle = $fullTitle;
    }
    function get_fullTitle()
    {
        return $this->fullTitle;
    }

    /**
     * GETTER/SETTER FOR $rank
     */
    function set_rank(int $rank)
    {
        $this->rank = $rank;
    }
    function get_rank()
    {
        return $this->rank;
    }

    /**
     * GETTER/SETTER FOR $year
     */
    function set_year(int $year)
    {
        $this->year = $year;
    }
    function get_year()
    {
        return $this->year;
    }

    /**
     * GETTER/SETTER FOR $imageUrl
     */
    function set_imageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }
    function get_imageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * GETTER/SETTER FOR $crew
     */
    function set_crew(string $crew)
    {
        $this->crew = $crew;
    }
    function get_crew()
    {
        return $this->crew;
    }

    /**
     * GETTER/SETTER FOR $IMDbRating
     */
    function set_IMDbRating(float $IMDbRating)
    {
        $this->IMDbRating = $IMDbRating;
    }
    function get_IMDbRating()
    {
        return $this->IMDbRating;
    }

    /**
     * GETTER/SETTER FOR $IMDbRatingCount
     */
    function set_IMDbRatingCount(string $IMDbRatingCount)
    {
        $this->IMDbRatingCount = $IMDbRatingCount;
    }
    function get_IMDbRatingCount()
    {
        return $this->IMDbRatingCount;
    }

    /**
     * GETTER/SETTER FOR $errorMessage
     */
    function set_errorMessage(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }
    function get_errorMessage()
    {
        return $this->errorMessage;
    }


    public static function makePoster($url) {
        $poster = "<img class='movie-poster' src='$url' alt='Movie Poster'>";
        return $poster;
    }
}
?>