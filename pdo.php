<?php
    $pdo = new PDO('mysql:host=localhost;port=8889;dbname=misc', 'ale@ale.com', 'php123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>