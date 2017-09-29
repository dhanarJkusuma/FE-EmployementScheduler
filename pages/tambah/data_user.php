<section>
	<div class="row">
		<div class="col-md-12">
	      <!-- general form elements disabled -->
	      <div class="box box-warning">
	        <div class="box-header">
	          <h3 class="box-title">Tambah Admin</h3>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <form role="form" method="post" action="simpan.php">
	          <input type="hidden" name="type" value="data_user">
	           <input type="hidden" name="cmd" value="tambah">
	            <!-- text input -->
	            <div class="form-group">
	              <label>Email</label>
	              <input type="email" name="email" class="form-control" placeholder="Email" value=""/>
	            </div>
	            <div class="form-group">
	              <label>Nama</label>
	              <input type="text" name="nama" class="form-control" placeholder="Nama" value=""/>
	            </div>
	            <div class="form-group">
	              <label>Password</label>
	              <input type="password" name="password" class="form-control" placeholder="Password" value=""/>
	            </div>
	            <div class="form-group">
	              <label>Password Konfirmasi</label>
	              <input type="password" name="password_confirmation" class="form-control" placeholder="Password Konfirmasi" value=""/>
	            </div>
	            <div class="form-group">
	              <label>No Telp</label>
	              <input type="number" name="no_telp" class="form-control" placeholder="No Telp" value=""/>
	            </div>
	            <div class="form-group">
	              <label>Tipe</label>
	              <select class="form-control" name="role">
	              	<option value="admin">Admin IT</option>
	              	<option value="se">System Engineer</option>
	              </select>
	            </div>
	            <button type="submit" class="btn btn-success"> <i class="fa fa-save"></i> Simpan</button>
	            <button type="reset" class="btn btn-warning"> <i class="fa fa-trash"></i> Reset</button>
	            <a href="index.php?page=data_admin" class="btn btn-danger"> <i class="fa fa-times"></i> Batal</a>
	          </form>
	        </div><!-- /.box-body -->
	      </div><!-- /.box -->
	    </div><!--/.col (right) -->
	</div>
</section>
