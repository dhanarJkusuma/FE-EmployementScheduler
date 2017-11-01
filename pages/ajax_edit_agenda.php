<?php

	require "../config/main.php";


	$id = $_POST['id'];
	$pic = $_POST['pic'];
	$data = json_decode($pic);
	$tipe = $_POST['tipe'];
	$deskripsi = $_POST['deskripsi'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];

	foreach($data as $sPic){
		$checkAgenda = "SELECT agenda.id
										FROM agenda
										INNER JOIN agenda_teknisi ON agenda.id=agenda_teknisi.agenda_id
										WHERE
										agenda_teknisi.teknisi_id='$sPic->id'
										AND
										agenda.id<>'$id'
										AND
										CURDATE() BETWEEN agenda.tgl_mulai AND DATE_ADD(agenda.tgl_akhir, INTERVAL 1 DAY);";
		$existExec = mysqli_query($conn, $checkAgenda);
		$existData = mysqli_num_rows($existExec);
		if($existData > 0){
			echo json_encode(
				array(
					"status" => false,
					"message" => "Gagal menambahkan data. pic yang ditunjuk sedang berada di jadwal lain."
				)
			);
			die();
		}
	}

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
