<?php
include_once "functions.php";

$query = "";

switch($_REQUEST["action"]){
    case 'createGame' :
        if(!($_REQUEST["players"] && $_REQUEST["choices"])){
            header("Location:index.php?view=error");
            die("");
        }
        createGame($_REQUEST["players"],$_REQUEST["choices"]);
    break;

    case 'selectChoice' :
        if(!($_REQUEST["game"] && $_REQUEST["choice"])){
            header("Location:index.php?view=error");
            die("");
        }
        $maxValue = intSQL("SELECT `choices` FROM `games` WHERE `id` = ?;", [$_REQUEST["game"]]);
        if(!($_REQUEST["choice"] >= 1 && $_REQUEST["choice"] <= $maxValue)){
            header("Location:index.php?view=error");
            die("");
        }
        selectChoice($_SERVER["REMOTE_ADDR"],$_REQUEST["game"],$_REQUEST["choice"]);
        $query = "view=game&id=" . $_REQUEST["game"];
    break;
}
header("Location:index.php?" . $query);
?>