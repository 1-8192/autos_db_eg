<?php
    session_start();
    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
    $message = "";

    if (isset($_POST['who']) && isset($_POST['pass'])) {
        if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
            $_SESSION['error'] = "Email and password and required";
            header("Location: login.php");
            return;
        } else if (!filter_var($_POST['who'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: login.php");
            return;
        } else {
            unset($_SESSION["name"]);
            if ($stored_hash == hash('md5', $salt.$_POST["pass"])) {
                error_log("Login success".$_POST["who"]);
                $_SESSION["name"] = $_POST["who"];
                $_SESSION["success"] = "Logged in.";
                header("Location: view.php");
            } else {
                $_SESSION["error"] = "Incorrect Password.";
                header( 'Location: login.php');
                return;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Alessandro Allegranzi - autos db</title>
        <?php require_once "bootstrap_styling.php" ?>
    </head>
    <body>
        <h1>Please Log In</h1>
        <?php 
            if ( isset($_SESSION['error']) ) {
                echo('<p style="color: red;">'.htmlentities($_SESSION['error'])."</p>\n");
                unset($_SESSION['error']);
              }
        ?>
        <form method="POST">
            <label for="email">Email</label>
            <input type="text" name="who" id="email">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass">
            <input type="submit" value="Log In">
            <input type="submit" name="cancel" value="Cancel">
            <p>
            For a password hint, view the source and find a password hint in the HTML comments.
            <!-- Hint: The password is the three character name of the 
            programming language used in this class (all lower case) 
            followed by 123. -->
            </p>
        </form>
    </body>
</html>