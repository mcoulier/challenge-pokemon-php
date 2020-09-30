<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $_GET['id']);
$speciesData = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $_GET ['id']);

$data =  json_decode($pokemonData, true);
$evoData = json_decode($speciesData, true);

$evoChain = file_get_contents ($evoData ["evolution_chain"]["url"]);
$evoDecode = json_decode($evoChain, true);
$nextEvo = $evoDecode['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];

$image = $data['sprites']['front_shiny'];
$imageData = base64_encode(file_get_contents($image));
$randArray = [];


echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
echo $data['id'];

for ($i = 0; $i < 5; $i++){
    $value = rand(0, count($data['moves']));
    $randArray[] = $value;
    echo $data['moves'][json_encode($value)]['move']['name'];
}

echo $evoData["evolves_from_species"]["name"];
echo $nextEvo;


//echo var_dump($data);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Pokédex</h1>

<form action="index.php" method="get">
    pokemonName: <input type="text" name="id"><br>
    <input type="submit" value="Submit">

<p id="name"><?php echo $data['name']?>
</p>

</form>
</body>
</html>
