<?php require_once('config/main.php');

?>
<div class="row">
	<div class="col-md-12">
	  <!-- Bar chart -->
	  <div class="box box-primary">
	    <div class="box-header">
	      <i class="fa fa-bar-chart-o"></i>
	      <h3 class="box-title">Piket Hari Ini</h3>
	    </div>
	    <div class="box-body">
	      <div id="bar-chart" style="height: 300px;"></div>
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
