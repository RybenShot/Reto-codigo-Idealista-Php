<?php

class Picture
{
  public int $id;
  public String $url;
  public String $quality;

     function __construct($aid, $aurl, $aquality) {
      $this->id = $aid;
      $this->url = $aurl;
      $this->quality = $aquality;
    }
}

$separa = "<br>";
$hr = '<hr>';

?>
