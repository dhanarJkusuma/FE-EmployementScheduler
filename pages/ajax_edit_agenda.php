<?php 

	require "../config/main.php";


	$id = $_POST['id'];
	$pic = $_POST['pic'];
	$data = json_decode($pic);
	$tipe = $_POST['tipe'];
	$deskripsi = $_POST['deskripsi'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];

	$queryAgenda = "UPDATE agenda SET
						agenda_tipe_id='$tipe',
						deskripsi='$deskripsi',
						tgl_mulai='$startDate',
						tgl_akhir='$endDate' WHERE id='$id'";

	if (mysqli_query($conn, $queryAgenda)) {
	    $deletePIC = "DELETE FROM agenda_teknisi WHERE agenda_id='$id'";
	    mysqli_query($conn, $deletePIC);
	    foreach($data as $sPic){
	    	$queryPIC = "INSERT INTO agenda_teknisi (agenda_id, teknisi_id) VALUES ('$id', '$sPic->id')";
	    	mysqli_query($conn, $queryPIC);
	    }

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