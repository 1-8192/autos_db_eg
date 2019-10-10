<?php
    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
    $message = "";

    if (isset($_POST['who']) && isset($_POST['pass'])) {
        if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1) {
            $message = "Email and password and required";
        } else if (!filter_var($_POST['who'], FILTER_VALIDATE_EMAIL)) {
            $message = "Email must have an at-sign (@)";
        } else {
            if ($stored_hash == hash('md5', $salt.$_POST["pass"])) {
                error_log("Login success".$_POST["who"]);
                header("Location: autos.php?name=".urlencode($_POST["who"]));
            } else {
                error_log("Login Fail".$_POST["who"]."$check");
                $message = "Incorrect password";
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
            if ($message !== "") {
                echo("<h3> $message </h3>");
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