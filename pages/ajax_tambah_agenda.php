<?php 

	require "../config/main.php";


	$pic = $_POST['pic'];
	$data = json_decode($pic);
	$tipe = $_POST['tipe'];
	$deskripsi = $_POST['deskripsi'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];

	$queryAgenda = "INSERT INTO agenda(agenda_tipe_id, deskripsi, tgl_mulai, tgl_akhir) VALUES ('$tipe', '$deskripsi', '$startDate', '$endDate') ";

	if (mysqli_query($conn, $queryAgenda)) {
	    $last_id = mysqli_insert_id($conn);
	    foreach($data as $sPic){
	    	$queryPIC = "INSERT INTO agenda_teknisi (agenda_id, teknisi_id) VALUES ('$last_id', '$sPic->id')";
	    	mysqli_query($conn, $queryPIC);
	    }

	    echo json_encode(
	    	array(
	    		"status" => true,
	    		"message" => "Berhasil menambah data"
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