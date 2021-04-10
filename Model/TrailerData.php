<?php
//namespace PhPKnights\Model;

class TrailerData
{
    public static string $IMDbId;
    public static string $Title;
    public static string $FullTitle;
    public static string $Type;
    public static string $Year;

    public static string $VideoId;
    public static string $VideoTitle;
    public static string $VideoDescription;
    public static string $ThumbnailUrl;
    public static string $UploadDate;
    public static string $Link;
    public static string $LinkEmbed;

    public static string $ErrorMessage;

    function __construct()
    {

    }

    public static function makeTrailer($url) {
        $embedLink = '<iframe class="trailers" src="' . $url . '" title="Trailer Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        return $embedLink;
    }
}
?>