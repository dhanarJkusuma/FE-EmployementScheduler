<?php
    header('Content-Type: application/excel');
    header('Content-Disposition: attachment; filename="ExportCSV.csv"');
    require 'config/main.php';
    $queryPegawai = mysqli_query($conn, "SELECT * FROM pengguna WHERE status<>'sa'");
  	$data = array();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

		if(strlen($_POST['tgl_mulai']) == 0 || strlen($_POST['tgl_akhir']) == 0){
		?>
		<div class="alert alert-warning alert-dismissible" role="alert">
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  <strong>Peringatan!</strong> Tanggal mulai, dan Tanggal akhir diperlukan untuk proses pencarian.
		</div>
		<?php
		}else{
			$tgl_mulai = $_POST['tgl_mulai'];
			$tgl_akhir = $_POST['tgl_akhir'];
			$querySearch = "SELECT agenda.deskripsi, agenda_tipe.nama as tipe, pelanggan.nama as lokasi,  pengguna.email, agenda.tgl_mulai, agenda.tgl_akhir";
	    $querySearch .= " FROM agenda_teknisi, pengguna, agenda, agenda_tipe, pelanggan WHERE";
			$querySearch .= " agenda.tgl_mulai >= '$tgl_mulai' and";
			$querySearch .= " agenda.tgl_akhir <= '$tgl_akhir' and";

			if(isset($_POST['pegawai'])){
				$id = $_POST['pegawai'];
				$querySearch .= " teknisi_id='$id' and";
			}

			$querySearch .= " agenda.pelanggan_id=pelanggan.id and";
			$querySearch .= " agenda_teknisi.teknisi_id=pengguna.id and";
			$querySearch .= " agenda_teknisi.agenda_id=agenda.id and";
			$querySearch .= " agenda.agenda_tipe_id=agenda_tipe.id";

			$cmdSearch = mysqli_query($conn, $querySearch);
      $fields = array();
      while($property = mysqli_fetch_field($cmdSearch)){
        array_push($fields, $property->name);
      }

      array_push($data, $fields);


			while(($row =  mysqli_fetch_row($cmdSearch))) {
			    array_push($data, $row);
			}
		}

    $fp = fopen('php://output', 'w');
    foreach ( $data as $line ) {
        $row = implode(",", $line);
        fputcsv($fp, $line);
    }
    fclose($fp);

 ?>
