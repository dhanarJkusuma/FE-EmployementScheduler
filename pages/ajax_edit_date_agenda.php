<?php

	require "../config/main.php";


	$id = $_POST['id'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	$days = $_POST['days'];

	//mencari data teknisi berdasarkan agenda
	$picsQuery = "SELECT * FROM agenda_teknisi WHERE agenda_id='$id'";
	$pics = mysqli_query($conn, $picsQuery);

	//menambahkan tgl mulai agenda +/- brp hari
	$s = strtotime($startDate .' '. $days .' days');
  $startDate = date("Y-m-d", $s);

	//menambahkan tgl akhir agenda +/- brp hari
	$s = strtotime($endDate .' '. $days .' days');
  $endDate = date("Y-m-d", $s);

	//endVisionDate = tgl yang terlihat di calender js
	$endVisionDate = date('Y-m-d', strtotime('-1 day', strtotime($endDate)));

	while($pic = mysqli_fetch_object($pics)){
		//mengecek apakah agenda dengan tgl mulai yg baru sudah direserved atau belum.
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
			//jika sudah ada yg reserved.
			echo json_encode(
				array(
					"status" => false,
					"message" => "Gagal menambahkan data. pic yang ditunjuk sedang berada di jadwal lain."
				)
			);
			die();
		}
	}

	//menyimpan perubahan tanggal
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
