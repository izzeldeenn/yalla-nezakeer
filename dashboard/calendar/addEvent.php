<?php

session_start();
include_once "../../php/config.php";
if(!isset($_SESSION['unique_id'])){
  header("location: ../../login.php");
}

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$subject = $_POST['subject'];
	$start = $_POST['start'];
	$end = $_POST['start'];
	$color = $_POST['color'];

	$uni = $_SESSION['unique_id'];
	$query = "SELECT * FROM users WHERE unique_id = $uni";
	$result = mysqli_query($conn, $query);
	
	// التحقق من وجود نتائج
	if(mysqli_num_rows($result) > 0){
		while($task = mysqli_fetch_assoc($result)){
			$table = $task['user_table_name'];
	$sql = "INSERT INTO $table (title, start, end, color, subject, state, points) values ('$title', '$start', '$end', '$color', '$subject', 'do', '100')";
		}
	}
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
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
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
