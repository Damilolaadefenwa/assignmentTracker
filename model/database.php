<!-- This file will create a connection to the database -->
<!-- dsn: stand for Data Source Name  -->
<?php
//1. The variable first
$dsn = 'mysql:host=localhost;dbname=assignment_tracker';
$username = 'root';
$password = 'Birth17!';

//2. The Logic for connection
try {
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error = "Database Error: ";
    $error .= $e->getMessage();
    include('view/error.php');
    exit();
}

?>