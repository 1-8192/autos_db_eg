<?php
    if (!isset($_GET["name"])) {
        die("Name parameter missing");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
       <h1> Autos Database </h1>
    </body>
</html>