<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//---Getting input data---------------------
if (isset($_GET['id'])) {
    $nameId = $_GET['id'];
    $pokemonData = file_get_contents('https://pokeapi.co/api/v2/pokemon/' . $nameId);
    $data = json_decode($pokemonData, true);
    $pokeName = $data['name'];
    $pokeId = $data['id'];
    $pokeType = $data['types'][0]['type']['name'];


//---Getting image and moves from api--------
    if ($pokeName !== null) {
        $image = $data['sprites']['front_shiny'];
        $imageData = base64_encode(file_get_contents($image));
        $moveCount = count($data['moves']);
        $randArray = [];
//---Loop to get 4 moves---------------------
        for ($i = 0; $i <= $moveCount && $i < 4; $i++) {
            $value = rand(0, $moveCount);
            $randArray[] = $value;
            $fourMoves = $data['moves'][json_encode($value)]['move']['name'];
        }
//---Getting data for evolutions--------------
        $speciesData = file_get_contents('https://pokeapi.co/api/v2/pokemon-species/' . $_GET ['id']);
        $evoData = json_decode($speciesData, true);
//---Getting image & name for evolution--------
        if ($evoData["evolves_from_species"] !== null){
            $evoChain = file_get_contents (rtrim($evoData ["evolution_chain"]["url"],'/'));
            $evoDecode = json_decode($evoChain, true);
            $prevEvo = $evoData["evolves_from_species"]['name'];
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
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h1><img src="https://www.iconfinder.com/data/icons/pokemon-go-5/100/4-512.png" width="32" height="32"> Pokédex</h1>

<div id="searchPokemon">

    <form action="index.php" method="get">
        <b>Name/ID: </b><input type="text" name="id" placeholder="Enter name or ID"><br>
        <input type="submit" value="Submit">
    </form>

    <img id="pokeImage" src="<?php if (isset ($image)) {
    echo $image;

} else {
    $image = "";
} ?>">

    <p id="name"><b>ID: </b><?php if (isset($pokeId)){
        echo "#".$pokeId;
    } else {
        $pokeId = "";
    }
    ?>
</p>

    <p id="name"><b>Name: </b><?php if (isset($pokeName)){
        echo $pokeName;
    } else {
    $pokeName = "";
    }
    ?>
</p>

    <p id="moves"><b>Moves:</b>
<ul id="moves"><?php if (isset($fourMoves)){
    for ($i = 0; $i <= $moveCount && $i < 4; $i++){
        $value = rand(0, $moveCount);
        $randArray[] = $value;
        echo $data['moves'][json_encode($value)]['move']['name'] . "<br>";
    }
    } else {
        $fourMoves = "";
    }
    ?>
</ul>
</p>

    <p id="name"><b>Type: </b><?php if (isset($pokeType)){
            echo $pokeType;
        } else {
            $pokeType = "";
        }
        ?>
    </p>

</div>

<div id="evolutionPokemon">
    <p id="prevEvolution"><b>Previous Evolution: </b></p>
<p>
<?php if (isset ($prevEvo)){
        echo '<img src="data:image/jpeg;base64,'.$showPrevImg.'">' . "<br>";
    echo "<b>Name: </b>" . $prevEvo;
    } else {
    echo "";
    };?>
</p>
</div>
</body>
</html>