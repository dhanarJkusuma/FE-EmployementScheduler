<?php 
	require 'config/main.php';
	$query=mysqli_query($conn, "SELECT * FROM pengguna WHERE status='se'");
?>
<div class="box">
    <div class="box-header">
      <h3 class="box-title">Data Teknisi (Terdapat <?php echo mysqli_num_rows($query); ?> Data)</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
    <a href="tambah.php?tambah=data_teknisi" style="margin-bottom: 10px;" class="btn btn-md btn-primary"> <i class="fa fa-plus"></i> Tambah Data Teknisi</a>
    <br>
		<table class="table table-bordered" id="tabel">
		<thead>
			 <tr>
         		<th>No</th>
         		<th>Nama</th>
			   	<th>Email</th>
			   	<th>Telpon</th>
		        <th>Action</th>
		  	</tr>
		</thead>
		<tbody>
		<?php
		  	$no=1;
		  	while($q=mysqli_fetch_object($query)){
		?>
		  	<tr>
		   		<td><?php echo $no++; ?></td>
		    	<td><?php echo $q->nama; ?></td>
			  	<td><?php echo $q->email; ?></td>
			  	<td><?php echo $q->no_telp; ?></td>
			    <td>
			    	<a class="btn btn-success" href="edit.php?edit=<?php echo $_GET['page']; ?>&id=<?php echo $q->id; ?>">Edit</a>
			    	<a class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="hapus.php?hapus=<?php echo $_GET['page']; ?>&id=<?php echo $q->id; ?>">Hapus</a>
			    </td>
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
