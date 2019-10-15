<?php
    session_start();
    require_once "pdo.php";

    //logging logic
    if (!isset($_SESSION["name"])) {
        die("Not logged in");
    }

    if (isset($_POST["cancel"])) {
        header('Location: logout.php');
        return;
    }

    //adding car logic 

    if (isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
        if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1) {
            $_SESSION["error"] = "Make and Model are required";
            header("Location: add.php");
            return;
        } else if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $_SESSION["error"] = "Mileage and year must be numeric";
            header("Location: add.php");
            return;
        } else {
            $stmt = $pdo->prepare('INSERT INTO autos (make, model, year, mileage) VALUES (:mk, :md, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => htmlentities($_POST['make']),
                ':md' => htmlentities($_POST['model']),
                ':yr' => htmlentities($_POST['year']),
                ':mi' => htmlentities($_POST['mileage'])
            ));
            $_SESSION['success'] = "Record inserted";
            header("Location: index.php");
            return;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db CRUD</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
        <div class="container">
                    <h1> Tracking Autos for <?php echo(htmlentities($_SESSION["name"])) ?>
                    </h1>
                    <?php 
                        if ( isset($_SESSION['error']) ) {
                            echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                            unset($_SESSION['error']);
                          }
                    ?>
                    <form method="POST">
                        <p>Make:</p>
                        <input type="text" name="make" id="make">
                        <p>Model:</p>
                        <input type="text" name="model" id="model">
                        <p>Year:</p>
                        <input type="text" name="year" id="year">
                        <p>Mileage:</p>
                        <input type="text" name="mileage" id="mileage"></br>
                        <input type="submit" value="Add">
                        <input type="submit" name="cancel" value="logout">
                    </form>
        </div>
    </body>
</html>