<?php
require_once "pdo.php";
session_start();

 //logging logic
 if (!isset($_SESSION["name"])) {
    die("Not logged in");
}

if (isset($_POST["cancel"])) {
    header('Location: index.php');
    return;
}

    // Data validation
    if ( isset($_POST['make']) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['mileage'])) {
        if (strlen($_POST['make']) < 1 || strlen($_POST['model']) < 1) {
            $_SESSION["error"] = "Make and Model are required";
            header("Location: edit.php?autos_id=".$_POST['autos_id']);
            return;
        } else if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $_SESSION["error"] = "Mileage and year must be numeric";
            header("Location: edit.php?autos_id=".$_POST['autos_id']);
            return;
        } else {
            $sql = "UPDATE autos SET make = :mk, model = :md, year = :yr, mileage = :mi WHERE autos_id = :autos_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ':mk' => htmlentities($_POST['make']),
                ':md' => htmlentities($_POST['model']),
                ':yr' => htmlentities($_POST['year']),
                ':mi' => htmlentities($_POST['mileage']),
                ':autos_id' => htmlentities($_POST['autos_id'])
            ));
        $_SESSION['success'] = 'Record edited';
        header( 'Location: index.php' ) ;
        return;
        }
    }

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['autos_id']) ) {
  $_SESSION['error'] = "Missing autos_id";
  header('Location: index.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :id");
$stmt->execute(array(":id" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$make = htmlentities($row['make']);
$model = htmlentities($row['model']);
$year = htmlentities($row['year']);
$mileage = htmlentities($row['mileage']);
$autos_id = $row['autos_id'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db CRUD</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
    <p>Editing Automobile</p>
        <form method="post">
        <p>Make:
        <input type="text" name="make" value="<?= $make ?>"></p>
        <p>Model:
        <input type="text" name="model" value="<?= $model ?>"></p>
        <p>Year:
        <input type="text" name="year" value="<?= $year ?>"></p>
        <p>Mileage:
        <input type="text" name="mileage" value="<?= $mileage ?>"></p>
        <input type="hidden" name="autos_id" value="<?= $autos_id ?>">
        <p><input type="submit" value="Save"/>
        <a href="index.php">Cancel</a></p>
        </form>
    </body>
</html>