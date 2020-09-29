<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $_GET['id']);
$data =  json_decode($pokemonData, true);
$image = $data['sprites']['front_shiny'];
$imageData = base64_encode(file_get_contents($image));
$value = "";
$numbers = array();

while (count($numbers) > 4) {
    $value = rand(0,count($data['moves']));
    echo $data['moves'][$value]['move']['name'];

}

echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
echo $data['id'];
echo $data['name'];

echo $data['moves'][$value]['move']['name'];
echo $data['moves'][$value]['move']['name'];
echo $data['moves'][$value]['move']['name'];
echo $data['moves'][$value]['move']['name'];

//echo var_dump($data);