<?php

	require "../config/main.php";

	$pic = $_POST['pic'];
	$data = json_decode($pic);
	$tipe = $_POST['tipe'];
	$lokasi = $_POST['lokasi'];
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
										agenda.tgl_mulai BETWEEN '$startDate' AND '$endDate'
										AND
										agenda.tgl_akhir BETWEEN '$startDate' AND '$endDate'
										";
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


	$queryAgenda = "INSERT INTO agenda(agenda_tipe_id, pelanggan_id, deskripsi, tgl_mulai, tgl_akhir) VALUES ('$tipe', '$lokasi','$deskripsi', '$startDate', '$endDate') ";
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
	    		"message" => "error database",
					"query" => $queryAgenda
	    	)
	    );
	}


?>
