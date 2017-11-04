<?php 
	require_once('config/main.php');
	$queryp=mysqli_query($conn, "SELECT * FROM pelanggan");
	$query= mysqli_query($conn, "SELECT * FROM pic WHERE id='$_GET[id]'");
	$data = mysqli_fetch_array($query);
?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-warning">
	        <div class="box-header">
	          <h3 class="box-title">Edit PIC</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="type" value="data_pic">
	           <input type="hidden" name="cmd" value="edit">
	           <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
	            <!-- text input -->
	            <div class="form-group">
	            	<label>Nama Pelanggan</label>
	            	<select class="form-control" name="pelanggan">
	            		<option value="0">--PILIH PELANGGAN--</option>
	            	<?php 
	            		while($pelanggan = mysqli_fetch_array($queryp)){
	            	?>
	            		<option value="<?php echo $pelanggan['id']; ?>" <?= ($data['pelanggan_id'] == $pelanggan['id']) ? "selected" : "" ?>><?php echo $pelanggan['nama']; ?></option>
	            	<?php } ?>
	            	</select>
	            </div>
	            <div class="form-group">
	              <label>Nama</label>
	              <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $data['nama']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>Email</label>
	              <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $data['email']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>No Telp</label>
	              <input type="number" name="no_telp" class="form-control" placeholder="No Telp" value="<?= $data['no_telp']; ?>"/>
	            </div>

	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Kosongkan Data</button>
	            <a href="index.php?page=data_pic" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>