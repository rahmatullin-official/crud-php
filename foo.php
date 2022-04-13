<?php 

include 'database.php';

function upload_file($filename, $tmp_name){
	if (strlen($filename) == 0) {
		$filename = "default.jpg";
	}
	else {
		$result = pathinfo($filename);
		$filename = uniqid() . "." . $result['extension'];
		move_uploaded_file($tmp_name, "img/demo/authors/" . $filename);
	}
	
	return $filename;
}

// read db
if (!isset($_GET['id'])) {
	$sql = "SELECT * FROM users";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
}

// add user function 

if(isset($_POST["add"])){
	$sql = "INSERT INTO users (thumb, name, role, gender, email, password) VALUES (:thumb, :name, :role, :gender, :email, :password)";
	$query = $pdo->prepare($sql);
	if (!isset($_FILES['thumb'])) {
		$_FILES['thumb'] = "default.jpg";
	}
	else{
		$ex = upload_file($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name']);
		$_FILES['thumb'] = $ex;
	};
	$query->execute([
			"thumb" => $_FILES['thumb'],
			"name" => $_POST['name'],
			"role" => $_POST['role'],
			"gender" => $_POST['name'],
			"email" => $_POST['email'],
			"password" => $_POST['password'],
	]);
	if ($query) {
		header("Location: /index.php");
	}
}

// edit user function 

if (isset($_POST['edit'])) {
	$value = $_POST['id'];
	$sql = "UPDATE users SET thumb = :thumb, name = :name, role = :role, gender = :gender, email = :email, password = :password WHERE id = $value";
	$sql = $pdo->prepare($sql);
	if (!isset($_FILES['thumb'])) {
		$_FILES['thumb'] = "default.jpg";
	}
	else{
		$ex = upload_file($_FILES['thumb']['name'], $_FILES['thumb']['tmp_name']);
		$_FILES['thumb'] = $ex;
	};
	$sql->execute([
		"thumb" => $_FILES['thumb'],
		"name" => $_POST['name'],
		"role" => $_POST['role'],
		"gender" => $_POST['name'],
		"email" => $_POST['email'],
		"password" => $_POST['password'],
	]);
	if ($sql) {
		header("Location: /index.php");
	}
}

// read user edit

if(isset($_GET['id'])) {
	$value = $_GET['id'];
	$sql = "SELECT * FROM users WHERE id = $value";
	$sql = $pdo->prepare($sql);
	$sql->execute();
	$result = $sql->fetchAll(PDO::FETCH_ASSOC);
}
	
// delete user 

// if (isset($_GET['delete'])) {
		
// }

?>