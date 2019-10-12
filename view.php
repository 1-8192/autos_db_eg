<?php
    session_start();
    require_once "pdo.php";

    //logging logic
    if (!isset($_SESSION["name"])) {
        die("Not logged in.");
    }

    if (isset($_POST["cancel"])) {
        header('Location: index.php');
        return;
    }

    //flash message if redirected
    if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
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
            <h1> Tracking Autos for <?php echo(htmlentities($_SESSION["name"])) ?>
            </h1>
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
        <a href="add.php">Add New</a> |
        <a href="logout.php"> Logout</a>
       </div>
    </body>
</html>