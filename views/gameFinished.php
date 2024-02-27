<?php
if (basename($_SERVER["PHP_SELF"]) != "index.php"){
	header("Location:../index.php?view=home");
	die("");
}

//Variables
$gameFinished = $game["finished"];
$gameFinishedDate = substr($gameFinished,0,10);
$gameFinishedTime = substr($gameFinished,11,8);
$choice = intSQL("SELECT `choice` FROM `choices` WHERE `game` = ? AND `ip` = ?;", [$_REQUEST["id"], $_SERVER["REMOTE_ADDR"]]);
$same_choice = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $choice]);
$same_choice = $same_choice - 1;
$same_choice_nicknames = arraySQL("SELECT `nickname` FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $choice]);
$player_nickname = stringSQL("SELECT `nickname` FROM `choices` WHERE `game` = ? AND `ip` = ?;", [$_REQUEST["id"], $_SERVER["REMOTE_ADDR"]]); 

//Texte
echo "<script src='countdown.js'></script>";
echo "<script>countdownTo('" . $gameFinishedDate . "T" . $gameFinishedTime . "Z', 'dans %countdown', 'il y a %countup', 'finishedCountdown');</script>";
echo "<p>Terminé <abbr id='finishedCountdown' title='" . $gameFinished . " UTC'></abbr></p>";
echo "<hr>";
echo "<h2>Bilan de la partie</h2>";
if($same_choice == 0){
    echo "<p>Vous avez sélectionné le choix №$choice et êtes le seul à l'avoir choisi. Vous êtes un des gagnants de cette partie ! Bravo 🎉 !</p>";
}else{
    echo "<p>Vous avez sélectionné le choix №$choice, comme $same_choice autre(s) personne(s). Vous avez perdu 😓.</p><br>
    <p>Personne(s) ayant sélectionné le même choix que vous :<br>";
    for($i = 0; $i < count($same_choice_nicknames); $i++){
        $nickname = $same_choice_nicknames[$i]["nickname"];
        if($nickname != $player_nickname) echo "$nickname<br>";
    }
}
echo "<br><table>";
for($i = 1; $i <= $choices; $i++){
    if($i % 10 == 1){
        echo "<tr>";
    }
    $nicknames = arraySQL("SELECT `nickname` FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $i]);
    if($nicknames){
        if(count($nicknames) == 1) $style = "class='win'";
        if(count($nicknames) > 1) $style = "class='lose'";
    }else{
        $style = "";
    }
    echo "<td $style>№$i<br><br>";
    if(!$nicknames){
        echo "—";
    }else{
        for($j = 0; $j < count($nicknames); $j++){
            $nickname = $nicknames[$j]["nickname"];
            if($nickname == $player_nickname) echo "<i>$nickname</i><br>";
            else echo "$nickname<br>";
        }
    }
    echo "</td>";
    if($i % 10 == 0){
        echo "</tr>";
    }
}
echo "</table>"
?>