<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Edit Data - <?php require('get_title.php'); ?></title>
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
    <!-- iCheck -->

    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
   <!--  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->
    <!-- Morris chart -->
    <!-- jvectormap -->
    <!-- Date Picker -->
    <link href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->

    <!-- bootstrap wysihtml5 - text editor -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
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
              <a href="#"><i class="fa fa-circle text-success"></i> <?= $_SESSION['email'] ?></a>
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
            <li class="treeview <?php if(!isset($_GET['edit'])) { echo "active"; } ?>">
              <a href="index.php">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="data_user") { echo "active"; } ?>">
              <a href="./?page=data_user">
                <i class="fa fa-user-md"></i> <span>Data Pengguna</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="data_pelanggan") { echo "active"; } ?>">
              <a href="./?page=data_pelanggan">
                <i class="fa fa-th"></i> <span>Data Pelanggan</span>
              </a>
            </li>
            <?php } ?>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="data_pic") { echo "active"; } ?>">
              <a href="./?page=data_pic">
                <i class="fa fa-phone-square "></i> <span>Data PIC</span>
              </a>
            </li>
            <?php if($_SESSION['status'] == "sa" || $_SESSION['status'] == "admin"){ ?>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="data_tipe_agenda") { echo "active"; } ?>">
              <a href="./?page=data_tipe_agenda">
                <i class="fa fa-tag"></i> <span>Tipe Agenda</span>
              </a>
            </li>
            <?php } ?>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="agenda") { echo "active"; } ?>">
              <a href="./?page=agenda">
                <i class="fa fa-calendar"></i> <span>Agenda</span>
              </a>
            </li>
            <li class="treeview <?php if(isset($_GET['edit']) && $_GET['edit']=="data_report") { echo "active"; } ?>">
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
            Edit Data
          </h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
            <?php require_once('mod_edit.php'); ?>
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
    <script src="plugins/jQuery/jQuery-2.1.3.min.js" type="text/javascript"></script>
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
    <script src="plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <!-- iCheck -->
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>



    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
     <script>
      $('.colorpicker').colorpicker()
    </script>
  </body>
</html>
