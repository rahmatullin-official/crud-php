<?php 

include 'database.php';

// read db

$sql = "SELECT * FROM users";
$sql = $pdo->prepare($sql);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);


 ?>