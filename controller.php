<?php
include_once "functions.php";

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
        selectChoice($_SERVER["REMOTE_ADDR"],$_REQUEST["game"],$_REQUEST["choice"]);
    break;
}

header("Location:index.php");
?>