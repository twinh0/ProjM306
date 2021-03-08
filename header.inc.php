<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "baratie";
    
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
?>