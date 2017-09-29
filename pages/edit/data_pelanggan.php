<?php require_once('config/main.php');
$query=mysqli_query($conn, "SELECT * FROM pelanggan WHERE id='$_GET[id]'");
$data=mysqli_fetch_array($query);

 ?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-warning">
	        <div class="box-header">
	          <h3 class="box-title">Edit Pelanggan</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="type" value="data_pelanggan">
	           <input type="hidden" name="cmd" value="edit">
	           <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
	            <!-- text input -->
	            <div class="form-group">
	              <label>Nama</label>
	              <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>Email</label>
	              <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $data['email']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>Alamat</label>
	              <textarea name="alamat" class="form-control" placeholder="Alamat"><?php echo $data['alamat']; ?></textarea>
	            </div>
	            <div class="form-group">
	              <label>Website</label>
	              <input type="text" name="website" class="form-control" placeholder="Website" value="<?php echo $data['website']; ?>"/>
	            </div>
	            <div class="form-group">
	              <label>No Telp</label>
	              <input type="number" name="no_telp" class="form-control" placeholder="No Telp" value="<?php echo $data['no_telp']; ?>"/>
	            </div>

	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
	            <a href="index.php?page=data_pelanggan" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>
