<?php

// Connexion à la base de données
require_once('bdd.php');

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])){
	
	
	$id = $_POST['Event'][0];
	$start = $_POST['Event'][1];
	$end = $_POST['Event'][2];

	$uni = $_SESSION['unique_id'];
	$query = "SELECT * FROM users WHERE unique_id = $uni";
	$result = mysqli_query($conn, $query);
	
	// التحقق من وجود نتائج
	if(mysqli_num_rows($result) > 0){
		while($task = mysqli_fetch_assoc($result)){
			$table = $task['user_table_name'];
	$sql = "UPDATE $table SET  start = '$start', end = '$end' WHERE id = $id ";

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
	}else{
		die ('OK');
	}

}
//header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
