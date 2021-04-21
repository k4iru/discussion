<?php

use PhPKnights\Model\Movie;

class TrailerData extends Movie{
  private static string $VideoId;
  private static string $VideoTitle;
  private static string $VideoDescription;
  private static string $ThumbnailUrl;
  private static string $UploadDate;
  private static string $Link;
  private static string $LinkEmbed;


  /**
   * TrailerData Constructor Function
  */
  function __construct()
  {

  }

  /**
   * GETTER/SETTER FOR $VideoId
   */
  function set_VideoId($VideoId)
  {
    $this->VideoId = $VideoId;
  }
  function get_VideoId()
  {
    return $this->VideoId;
  }

  /**
   * GETTER/SETTER FOR $VideoTitle
   */
  function set_VideoTitle($VideoTitle)
  {
    $this->VideoTitle = $VideoTitle;
  }
  function get_VideoTitle()
  {
    return $this->VideoTitle;
  }

  /**
   * GETTER/SETTER FOR $VideoDescription
  */
  function set_VideoDescription($VideoDescription)
  {
    $this->VideoDescription = $VideoDescription;
  }
  function get_VideoDescription()
  {
    return $this->VideoDescription;
  }

  /**
   * GETTER/SETTER FOR $ThumbnailUrl
   */
  function set_ThumbnailUrl($ThumbnailUrl)
  {
    $this->ThumbnailUrl = $ThumbnailUrl;
  }
  function get_ThumbnailUrl()
  {
    return $this->ThumbnailUrl;
  }

  /**
   * GETTER/SETTER FOR $UploadDate
   */
  function set_UploadDate($UploadDate)
  {
    $this->UploadDate = $UploadDate;
  }
  function get_UploadDate()
  {
    return $this->UploadDate;
  }

  /**
   * GETTER/SETTER FOR $Link
   */
  function set_Link($Link)
  {
    $this->Link = $Link;
  }
  function get_Link()
  {
    return $this->Link;
  }

  /**
   * GETTER/SETTER FOR $LinkEmbed
   */
  function set_LinkEmbed($LinkEmbed)
  {
    $this->LinkEmbed = $LinkEmbed;
  }
  function get_LinkEmbed()
  {
    return $this->LinkEmbed;
  }

  /**
   * @author Bryan Hughes
   * @return $ModifiedLink Takes it's $LinkEmbed property and Modifies it to be displayed in a webpage
   */
  public function makeTrailer()
  {
    //Open an iframe element tag
    $ModifiedLink = '<iframe class="trailer-frame" src="';
    //Append the Embeddable Link
    $ModifiedLink .=  $this->LinkEmbed;
    //Append the remaining iframe data and the closing iframe tag
    $ModifiedLink .= '" title="Trailer Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    //Return the modified link
    return $ModifiedLink;
  }
}

?>