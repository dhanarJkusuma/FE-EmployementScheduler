<?php

	require "../config/main.php";


	$id = $_POST['id'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$days = $_POST['days'];
	$picsQuery = "SELECT * FROM agenda_teknisi WHERE agenda_id='$id'";
	$pics = mysqli_query($conn, $picsQuery);




	$s = strtotime($startDate .' '. $days .' days');
  $startDate = date("Y-m-d", $s);

	$s = strtotime($endDate .' '. $days .' days');
  $endDate = date("Y-m-d", $s);
	$endVisionDate = date('Y-m-d', strtotime('-1 day', strtotime($endDate)));


	while($pic = mysqli_fetch_object($pics)){
		$checkAgenda = "SELECT agenda.id
										FROM agenda
										INNER JOIN agenda_teknisi ON agenda.id=agenda_teknisi.agenda_id
										WHERE
										agenda_teknisi.teknisi_id='$pic->teknisi_id'
										AND
										agenda.id<>'$id'
										AND
										'$startDate' BETWEEN agenda.tgl_mulai AND agenda.tgl_akhir
										AND
										'$endVisionDate' BETWEEN agenda.tgl_mulai AND agenda.tgl_akhir";
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
