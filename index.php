<?php session_start(); ?>
<?php

  if($_SESSION['email']==null){
   header('Location: login.php');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Jabetto Scheduler - <?php require('get_title.php'); ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- FontAwesome 4.3.0 -->
    <!-- Ionicons 2.0.0 -->
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <link href="dist/css/fa/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="plugins/select2/dist/css/select2.min.css">
    <!-- iCheck -->
    <!-- <link href="plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" /> -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   <!--  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Morris chart -->
    <!-- jvectormap -->
    <!-- Date Picker -->
    <!-- <link href="plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" /> -->
    <!-- Daterange picker -->
    <!-- <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" /> -->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet"/>
    <link href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <!-- bootstrap wysihtml5 - text editor -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
    .fc-time{ display: none; }
    </style>
  </head>
  <body class="skin-blue">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo"><b>Jabetto </b>Scheduler</a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left info">
              <p><?php echo $_SESSION['nama']; ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> <?= $_SESSION['email']; ?></a>
              <br/>
              <br/>
              <?php $status=$_SESSION["status"];
                switch ($status) {
                  case 'sa':
                    echo "<a hef='#'><i class='fa fa-caret-square-o-right' aria-hidden='true'></i> Administator</a>";
                    break;
                  case 'admin':
                    echo "<a hef='#'><i class='fa fa-caret-square-o-right' aria-hidden='true'></i> Admin IT</a>";
                    break;
                  case 'se':
                    echo "<a hef='#'><i class='fa fa-caret-square-o-right' aria-hidden='true'></i> System Engineer</a>";
                    break;
                }

                ?>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MENU UTAMA</li>
            <li class="treeview <?php if(!isset($_GET['page'])) { echo "active"; } ?>">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_user") { echo "active"; } ?>">
              <a href="./?page=data_user">
                <i class="fa fa-user-md"></i> <span>Data Pengguna</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_pelanggan") { echo "active"; } ?>">
              <a href="./?page=data_pelanggan">
                <i class="fa fa-th"></i> <span>Data Pelanggan</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_tipe_agenda") { echo "active"; } ?>">
              <a href="./?page=data_tipe_agenda">
                <i class="fa fa-tag"></i> <span>Tipe Agenda</span>
              </a>
            </li>
            <?php } ?>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_pic") { echo "active"; } ?>">
              <a href="./?page=data_pic">
                <i class="fa fa-phone-square "></i> <span>Data PIC</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="agenda") { echo "active"; } ?>">
              <a href="./?page=agenda">
                <i class="fa fa-calendar"></i> <span>Agenda</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['page']) && $_GET['page']=="data_report") { echo "active"; } ?>">
              <a href="./?page=data_report">
                <i class="fa fa-file"></i> <span>Laporan</span>
              </a>
            </li>
            <li class="header">MENU USER</li>
            <li class="treeview">
              <a href="logout.php">
                <i class="fa fa-backward text-danger"></i> <span>Log Out</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Right side column. Contains the navbar and content of the page -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <?php require_once('get_title.php'); ?>
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <?php

          if (!isset($_GET['page'])) {
            require_once('info.php');
          }

           ?>
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
            <?php require_once('views.php'); ?>
            </section><!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

          </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Jabetto Scheduler </a></strong>
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->

    <!-- jQuery UI 1.11.2 -->
    <script src="plugins/jQueryUI/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- Morris.js charts -->
    <!-- Sparkline -->
    <!-- jvectormap -->
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <!-- datepicker -->
    <script src="plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <!-- iCheck -->
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>

    <script>
      $('.my-colorpicker2').colorpicker()
    </script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="dist/js/pages/dashboard.js" type="text/javascript"></script> -->

    <!-- AdminLTE for demo purposes -->
    <!-- <script src="dist/js/demo.js" type="text/javascript"></script> -->
  </body>
</html>