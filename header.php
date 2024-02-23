<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Le Bon Choix</title>
    <link rel="shortcut icon" href="svg/website.svg" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="navbar">
    <a href="index.php?view=home"><img src="svg/website.svg" alt="Icône du site"></a>
    <a href="index.php?view=about"><img src="svg/info.svg"></a>
    <a href="index.php?view=allGames"><img src="svg/list.svg"></a>
    <div class="header-right">
        <?php
        echo "<p class='header-text'>Adresse IP : " . $_SERVER["REMOTE_ADDR"] . "</p>";
        echo "<a href='index.php?view=createGame'><img src='svg/new.svg'></a>";
        ?>
    </div>
</div>