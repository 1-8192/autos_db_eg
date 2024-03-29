<?php
    session_start();
    require_once "pdo.php";

    //getting car info for display
    $stmt = $pdo->query("SELECT make, model, year, mileage, autos_id FROM autos ORDER BY make");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db CRUD</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
        <h1>Welcome to the Auto Database</h1>
        <?php
            if ( isset($_SESSION['error']) ) {
                echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                unset($_SESSION['error']);
            }
            if ( isset($_SESSION['success']) ) {
                echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                unset($_SESSION['success']);
            }

            if (isset($_SESSION["name"])) {
                if (count($rows) > 0) {
                    echo('<div>');
                    echo('<h2>Automobiles</h2>');
                    echo('<table border="1">');                        echo('<tr>');
                            echo('<th>Make</th>');
                            echo('<th>Model</th>');
                            echo('<th>Year</th>');
                            echo('<th>Mileage</th>');
                            echo('<th>Action</th>');
                        echo('</tr>');
                        foreach ($rows as $row) {
                            echo "<tr><td>";
                            echo($row['make']);
                            echo"</td><td>";
                            echo($row['model']);
                            echo"</td><td>";
                            echo($row['year']);
                            echo "</td><td>";
                            echo($row['mileage']);
                            echo "</td><td>";
                            echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
                            echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
                            echo "</td><tr>";
                        }
                    echo('</table>');
                    echo('<a href="add.php">Add New Entry</a></br>');
                    echo('<a href="logout.php">Logout</a></br>');
                echo('</div>');
                } else {
                    echo('<p>No rows found</p>');
                    echo('<a href="add.php">Add New Entry</a></br>');
                    echo('<a href="logout.php">Logout</a></br>');
                }
            } else {
                echo('<a href="login.php">Please log in</a>');
                echo('<p>
                    Attempt to <a href="add.php">add data</a> without logging in
                </p>');
            }
        ?>
    </body>
</html>