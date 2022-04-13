<?php 

include 'database.php';

// read db

$sql = "SELECT * FROM users";
$sql = $pdo->prepare($sql);
$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
 
// add user function 

if(isset($_POST["add"])){
	$sql = "INSERT INTO users (thumb, name, role, gender, email, password) VALUES (:thumb, :name, :role, :gender, :email, :password)";
	$query = $pdo->prepare($sql);
	if (!isset($_POST['thumb'])) {
		$_POST['thumb'] = "default.jpg";
	}
	$query->execute([
			"thumb" => $_POST['thumb'],
			"name" => $_POST['name'],
			"role" => $_POST['role'],
			"gender" => $_POST['name'],
			"email" => $_POST['email'],
			"password" => $_POST['password'],
	];);
	if ($query) {
		header("Location: /index.php");
	}
}

// edit user function 

if (isset($_POST['edit'])) { // подумай как реализовать thumb
	$sql = "UPDATE users SET thumb = :thumb, name = :name, role = :role, gender = :gender, email = :email, password = :password";
	$sql = $pdo->prepare($sql);
	$sql->execute([
		"thumb" => 


	];);

}

// read user edit

if(isset($_GET['edit'])){
	$sql = "SELECT thumb, name, role, gender, email, password FROM users WHERE id = $_GET['edit']";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

?>