<?php
	require 'config/main.php';
	$query=mysqli_query($conn, "SELECT * FROM pengguna WHERE status='admin'");
  $queryTipe=mysqli_query($conn, "SELECT * FROM agenda_tipe");
  $queryPIC = mysqli_query($conn, "SELECT * FROM pengguna WHERE status<>'sa'");
	$queryPelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-body no-padding">
      <!-- THE CALENDAR -->
      <div id="calendar"></div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /. box -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="add-agenda">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" id="form-submit" action="#">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Manajemen Agenda</h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <input type="hidden" id="agenda_id" value="-1" />
              <input type="hidden" id="startDate"  />
              <input type="hidden" id="endDate"  />
              <label>Ditugaskan kepada :</label>
              <select class="form-control select2" multiple="multiple" data-placeholder="Pilih Pegawai" id="pic"
                      style="width: 100%;" name="pic">
                <?php while($row = mysqli_fetch_object($queryPIC)){ ?>
                    <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                <?php } ?>
              </select>
            </div>

						<div class="form-group">
							<label>Lokasi</label>
							<select class="form-control" name="lokasi" id="lokasi">
                <?php while($row = mysqli_fetch_object($queryPelanggan)){ ?>
                    <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                <?php } ?>
              </select>
						</div>

           <div class="form-group">
              <label>Tipe Agenda</label>
              <select class="form-control" name="tipe" id="tipe">
                <?php while($row = mysqli_fetch_object($queryTipe)){ ?>
                    <option value="<?= $row->id ?>"><?= $row->nama ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Deskripsi</label>
              <textarea rows="2" class="form-control" name="deskripsi" id="deskripsi"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="delete-btn">Hapus</button>
          <button type="button" class="btn btn-default clearForm" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="hapus-dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" id="form-delete" action="#">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Peringatan</h4>
        </div>
        <div class="modal-body">
          Apakah anda yakin menghapus event ini?
          <input type="hidden" id="agenda_id_delete"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Ya</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="plugins/jQuery/jQuery-2.1.3.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<!-- Select2 -->
<script src="plugins/select2/dist/js/select2.full.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="plugins/moment/moment.js"></script>
<script src="plugins/fullcalendar/fullcalendar.min.js"></script>
<script>
$("#delete-btn").hide();
<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
	var editable = true;
<?php }else{ ?>
	var editable = false;
<?php } ?>

  window.calendar = $('#calendar').fullCalendar({
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month',
    },
    displayEventTime : false,
    selectable: true,
    selectHelper: true,
		eventStartEditable: editable,
    // create
    select: function(start, end, allDay) {
			<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
        // cleanup form
        window.ev_id = null;

        window.started = start.format("YYYY-MM-DD");
        window.ended = end.format("YYYY-MM-DD");

        $('#startDate').val(start.format());
        $('#endDate').val(end.format());

        $('#add-agenda').modal('show');
			<?php } ?>
			calendar.fullCalendar('unselect');
    },
    // edit
    eventClick: function(calEvent, jsEvent, view) {

        // TODO: Mengirimkan parameter id event agar ke load data
			<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
        var ev_id = calEvent.calendar_id;
        window.ev_id = ev_id;
        window.started = calEvent.start.format("YYYY-MM-DD");
        window.ended = calEvent.end.format("YYYY-MM-DD");

        $('#agenda_id').val(calEvent.calendar_id);

        var pics = [];
        calEvent.pic.forEach(function(pic){
          pics.push(pic.teknisi_id);
        });

        $('.select2').select2().val(pics).trigger("change");

        $('#tipe').val(calEvent.tipe);
        $('#deskripsi').val(calEvent.deskripsi);
        $('#startDate').val(calEvent.startDate);
        $('#endDate').val(calEvent.endDate);
        $("#delete-btn").show();
        $('#add-agenda').modal('show');

			<?php } ?>
      calendar.fullCalendar('unselect');

    },
    events: function(start, end, timezone, callback) {
      var url = "pages/list_data_agenda.php?start_date=" + start.format() + "&end_date=" + end.format();
      $.get(url,function(data){
            if (data.events == undefined){
                alert("Error in fetching calendar feed, reason: "+data.err)
            } else {
               callback(data.events);
            }
        },"json");

    },
    eventDrop: function(event, delta, revertFunc) {
			<?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
      var id = event.calendar_id;
      var startDate = event.startDate;
      var endDate = event.endDate;
      var days = delta._days;

      var url = "pages/ajax_edit_date_agenda.php";
      $.ajax({
        type: "POST",
        url: url,
        data: { id:id, startDate:startDate, endDate: endDate, days:days},
        success: function(data){
          if(data.status){
            $('#calendar').fullCalendar( 'refetchEvents' );
          }
        },
        dataType: "json"
      });
			<?php } ?>
    }
});

$('.select2').select2();

$('#form-submit').on('submit', function(e){
    e.preventDefault();
    var pic = JSON.stringify($('#pic').select2("data"));
    var tipe = $('#tipe').val();
		var lokasi = $('#lokasi').val();
    var deskripsi = $('#deskripsi').val();
    var startDate = $('#startDate').val();
    var endDate = $('#endDate').val();


		if(pic.length > 0 && tipe.length > 0 && lokasi.length > 0 && deskripsi.length > 0 && startDate.length > 0 && endDate.length > 0){
			var id = $('#agenda_id').val();
			if(id!=-1){
				var url = "pages/ajax_edit_agenda.php";
				$.ajax({
					type: "POST",
					url: url,
					data: { id:id, pic:pic, lokasi:lokasi, tipe:tipe, deskripsi: deskripsi, startDate: startDate, endDate: endDate},
					success: function(data){
						if(data.status){
							$('#add-agenda').modal('hide');
							$('#calendar').fullCalendar( 'refetchEvents' );
							resetField();
						}else{
							alert(data.message);
						}
					},
					error: function(err){
						console.log(err);
					},
					dataType: "json"
				});
			}else{
				var url = "pages/ajax_tambah_agenda.php";
				$.ajax({
					type: "POST",
					url: url,
					data: { pic:pic, tipe:tipe, lokasi:lokasi, deskripsi: deskripsi, startDate: startDate, endDate: endDate},
					success: function(data){
						if(data.status){
							$('#add-agenda').modal('hide');
							$('#calendar').fullCalendar( 'refetchEvents' );
							resetField();
						}else{
							alert(data.message);
						}
					},
					dataType: "json"
				});
			}
		}else{
			alert("Data tidak boleh kosong.");
		}


  });

$('#delete-btn').on('click', function(){
  $('#agenda_id_delete').val($('#agenda_id').val());
  $("#hapus-dialog").modal('show');
});

  $('#add-agenda').on('hidden.bs.modal', function (e) {
    $('#agenda_id').val(-1);
    $('#delete-btn').hide();
  })

  $('#hapus-dialog').on('hidden.bs.modal', function(e){
    $('#agenda_id_delete').val(-1);
  });

  $('#form-delete').on('submit', function(e){
    var id = $('#agenda_id_delete').val();
    var url = "pages/ajax_hapus_agenda.php";
      $.ajax({
        type: "POST",
        url: url,
        data: { id:id },
        success: function(data){
          if(data.status){
            $('#hapus-dialog').modal('hide');
            $('#add-agenda').modal('hide');
            $('#calendar').fullCalendar( 'refetchEvents' );
          }
        },
        dataType: "json"
      });
      e.preventDefault();
  });

  function resetField(){
    $('.select2').select2().val("").trigger("change");
    $('#deskripsi').val("");
  }

	$('.clearForm').on('click', function(e){
		resetField();
	})
</script>
