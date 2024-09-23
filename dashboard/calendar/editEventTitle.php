<?php

session_start();
include_once "../../php/config.php";
if(!isset($_SESSION['unique_id'])){
    header("location: ../login.php");
}

require_once('bdd.php');
if (isset($_POST['delete']) && isset($_POST['id'])){
	
	
	$id = $_POST['id'];

	$uni = $_SESSION['unique_id'];
	$query = "SELECT * FROM users WHERE unique_id = $uni";
	$result = mysqli_query($conn, $query);
	
	// التحقق من وجود نتائج
	if(mysqli_num_rows($result) > 0){
		while($task = mysqli_fetch_assoc($result)){
			$table = $task['user_table_name'];
	$sql = "DELETE FROM $table WHERE id = $id";
		}
	}
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$res = $query->execute();
	if ($res == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}
	
}elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])){
	
	$id = $_POST['id'];
	$title = $_POST['title'];
	$color = $_POST['color'];

	$uni = $_SESSION['unique_id'];
$query = "SELECT * FROM users WHERE unique_id = $uni";
$result = mysqli_query($conn, $query);

// التحقق من وجود نتائج
if(mysqli_num_rows($result) > 0){
    while($task = mysqli_fetch_assoc($result)){
        $table = $task['user_table_name'];
	$sql = "UPDATE $table SET  title = '$title', color = '$color' WHERE id = $id ";
	}
}
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: index.php');

	
?>
