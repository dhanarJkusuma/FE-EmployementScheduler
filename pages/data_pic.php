<?php
	require 'config/main.php';
	$query=mysqli_query($conn, "SELECT pic.id as id, pelanggan.nama as pelanggan, pic.nama as nama, pic.email as email, pic.no_telp as no_telp FROM pelanggan, pic WHERE pelanggan.id=pic.pelanggan_id");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data PIC (Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
		<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
    	<a href="tambah.php?tambah=data_pic" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data PIC</a>
		<?php } ?>
		<br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
         		<th>No</th>
         		<th>Nama Pelanggan</th>
         		<th>Nama PIC</th>
			   		<th>Email</th>
			   		<th>No Telp</th>
						<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
		        <th>Action</th>
						<?php } ?>
		  	</tr>
		</thead>
		<tbody>
		<?php
		  	$no=1;
		  	while($q=mysqli_fetch_object($query)){
		?>
		  	<tr>
		   		<td><?php echo $no++; ?></td>
		   		<td><?php echo $q->pelanggan; ?></td>
		    	<td><?php echo $q->nama; ?></td>
		    	<td><?php echo $q->email; ?></td>
			  	<td><?php echo $q->no_telp; ?></td>
					<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
			    <td>
			    	<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q->id; ?>">Edit</a>
			    	<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q->id; ?>">Hapus</a>
			    </td>
					<?php } ?>
		  	</tr>
		<?php
		  }
		?>
		</tbody>
		</table>
	</div>
</div>

<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
 <script type="text/javascript">
	 $(document).ready(function() {
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
