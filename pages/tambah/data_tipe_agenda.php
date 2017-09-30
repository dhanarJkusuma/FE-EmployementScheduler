<?php require_once('config/main.php');
$query=mysqli_query($conn, "SELECT * FROM agenda_tipe ");
$data = mysqli_fetch_array($query);
?>
<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-warning">
	        <div class="box-header">
	          <h3 class="box-title">Edit Tipe Agenda</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="type" value="data_tipe_agenda">
	           <input type="hidden" name="cmd" value="tambah">
	          <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
	            <!-- text input -->
	            <div class="form-group">
	              <label>Agenda Tipe</label>
	              <input type="text" name="nama" class="form-control" placeholder="Nama" />
	            </div>

	             <!-- Color Picker -->
	              <div class="form-group">
	                <label>Warna:</label>

	                <div class="input-group colorpicker">
	                  <input type="text" class="form-control" name="warna" value="#FF0000">

	                  <div class="input-group-addon">
	                    <i></i>
	                  </div>
	                </div>
	                <!-- /.input group -->
	              </div>
              <!-- /.form group -->


	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-backward"></i> Kembalikan Data </button>
	            <a href="index.php?page=data_tipe_agenda" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>
