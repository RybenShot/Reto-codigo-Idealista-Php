<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prueba de codigo Idealista</title>
</head>
<body>

<?php
include "./templates2/adHelper.php";
include "./templates2/pictoreHelper.php";

$ads = array();
$pictures = array();

array_push($ads , new Ad(1, 'CHALET', 'Este piso es una ganga, compra, compra, COMPRA!!!!!', [], 300, null, null));
array_push($ads, new Ad(2, 'FLAT', 'Nuevo ático céntrico recién reformado. No deje pasar la oportunidad y adquiera este ático de lujo', [4], 300, null, null));
array_push($ads, new Ad(3, 'CHALET', '', [2], 300, null, null, null));
array_push($ads, new Ad(4, 'FLAT', 'Ático céntrico muy luminoso y recién reformado, parece nuevo', [5], 300, null, null));
array_push($ads, new Ad(5, 'FLAT', 'Pisazo',[3, 8], 300, null, null));
array_push($ads, new Ad(6, 'GARAGE', '', [6], 300, null, null, null));
array_push($ads, new Ad(7, 'GARAGE', 'Garaje en el centro de Albacete', [], 300, null, null));
array_push($ads, new Ad(8, 'CHALET', 'Maravilloso chalet situado en lAs afueras de un pequeño pueblo rural. El entorno es espectacular, las vistas magníficas. ¡Cómprelo ahora!', [1, 7], 300 ,123, null));

array_push($pictures, new Picture(1, 'https://www.idealista.com/pictures/1', 'SD'));
array_push($pictures, new Picture(2, 'https://www.idealista.com/pictures/2', 'HD'));
array_push($pictures, new Picture(3, 'https://www.idealista.com/pictures/3', 'SD'));
array_push($pictures, new Picture(4, 'https://www.idealista.com/pictures/4', 'HD'));
array_push($pictures, new Picture(5, 'https://www.idealista.com/pictures/5', 'SD'));
array_push($pictures, new Picture(6, 'https://www.idealista.com/pictures/6', 'SD'));
array_push($pictures, new Picture(7, 'https://www.idealista.com/pictures/7', 'SD'));
array_push($pictures, new Picture(8, 'https://www.idealista.com/pictures/8', 'HD'));

function comprovateAll($ads, $pictures){
  for ($i=0; $i < count($ads); $i++) { 
    echo ' ----------------> COMPROBAMOS EL ANUNCIO CON ID: '. $ads[$i]->id . " <---------------- <br>";
    CalidadFotos($i, $ads, $pictures);
    DescripcionExiste($i, $ads);
    PalabrasClave($i, $ads);
    AnuncioCompleto($i, $ads);
    echo '<hr>';
    }
}
comprovateAll($ads, $pictures);


//Comprobamos  la calidad de las FOTOS;
function CalidadFotos($i, $ads, $pictures){

   if (count($ads[$i]->pictures) > 0 ) {
   checkInPicture($i, $pictures, $ads);
   } else {
     echo  'El anuncio con id: '. $ads[$i]->id . " no tiene foto, -10 Pts <br>";
     $ads[$i]->score = $ads[$i]->score - 10;
   }
 }
 //Comprobacion de calidad foto en $pictures
  function checkInPicture($i, $pictures, $ads) {

   if ($pictures[$i]->quality == "HD") {
    echo 'El anuncio con id: '. $ads[$i]->id . " tiene la foto en HD, + 20 Pts por foto <br>";
    $ads[$i]->score = $ads[$i]->score + 20 *  array_sum($ads[$i]->pictures) ;

  } else if ($pictures[$i]->quality == "SD") {
    echo 'El anuncio con id: '. $ads[$i]->id . " tiene la foto en SD, + 10 Pts por foto <br>";
    $ads[$i]->score = $ads[$i]->score + 10 *  array_sum($ads[$i]->pictures);
  }
}

//Comprovamos la descripcion y el numero de CARACTERES
function  DescripcionExiste($i, $ads){
  switch ($ads[$i]->description) {
    case true:
      TypologyDescription($i ,$ads);
      break;
    
    default:
      echo 'El anuncio con id: '. $ads[$i]->id . " no tiene descripcion<br>";
      break;
    }
  }
  function TypologyDescription($i ,$ads){
    switch ($ads[$i]->typology) {

      case 'FLAT':
        FlatTypology($i ,$ads);
        break;

      case 'CHALET':
        ChaletTypology($i ,$ads);
        break;
      
      default:
        echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion <br>"; 
        $ads[$i]->score = $ads[$i]->score + 5 ;
        break;
    }
  }

  function ChaletTypology($i ,$ads){

    if (strlen($ads[$i]->description) >= 50 ) {
      echo 'El anuncio con id: '. $ads[$i]->id .  ' se le suma 5 Pts por la descripcion y 20 Pts por tener mas de 50 caracteres CHALET. <br>';
      $ads[$i]->score = $ads[$i]->score + 5 + 20;
    } 
    else {
      echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion. no ha llegado a tener los requisitos minimos para ganar 20 Pts <br>";
      $ads[$i]->score = $ads[$i]->score + 5 ;
    }
  }

  function FlatTypology($i ,$ads){

     if (strlen($ads[$i]->description) >= 50 ) {
       echo 'El anuncio con id: '. $ads[$i]->id .  ' se le suma 5 Pts por la descripcion y 20 Pts por tener mas de 50 caracteres FLAT. <br>';
       $ads[$i]->score = $ads[$i]->score + 5 + 20;
     } 
     else if (strlen($ads[$i]->description) >= 20 && strlen($ads[$i]->description) <= 49) {
       echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion y 10 Pts por tener entre 20 y 49 caracteres. <br>";
       $ads[$i]->score = $ads[$i]->score + 5 + 10;
     }
     else {
       echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion. no ha llegado a tener los requisitos minimos para ganar 10 Pts <br>";
       $ads[$i]->score = $ads[$i]->score + 5 ;
     }
}

// OTRA FORMA DE HACERLO pero sin cumplir el principio de responsavilidad unica y repitiendo codigo. Code smell
  // for ($i=0; $i < count($ads); $i++) { 
  //   if ($ads[$i]->description == true && $ads[$i]->typology == 'FLAT' && strlen($ads[$i]->description) >= 50 ) {
  //     echo 'El anuncio con id: '. $ads[$i]->id .  ' se le suma 5 Pts por la descripcion y 20 Pts por tener mas de 50 caracteres FLAT. <br>';
  //     $ads[$i]->score = $ads[$i]->score + 5 + 20;
  //   } 
  //   else if ($ads[$i]->description == true && $ads[$i]->typology == 'FLAT' && strlen($ads[$i]->description) >= 20 && strlen($ads[$i]->description) <= 49) { // Con   este caso no coincide ninguno, asi que no te preocupes
  //     echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion y 10 Pts por tener entre 20 y 49 caracteres. <br>";
  //     $ads[$i]->score = $ads[$i]->score + 5 + 10;
  //   } 
  //   else if ($ads[$i]->description == true && $ads[$i]->typology == 'CHALET' && strlen($ads[$i]->description) > 50) {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por la descripcion y 20 Pts por tener mas de 50 caracteres CHALET <br>";
  //     $ads[$i]->score = $ads[$i]->score + 5 + 20;
  //   } 
  //   else if ($ads[$i]->description == true ) {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " se le suma 5 Pts por al descripcion <br>";
  //     $ads[$i]->score = $ads[$i]->score + 5 ;
  //   }
  //    else {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " no tiene descripcion<br>";
  //   }
// }

// Comprovamos PALABRAS CLAVE, Luminoso, Nuevo, Céntrico, Reformado, Ático
function PalabrasClave($i, $ads){
  switch ($ads) {

    case str_contains($ads[$i]->description, 'luminoso'):
      echo "==> se ha encontrado Luminoso. + 5 Pts <br>";
      $ads[$i]->score = $ads[$i]->score + 5 ;

    case str_contains($ads[$i]->description, 'nuevo'):
      echo "==> se ha encontrado Nuevo. + 5 Pts <br>";
      $ads[$i]->score = $ads[$i]->score + 5 ;

    case str_contains($ads[$i]->description, 'céntrico'):
      echo "==> se ha encontrado Céntrico. + 5 Pts <br>";
      $ads[$i]->score = $ads[$i]->score + 5 ;

    case str_contains($ads[$i]->description, 'reformado'):
      echo "==> se ha encontrado Reformado. + 5 Pts <br>" ;
      $ads[$i]->score = $ads[$i]->score + 5 ;

    case str_contains($ads[$i]->description, 'ático'):
      echo "==> se ha encontrado Ático. + 5 Pts <br>";
      $ads[$i]->score = $ads[$i]->score + 5 ;

    case $ads[$i]->description == true:
      break;

    default:
    echo 'El anuncio con id: '. $ads[$i]->id .' NO TIENE DESCRIPCION <br>';
    break;
  }
}

// Comprovamos si los anuncios estan COMPLETOS O NO
function AnuncioCompleto($i, $ads){
  switch ($ads[$i]->typology) {
    case 'FLAT':
      CompleteFlat($i, $ads);
      break;
    
    case 'CHALET':
      CompleteChalet($i, $ads);
      break;
    
    case 'GARAGE':
      CompleteGarage($i, $ads);
      break;
    }
  }

  function CompleteFlat($i, $ads){
    if ($ads[$i]->description && count($ads[$i]->pictures) > 0 && $ads[$i]->houseSize != null ) {
      echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos CHALET <br> ";
      $ads[$i]->score = $ads[$i]->score + 40;
    }
    else {
      echo '>>>>> No se ha rellenado todo el formulario <<<<<';
    }
  }

  function CompleteChalet($i, $ads){
    if ($ads[$i]->description && count($ads[$i]->pictures) > 0 && $ads[$i]->houseSize != null && $ads[$i]->gardenSize != null) {
      echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos CHALET <br> ";
      $ads[$i]->score = $ads[$i]->score + 40;
    }
    else {
      echo '>>>>> No se ha rellenado todo el formulario <<<<<';
    }
  }
  
  function CompleteGarage($i, $ads){
    if (count($ads[$i]->pictures) > 0) {
      echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos GARAJE <br> ";
      $ads[$i]->score = $ads[$i]->score + 40;
    }
    else {
      echo '>>>>> No se ha rellenado todo el formulario <<<<<';
    }
}
// Como lo hice al principio 
  // for ($i=0; $i < count($ads); $i++) { 
  //   if ($ads[$i]->typology == 'CHALET' && $ads[$i]->description && count($ads[$i]->pictures) > 0 && $ads[$i]->houseSize != null && $ads[$i]->gardenSize != null ) {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos CHALET <br> ";
  //     $ads[$i]->score = $ads[$i]->score + 40;
  //     } else if ($ads[$i]->typology == 'FLAT' && $ads[$i]->description && count($ads[$i]->pictures) > 0 && $ads[$i]->houseSize != null ) {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos FLAT  <br> ";
  //     $ads[$i]->score = $ads[$i]->score + 40;
  //     } else if ($ads[$i]->typology == 'GARAGE' && count($ads[$i]->pictures) > 0 ) {
  //     echo 'El anuncio con id: '. $ads[$i]->id . " ha completado los requisitops minimos . + 40 Ptos GARAJE <br> ";
  //     $ads[$i]->score = $ads[$i]->score + 40;
  //     } else {
  //       // echo "Este no ha rellenado todo el formulario necesario <br>";
  //     }
// }

echo $hr ;
echo $hr ;
echo $separa ;
echo $separa ;

// Pintar al cliente solo las mejores opciones , deben cumplir mas de 'filterByPoints' Pts
echo 'Pintamos al cliente SOLO ANUNCIOS CON MAS DE X PUNTOS <br>';
echo $separa ;
function filterByPoints($filterForPoint , $ads){
  for ($i=0; $i < count($ads); $i++) { 
  if ($ads[$i]->score > $filterForPoint) {
    echo 'El anuncio con id: '. $ads[$i]->id .' ' . $ads[$i]->typology .' ' . $ads[$i]->description . '<br>';
  }else {
    // echo "--- Ha a pasado un anuncion irrelevante --- <br>";
  }
  } 
}
filterByPoints(40, $ads);// Lo dejo como funcion por si se quisiera cambiar el filtro mas adelante

echo $hr ;

//Enseñar al admin TODOS los anuncios para admin
echo 'A continuacion se enseña TODOS LOS ANUNCIONS para el Admin <br>';
echo $separa ;
function ShowAll($ads){
  for ($i=0; $i < count($ads); $i++) { 
    echo 'El anuncio con id: '. $ads[$i]->id .' ' . $ads[$i]->typology .' ' . $ads[$i]->description . '<br>';
  }
}
ShowAll($ads);

echo $hr ;

//Comprovacion de Puntos de cada 
echo 'Comprovamos la puntuacion de TODOS los anuncios <br>';
echo $separa ;
function ShowAllScores($ads){
  for ($i=0; $i < count($ads); $i++) { 
  echo "El anuncio con la id " . $ads[$i]->id . " tiene una puntuacion de " . $ads[$i]->score . '<br>';
  }
}
ShowAllScores($ads);

echo $hr ;

// EXTRA funcion que devuelve todos los anuncios que se quiere buscar a traves del 'typology'
echo 'EXTRA hacemos una busqueda de "GARAGE", "FLAT" o "CHALET" <br>';
echo $separa ;
function FundByTypology($tipoInmueble, $ads){
  for ($i=0; $i < count($ads) ; $i++) { 
    if ($tipoInmueble === $ads[$i]->typology) {
      echo 'Este anuncio coincide con tu busqueda ' . $ads[$i]->typology . '<br>'  ;
      //Pongo un simple echo pero aqui para que se muestre que funciona la funcion. Se podrian mostrar todos los datos del anuncio, un enlace a otra pestaña con sus fotos y otros datos.
    }
  }
}
$find = 'GARAGE'; // "GARAGE", "FLAT" o "CHALET"
FundByTypology($find, $ads);

echo $hr ;

// Pintar los anuncion en orden descendente por el "score", los mas puntuados van primero.
// Se que se tiene que ordenar con usort, arsort o rsort,  pero actualmente no consigo que funcione correctamente.


// Tenga en cuenta que he conseguido hacer lo que ve, habiendo aprendido las bases de php en 3 dias por mi propia cuenta y los posteriores 6 dias los he dedicado a hacer el ejercicio y buscando mas y mas, como se mezclan funciones , como operar con los Arrays, como crear nuevos objetos con las clases. Si en tan poco tiempo he sido capaz de aprender tanto, imaginese cuando lleve un mes en su empresa. 
// Espero con ganas su respuesta. Un saludo.

?>

<hr>

<h1> Reto: Servicio para gestión de calidad de los anuncios</h1>
</body>
</html>