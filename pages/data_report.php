<?php

	require 'config/main.php';

	$queryPegawai = mysqli_query($conn, "SELECT * FROM pengguna WHERE status<>'sa'");
	$data = array();

	if(isset($_POST['cmd']) == "search"){
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
		}
	}
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Laporan</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <h4>Filter</h4>
			<form method="POST" action="">
	      <div class="row">
	        <div class="col-md-2">
	          <label>Dari Tanggal:  </label>
	        </div>
	        <div class="col-md-10">
	          <input class="datepicker" data-date-format="yyyy-mm-dd" name="tgl_mulai" value="<?= (isset($_POST['tgl_mulai'])) ? $_POST['tgl_mulai'] : '' ?>">
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-2">
	          <label>Sampai Tanggal:  </label>
	        </div>
	        <div class="col-md-10">
	          <input class="datepicker" data-date-format="yyyy-mm-dd" name="tgl_akhir" value="<?= (isset($_POST['tgl_akhir'])) ? $_POST['tgl_akhir'] : '' ?>">
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-md-2">
	          <label>Karyawan:  </label>
	        </div>
	        <div class="col-md-10">
						<select class="form-control select2" data-placeholder="Pilih Pegawai" id="pegawai"
										style="width: 100%;" name="pegawai">
							<?php while($row = mysqli_fetch_object($queryPegawai)){ ?>
									<option value="<?= $row->id ?>"><?= $row->nama ?></option>
							<?php } ?>
						</select>
	        </div>
	      </div>
				<input type="hidden" name="cmd" value="search">
				<button type="submit" class="btn btn-primary">Cari</button>
			</form>
    </div>
</div>

<div class="box">
    <div class="box-header">
      <h3 class="box-title">Hasil Pencarian</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
		<?php if(isset($_POST['tgl_mulai']) && isset($_POST['tgl_akhir']) && isset($_POST['pegawai'])){ ?>
		<form method="POST" action="print.php">
			<input type="hidden" name="tgl_mulai" value="<?= (isset($_POST['tgl_mulai'])) ? $_POST['tgl_mulai'] : '' ?>">
			<input type="hidden" name="tgl_akhir" value="<?= (isset($_POST['tgl_akhir'])) ? $_POST['tgl_akhir'] : '' ?>">
			<input type="hidden" name="pegawai" value="<?= $_POST['pegawai']; ?>"/>
			<button type="submit" class="btn btn-success">Cetak CSV (EXCEL)</button>
		</form>
		<?php } ?>
		<br/>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
         		<th>No</th>
         		<th>Tanggal Mulai</th>
         		<th>Tanggal Selesai</th>
						<th>Lokasi</th>
						<th>Agenda Tipe</th>
			   		<th>Deskripsi</th>
		  	</tr>
		</thead>
		<tbody>
		<?php
		  	$no=1;
				if(isset($_POST['cmd']) && strlen($_POST['tgl_mulai'])>0 && strlen($_POST['tgl_akhir'])>0){
		  		while($q=mysqli_fetch_object($cmdSearch)){
		?>
		  	<tr>
		   		<td><?php echo $no++; ?></td>
		   		<td><?php echo $q->tgl_mulai; ?></td>
		    	<td><?php echo $q->tgl_akhir; ?></td>
					<td><?php echo $q->lokasi ?></td>
		    	<td><?php echo $q->tipe; ?></td>
			  	<td><?php echo $q->deskripsi; ?></td>
		  	</tr>
		<?php
				  }
				}
		?>
		</tbody>
		</table>
	</div>
</div>

<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="plugins/datatables/buttons.html5.min.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.button.js" type="text/javascript"></script>

 <script type="text/javascript">
	 $(document).ready(function() {

    $('.datepicker').datepicker();
		$('.select2').select2();
		<?php if(isset($_POST['pegawai'])){ ?>
			var val = <?= $_POST['pegawai']; ?>;
			$(".select2").val(val).trigger('change');
		<?php } ?>
	 	$('#tabel').dataTable({
	          "bPaginate": true,
	          "bLengthChange": true,
	          "bFilter": true,
	          "bSort": true,
	          "bInfo": true,
	          "bAutoWidth": true
	    });
	 });

</script>
