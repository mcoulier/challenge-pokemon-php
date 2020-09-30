<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $_GET['id']);
$data =  json_decode($pokemonData, true);
$image = $data['sprites']['front_shiny'];
$imageData = base64_encode(file_get_contents($image));
$randArray = [];

for ($i = 0; $i > count($data['moves']); $i++){
    $value = rand(0, count($data['moves']));
    $randArray[] = $value;
    echo $data['moves'][$value]['move']['name'];
}

echo implode($randArray);

echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
echo $data['id'];
echo $data['name'];

//echo var_dump($data);