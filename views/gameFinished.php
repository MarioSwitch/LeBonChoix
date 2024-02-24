<?php
//Variables
$gameFinished = $game["finished"];
$gameFinishedDate = substr($gameFinished,0,10);
$gameFinishedTime = substr($gameFinished,11,8);
$choice = intSQL("SELECT `choice` FROM `choices` WHERE `game` = ? AND `ip` = ?;", [$_REQUEST["id"], $_SERVER["REMOTE_ADDR"]]);
$same_choice = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $choice]);
$same_choice = $same_choice - 1;
$same_choice_ip = arraySQL("SELECT `ip` FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $choice]);

//Texte
echo "<script src='countdown.js'></script>";
echo "<script>countdownTo('" . $gameFinishedDate . "T" . $gameFinishedTime . "Z', 'dans %countdown', 'il y a %countup', 'finishedCountdown');</script>";
echo "<p>Terminé <abbr id='finishedCountdown' title='" . $gameFinished . " UTC'></abbr></p>";
echo "<hr>";
echo "<h2>Bilan de la partie</h2>";
if($same_choice == 0){
    echo "<p>Vous avez sélectionné le choix №$choice et êtes le seul à l'avoir choisi. Vous êtes un des gagnants de cette partie ! Bravo 🎉 !</p>";
}else{
    echo "<p>Vous avez sélectionné le choix №$choice, comme $same_choice autres personnes. Vous avez perdu 😓.</p><br>
    <p>IP des personnes ayant sélectionné le même choix que vous :<br>";
    for($i = 0; $i < count($same_choice_ip); $i++){
        $ip = $same_choice_ip[$i]["ip"];
        echo "<span class='ip'>$ip</span><br>";
    }
}
echo "<br><table>";
for($i = 1; $i <= $choices; $i++){
    if($i % 10 == 1){
        echo "<tr>";
    }
    $ips = arraySQL("SELECT `ip` FROM `choices` WHERE `game` = ? AND `choice` = ?;", [$_REQUEST["id"], $i]);
    if($ips){
        if(count($ips) == 1) $style = "class='win'";
        if(count($ips) > 1) $style = "class='lose'";
    }else{
        $style = "";
    }
    echo "<td $style>№$i<br><br>";
    if(!$ips){
        echo "—";
    }else{
        for($j = 0; $j < count($ips); $j++){
            $ip = $ips[$j]["ip"];
            echo "<span class='ip'>$ip</span><br>";
        }
    }
    echo "</td>";
    if($i % 10 == 0){
        echo "</tr>";
    }
}
echo "</table>"
?>