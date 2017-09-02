<?php 

	require "../config/main.php";


	$id = $_POST['id'];
	$queryAgenda = "DELETE FROM agenda WHERE id='$id'";

	if (mysqli_query($conn, $queryAgenda)) {
	    $deletePIC = "DELETE FROM agenda_teknisi WHERE agenda_id='$id'";
	    mysqli_query($conn, $deletePIC);

	    echo json_encode(
	    	array(
	    		"status" => true,
	    		"message" => "Berhasil menghapus data"
	    	)
	    );

	} else {
	    echo json_encode(
	    	array(
	    		"status" => false,
	    		"message" => "error database"
	    	)
	    );
	}


?>