<h1>Le Bon Choix</h1>
<hr>
<?php
$open_games = arraySQL("SELECT * FROM `games` WHERE `finished` IS NULL;");
$open_games_count = intSQL("SELECT COUNT(*) FROM `games` WHERE `finished` IS NULL;");
echo "<h2>Parties en cours ($open_games_count)</h2>";
if(!$open_games_count){
    echo "<p>Aucune partie en cours</p>";
    die("");
}
for($i = 0; $i < $open_games_count; $i++){
    $id = $open_games[$i]["id"];
    $players = $open_games[$i]["players"];
    $choices = $open_games[$i]["choices"];
    $players_count = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ?;", [$id]);
    $players_remaining = $players - $players_count;
    echo "<a href='?view=game&id=" . $id . "'>Partie №" . $id . " <small>(encore " . $players_remaining . " joueurs (" . $players_count . " / " . $players . "), " . $choices . " choix)</small></a>";
}
?>