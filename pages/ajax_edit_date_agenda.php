<?php 

	require "../config/main.php";


	$id = $_POST['id'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$days = $_POST['days'];

	$s = strtotime($startDate .' '. $days .' days');
    $startDate = date("Y-m-d", $s);

	$s = strtotime($endDate .' '. $days .' days');
    $endDate = date("Y-m-d", $s);

	$queryAgenda = "UPDATE agenda SET
						tgl_mulai='$startDate',
						tgl_akhir='$endDate' WHERE id='$id'";

	if (mysqli_query($conn, $queryAgenda)) {
	    echo json_encode(
	    	array(
	    		"status" => true,
	    		"message" => "Berhasil mengubah data"
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
