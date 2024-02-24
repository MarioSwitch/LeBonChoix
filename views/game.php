<?php
$gameExists = intSQL("SELECT COUNT(*) FROM `games` WHERE `id` = ?;", [$_REQUEST["id"]]);
if(!$gameExists){
    echo("<h1>Cette partie n'existe pas !</h1>");
    die("");
}
$game = arraySQL("SELECT * FROM `games` WHERE `id` = ?;", [$_REQUEST["id"]]);
$game = $game[0];
echo("<h1>Partie №" . $_REQUEST["id"] .  "</h1>");
$players = $game["players"];
$choices = $game["choices"];
$players_count = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ?;", [$_REQUEST["id"]]);
echo "<p>" . $players_count . " sur " . $players . " joueurs</p>";
echo "<p>" . $choices . " choix</p>";
echo "<hr>";
$gameCreated = $game["created"];
$gameCreatedDate = substr($gameCreated,0,10);
$gameCreatedTime = substr($gameCreated,11,8);
echo "<script src='countdown.js'></script>";
echo "<script>countdownTo('" . $gameCreatedDate . "T" . $gameCreatedTime . "Z', 'dans %countdown', 'il y a %countup', 'createdCountdown');</script>";
echo "<p>Créé <abbr id='createdCountdown' title='" . $gameCreated . " UTC'></abbr></p>";
//Split the code into two parts
if($game["finished"] == ""){
    include("views/gameInProgress.php");
}else{
    include("views/gameFinished.php");
}
?>