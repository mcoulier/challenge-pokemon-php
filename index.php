<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['id'])) {
    $nameId = $_GET['id'];
    $pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $nameId);
    $data = json_decode($pokemonData, true);

    if ($data['name'] !== null) {
        $image = $data['sprites']['front_shiny'];
        $imageData = base64_encode(file_get_contents($image));
        $moveCount = count($data['moves']);
        $randArray = [];

        for ($i = 0; $i <= $moveCount && $i < 4; $i++) {
            $value = rand(0, count($data['moves']));
            $randArray[] = $value;
        }

        $speciesData = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $_GET ['id']);
        $evoData = json_decode($speciesData, true);
        $prevEvo = $evoData["evolves_from_species"]['name'];

        if ($prevEvo !== null){
            $evoChain = file_get_contents (rtrim($evoData ["evolution_chain"]["url"],'/'));
            $evoDecode = json_decode($evoChain, true);
            $prevName = @file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $prevEvo);
            $prevDecode = json_decode($prevName, true);
            $prevImg = $prevDecode['sprites']['front_shiny'];
            $showPrevImg = base64_encode(file_get_contents($prevImg));
        } else {
            $evoData= "";
        }

    }
}



//$nextEvo = $evoDecode['chain']['evolves_to'][0]['evolves_to'][0]['species']['name'];


//if (isset($nextEvo) === null){
//    echo $nextEvo = "";
//} else {
//}

//----Loop to get 4 random moves

//for ($i = 0; $i < 5; $i++){
//    $value = rand(0, count($data['moves']));
//    $randArray[] = $value;
//    echo $data['moves'][json_encode($value)]['move']['name'];
//}

//--------------------------------

//if (isset($_GET['id'])) {
//    $pokemon = $_GET['id'];
//} else {
//    $pokemon = "1";
//}

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
    Name/ID: <input type="text" name="id"><br>
    <input type="submit" value="Submit">
</form>

<img id="pokeImage" src="<?php echo $image?>">

<p id="idNumber">ID: <?php echo $data['id']?>
</p>

<p id="name">Name: <?php echo $data['name']?>
</p>

<p id="moves">Moves:
<ul id="moves"><?php for ($i = 0;$i <= $moveCount && $i < 4; $i++){
        $value = rand(0, count($data['moves']));
        $randArray[] = $value;
        echo $data['moves'][json_encode($value)]['move']['name'] . "<br>";
    }?>
</ul>
</p>


<p id="prevEvolution">Previous Evolution: <?php if (isset ($prevEvo)){
    echo $prevEvo;
        echo '<img src="data:image/jpeg;base64,'.$showPrevImg.'">';
    } else {
    echo "";
    };?></p>


</body>
</html>