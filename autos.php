<?php
    //logging logic
    if (!isset($_GET["name"])) {
        die("Name parameter missing");
    }

    if ( isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db</title>
        <?php require_once "bootstrap_styling.php" ?>
        <?php require_once "pdo.php" ?>
    </head>
    <body>
        <div class="container">
            <h1> Tracking Autos for <?php htmlentities($_GET["name"]) ?></h1>
            <form>
                <p>Make:</p>
                <input type="text" name="make" id="make">
                <p>Year:</p>
                <input type="text" name="year" id="year">
                <p>Mileage:</p>
                <input type="text" name="mileage" id="mileage"></br>
                <input type="submit" value="add">
                <input type="submit" name="logout" value="Logout">
            </form>
       </div>
       <div>
        <h2>Automobiles</h2>
       </div>
    </body>
</html>