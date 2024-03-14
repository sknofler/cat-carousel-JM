<?php
//echo "<p>WTF</p>";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start(); /* this allows you to save data in $_SESSION */
/* https://www.w3schools.com/php/php_sessions.asp */


// Make HTTP request and wait for the response
// $response = file_get_contents("$apiUrl?$queryString");


/* write PHP functions here */
function getCatBreeds(){
   //echo "getCatBreeds Called";
   $form = "<form action='carousel.php' method='get'>";
   $form.= '<select class="form-select" name="catBreeds">';
  
   $apiUrl = "https://api.thecatapi.com/v1/breeds";
   $data = json_decode(file_get_contents($apiUrl));
   for($i = 0; $i < count($data); $i++){
      $id = $data[$i]->id;
      $breed = $data[$i]->name;
      $form.= "<option value= $id > $breed </option>";
   }

  $form.= '</select>';
  $form.="<button  type='submit' class='btn btn-primary'>Submit</button>";
   $form.="</form>";
   return $form;
}

function getCat(){
   $id = $_GET["catBreeds"]; #the correct id 
   //$name = $_Get["$breed"]; #the correct name

   $apiUrl = "https://api.thecatapi.com/v1/images/search?limit=10&breed_ids=$id";
   //echo $apiUrl;
   //$data = file_get_contents($apiUrl);
   //cho $response;
   $data = json_decode(file_get_contents($apiUrl));
   //var_dump($data);
   
   # https://api.thecatapi.com/v1/images/search?limit=10&breed_ids=beng&api_key=REPLACE_ME

   $form = "<div id='carouselExampleControls' class='carousel slide' data-bs-ride='carousel'> <div class='carousel-inner'>";
   //$form = '<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel"><div class="carousel-inner">';
    $limit = count($data);
   
    for($i = 0; $i < $limit; $i++){
      $url = $data[$i]->url;
      //$form.="<div class='carousel-item'><img class='d-block w-100' src='$url' alt='$id'></div>";
      if($i == 0){
         $form.="<div class='carousel-item active'><img class='d-block w-100' src='$url' alt='Cat'></div>";
      }
      else{
         $form.="<div class='carousel-item'><img class='d-block w-100' src='$url' alt='Cat'></div>";
      }
    //echo $form;
   }

   //$form.="</div></div>";
   $form.= "</div>";
   $form.='<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
   <span class="carousel-control-prev-icon" aria-hidden="true"></span>
   <span class="visually-hidden">Previous</span>
 </button>
 <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
   <span class="carousel-control-next-icon" aria-hidden="true"></span>
   <span class="visually-hidden">Next</span>
 </button>';
   $form.="</div>";
   return $form;
 }





?>