<?php
    if (isset($_POST['cancel'])) {
        header('Location: index.php');
        return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
    $message = "";

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        if (strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1) {
            $message = "Email and password and required";
        } else {
            if ($stored_hash == hash('md5', $salt.$_POST["pass"])) {
                error_log("Login success".$_POST["email"]);
                header("Location: autos.php?name=".urlencode($_POST["email"]));
            } else {
                error_log("Login Fail".$_POST["email"]."$check");
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
            <input type="text" name="email" id="email">
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