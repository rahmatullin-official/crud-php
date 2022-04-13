<?php 

try {
	$connection = new PDO("mysql:host=localhost; dbname=final_db", "root", "");
} catch (PDOException $e){
	echo "Запрос к базе данных не был получен" . $e.getMessage();
}


 ?>