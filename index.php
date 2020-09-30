<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $_GET['id']);
$speciesData = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $_GET ['id']);
$data =  json_decode($pokemonData, true);
$evoData = json_decode($speciesData, true);
$image = $data['sprites']['front_shiny'];
$imageData = base64_encode(file_get_contents($image));
$randArray = [];

echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
echo $data['id'];
echo $data['name'];

echo $evoData["evolves_from_species"]["name"];

for ($i = 0; $i < 5; $i++){
    $value = rand(0, count($data['moves']));
    $randArray[] = $value;
    echo $data['moves'][json_encode($value)]['move']['name'];
}

//echo var_dump($data);