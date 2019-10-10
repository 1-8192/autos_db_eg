<?php
    require_once "pdo.php";

    //logging logic
    if (isset($_POST["cancel"])) {
        header('Location: index.php');
        return;
    }

    if (!isset($_GET["name"])) {
        die("Name parameter missing");
    }

    //adding car logic 
    $message = "";

    if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
        if (strlen($_POST['make']) < 1 ) {
            $message="<p>Make is required</p>";
        } else if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $message="<p>Mileage and year must be numeric<p>";
        } else {
            $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES (:mk, :yr, :mi)');
            $stmt->execute(array(
                ':mk' => $_POST['make'],
                ':yr' => $_POST['year'],
                ':mi' => $_POST['mileage']
            ));
            $message='<p style="color:green">Record inserted</p>';
        }
    }

    //getting car info for display
    $stmt = $pdo->query("SELECT make, year, mileage FROM autos ORDER BY make");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
        <div class="container">
            <h1> Tracking Autos for <?php echo(htmlentities($_GET["name"])) ?>
            </h1>
            <?php 
                if ($message !== "") {
                    echo($message);
                }
            ?>
            <form method="POST">
                <p>Make:</p>
                <input type="text" name="make" id="make">
                <p>Year:</p>
                <input type="text" name="year" id="year">
                <p>Mileage:</p>
                <input type="text" name="mileage" id="mileage"></br>
                <input type="submit" value="add">
                <input type="submit" name="cancel" value="Logout">
            </form>
       </div>
       <div>
        <h2>Automobiles</h2>
        <table border="1">
            <tr>
                <th>Make</th>
                <th>Year</th>
                <th>Mileage</th>
            </tr>
        <?php
            foreach ($rows as $row) {
                echo "<tr><td>";
                echo($row['make']);
                echo"</td><td>";
                echo($row['year']);
                echo "</td><td>";
                echo($row['mileage']);
                echo "</td><tr>";
            }
        ?>
        </table>
       </div>
    </body>
</html>