<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/');
$userInput = $_POST['pokeInput'];
var_dump(json_decode($pokemonData, true));
