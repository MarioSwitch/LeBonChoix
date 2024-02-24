<?php
//Variables
$players_remaining = $players - $players_count;
$alreadyPlayed = intSQL("SELECT COUNT(*) FROM `choices` WHERE `game` = ? AND `ip` = ?;", [$_REQUEST["id"], $_SERVER["REMOTE_ADDR"]]);

//Texte
echo "<hr>";
echo "<h2>Sélectionner un choix</h2>";
echo "<p>Encore " . $players_remaining . " personnes doivent sélectionner un choix entre 1 et $choices pour terminer cette partie.</p><br>";
echo "<p>Si plusieurs personnes sélectionnent le même choix, ils perdent tous.</p>";
echo "<p>À l'inverse, si vous êtes le seul à sélectionner un même choix, vous gagnez.</p><br>";
if($alreadyPlayed){
    $choice = intSQL("SELECT `choice` FROM `choices` WHERE `game` = ? AND `ip` = ?;", [$_REQUEST["id"], $_SERVER["REMOTE_ADDR"]]);
    echo "<p>Vous avez sélectionné le choix №$choice.</p>";
}else{
    echo "
    <form role='form' action='controller.php'>
        <input type='hidden' name='game' value='" . $_REQUEST["id"] . "'>
        <p>Sélectionner un choix entre 1 et " . $choices . " :
            <input type='number' name='choice' min='1' max='" . $choices . "' required='required'>
        </p>
        <button type='submit' name='action' value='selectChoice'>Confirmer ce choix</button>
    </form>";
}
?>