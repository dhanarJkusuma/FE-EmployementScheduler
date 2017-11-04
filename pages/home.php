<?php require_once('config/main.php');
	date_default_timezone_set('Asia/Bangkok');
	$date = date('D, d M Y');

	$cDate = date('Y-m-d');
	$nextDate = date('Y-m-d', strtotime("+3 day", strtotime($cDate)));
	$agendaQuery = "SELECT
									agenda.id, agenda.deskripsi, agenda_tipe.nama as tipe, pelanggan.nama as lokasi, agenda.tgl_mulai as tgl
									FROM
									agenda,agenda_tipe,pelanggan
									WHERE
									agenda.agenda_tipe_id=agenda_tipe.id
									AND
									agenda.pelanggan_id=pelanggan.id
									AND
									'$cDate' BETWEEN agenda.tgl_mulai AND agenda.tgl_akhir
									OR
									agenda.agenda_tipe_id=agenda_tipe.id
									AND
									agenda.pelanggan_id=pelanggan.id
									AND
									agenda.tgl_mulai BETWEEN '$cDate'  AND '$nextDate'
									ORDER BY agenda.tgl_mulai ASC";
	$query = mysqli_query($conn, $agendaQuery);

?>
<div class="row">
	<div class="col-md-12">
	  <!-- Bar chart -->
	  <div class="box box-primary">
	    <div class="box-header">
	      <i class="fa fa-bar-chart-o"></i>
	      <h3 class="box-title">Agenda Hari Ini & 3 Hari Kedepan</h3>
	    </div>
	    <div class="box-body">
	     <ul class="timeline">
            <!-- timeline time label -->

            <!-- /.timeline-label -->
            <!-- timeline item -->
						<?php $visibleDate = ""; ?>
            <?php while($row = mysqli_fetch_object($query)) { ?>
							<?php if($visibleDate != $row->tgl){ ?>
							<li class="time-label">
	                  <span class="bg-red">
	                    <?= date('D, d M Y', strtotime($row->tgl)); ?>
	                  </span>
	            </li>
							<?php } ?>
							<?php $visibleDate = $row->tgl; ?>
            <?php
							$querySchedule = "SELECT
																	agenda_teknisi.teknisi_id,
																	pengguna.nama
																	FROM agenda_teknisi, pengguna
																	WHERE
																	agenda_teknisi.teknisi_id = pengguna.id
																	and
																	agenda_id='$row->id'";

            	$picQuery = mysqli_query($conn, $querySchedule);

            	$title = $row->tipe . " - ";
            	$jumlah = mysqli_num_rows($picQuery);
            	$index=0;
            	while($pic = mysqli_fetch_object($picQuery)){
					$title .= $pic->nama;
					if($index < $jumlah-1){
						$title .= ", ";
					}
					$index++;
				}
            ?>
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">

                <h3 class="timeline-header"><?= $title ?> </h3>

                <div class="timeline-body">
									<i class="fa fa-map-marker" aria-hidden="true"></i> &nbsp; <?= $row->lokasi ?> </br>
             			<?= $row->deskripsi ?>
                </div>
              </div>
            </li>

            <?php } ?>
            <!-- END timeline item -->
            <!-- timeline item -->

            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>

	    </div><!-- /.box-body-->
	  </div><!-- /.box -->
	</div>
</div>


<script src="plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
