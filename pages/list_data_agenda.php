<?php

	require '../config/main.php';
	$startDate = $_GET['start_date'];
	$endDate = $_GET['end_date'];
	$query=mysqli_query($conn, "SELECT agenda.id, agenda.deskripsi, agenda.tgl_mulai, agenda.tgl_akhir, tipe.id as tipe_id, tipe.warna, tipe.nama as tipe FROM agenda, agenda_tipe tipe where agenda.agenda_tipe_id=tipe.id and tgl_mulai >= '$startDate' and tgl_mulai <= '$endDate'");

	$data = array();
	while($row = mysqli_fetch_object($query)){
		$id_agenda = $row->id;
		$picQuery = mysqli_query($conn, "SELECT agenda_teknisi.teknisi_id, pengguna.nama FROM agenda_teknisi, pengguna WHERE agenda_teknisi.teknisi_id = pengguna.id and agenda_id='$id_agenda'");

		$pics = array();
		$title = $row->tipe . " - ";
		$index=0;
		$jumlah = mysqli_num_rows($picQuery);
		while($pic = mysqli_fetch_object($picQuery)){
			array_push($pics, $pic);
			$title .= $pic->nama;
			if($index < $jumlah-1){
				$title .= ", ";
			}
			$index++;
		}

		$event = array(
			"calendar_id" => $row->id,
			"color" => $row->warna,
			"tipe" => $row->tipe_id,
			"deskripsi" => $row->deskripsi,
			"pic" => $pics,
			"start" => $row->tgl_mulai . " 00:00:00",
			"end" => $row->tgl_akhir . " 00:00:00",
			"title"  => $title,
			"startDate" => $row->tgl_mulai,
			"endDate" => $row->tgl_akhir

		);

		
		array_push($data, $event);
	}
	$result = array(
		"events" => $data
	);

	echo json_encode($result);

?>