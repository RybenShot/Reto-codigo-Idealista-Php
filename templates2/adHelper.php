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
  //Lo que pretendia hacer es que a la hora de la creacion del objeto, se ejecutara la comprovacion de "comprovacion" para asi hacer el calculo al moemnto y reasignar el valor del '$score' a su corresponsiente resultado.
  // Para asi separar el codigo un poco. 

  // function comprovacion(){ 
  // switch ($typology) {
  //   case 'CHALET':
  //     if ($description && $pictures >= 1 && $houseSize != null && gardenSize != null) {
  //       $this->score = $this->score + 40;
  //       echo "se ha comprovado correctamente los datos rellenados";
  //     }
  //     break;
  //   case 'FLAT':
  //     if ($description && $pictures >= 1 && $houseSize != null) {
  //       $this->score = $this->score + 40;
  //       echo "se ha comprovado correctamente los datos rellenados";
  //     }
  //     break;
  //   case 'GARAGE':
  //     if ($pictures >= 1 ) {
  //       $this->score = $this->score + 40;
  //       echo "se ha comprovado correctamente los datos rellenados del garaje";
  //     break;
    
  //   default:
  //     echo "ha habido un problema<br> ";
  //     break;
  // }
  // }

}

?>
