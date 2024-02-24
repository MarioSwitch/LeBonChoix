<?php
$count = intSQL("SELECT COUNT(*) FROM `games`");
echo "<h1>Liste des parties</h1>";
echo "<p>Ci-dessous, la liste des " . $count . " parties.</p>";
echo "<hr>";

//Parties en cours
$games = arraySQL("SELECT * FROM `games` WHERE `finished` IS NULL ORDER BY `id` ASC;");
$count = $games?count($games):0;
echo "<h2>Parties en cours (" . $count . ")</h2>";
echo "<table><tr><th>ID ▲</th><th>Création (UTC)</th><th>Joueurs</th><th>Choix</th></tr>";
if(!$games){
    echo "<tr><td colspan='4'>Aucune partie en cours</td></tr>";
}else{
    for($i = 0; $i < $count; $i++){
        $link_game = "?view=game&id=" . $games[$i]["id"];
        $id = $games[$i]["id"];
        $created = $games[$i]["created"];
        $players = $games[$i]["players"];
        $alreadyPlayed = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ?;", [$id]);
        $choices = $games[$i]["choices"];
        echo "<tr><td><p><a href=\"" . $link_game . "\">". $id . "</a></p></td><td>" . $created . "</td><td>" . $alreadyPlayed . " / " . $players . "</td><td>" . $choices . "</tr>";
    }
}
echo "</table>";
echo "<hr>";

//Parties terminées
$games = arraySQL("SELECT * FROM `games` WHERE `finished` IS NOT NULL ORDER BY `finished` DESC;");
$count = $games?count($games):0;
echo "<h2>Parties terminées (" . $count . ")</h2>";
echo "<table><tr><th>ID</th><th>Création (UTC)</th><th>Fin (UTC) ▼</th><th>Joueurs</th><th>Choix</th></tr>";
if(!$games){
    echo "<tr><td colspan='5'>Aucune partie terminée</td></tr>";
}else{
    for($i = 0; $i < $count; $i++){
        $link_game = "?view=game&id=" . $games[$i]["id"];
        $id = $games[$i]["id"];
        $created = $games[$i]["created"];
        $finished = $games[$i]["finished"];
        $players = $games[$i]["players"];
        $choices = $games[$i]["choices"];
        echo "<tr><td><p><a href=\"" . $link_game . "\">". $id . "</a></p></td><td>" . $created . "</td><td>" . $finished . "</td><td>" . $players . "</td><td>" . $choices . "</tr>";
    }
}
echo "</table>";
?>