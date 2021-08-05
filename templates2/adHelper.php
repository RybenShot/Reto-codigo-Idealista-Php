<?php
// date_default_timezone_set("UTC");

class Ad {
  public int $id;
  public String $typology;
  public String $description;
  public array $pictures;
  public int $houseSize;
  public ?int $gardenSize;
  public ?int $score;
  public $datePublicated ;


   function __construct($aid, $atypology, $adescription, $apictures, $ahouseSize, $agardenSize , $ascore){
      $this->id = $aid;
      $this->typology = $atypology;
      $this->description = strtolower($adescription); // Para poner toda la descripcion en minuscula 
      $this->pictures = $apictures;
      $this->houseSize = $ahouseSize;
      $this->gardenSize = $agardenSize;
      $this->score = $ascore;
      $this->datePublicated = date("mdy");
  }
}

?>
