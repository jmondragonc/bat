<?php error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once("../inc/config.php");

if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
    $user1 = DB::query("SELECT * FROM imagen WHERE status=%i", 1);
    $counter = DB::count();

    $user2 = DB::query("SELECT * FROM imagen WHERE status=%i", 0);
    $counter2 = DB::count();

    $user3 = DB::query("SELECT * FROM imagen WHERE status=%i", 2);
    $counter3 = DB::count();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Battimixea - Administración</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><img src="../img/logo.png" alt=""></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
              <a class="nav-link" href="index.php">
                <i class="fa fa-fw fa-dashboard"></i>
                <span class="nav-link-text">Inicio</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
              <a class="nav-link" href="usuarios.php">
                <i class="fa fa-fw fa-table"></i>
                <span class="nav-link-text">Fotos Sin Aprobar</span>
              </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
              <a class="nav-link" href="fotos_aprobadas.php">
                <i class="fa fa-fw fa-table"></i>
                <span class="nav-link-text">Fotos Aprobadas</span>
              </a>
            </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
              <a class="nav-link" href="fotos_eliminadas.php">
                  <i class="fa fa-fw fa-table"></i>
                  <span class="nav-link-text">Fotos Eliminadas</span>
              </a>
          </li>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
              <a class="nav-link" href="tyc.php">
                  <i class="fa fa-fw fa-table"></i>
                  <span class="nav-link-text">Términos y condiciones</span>
              </a>
          </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">


        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>


      <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a class="nav-link mr-lg-2" id="messagesDropdown" href="/" target="_blank" >
                  <i class="fa fa-fw fa-globe"></i>
                  Ver Sitio Web
                  <span class="d-lg-none">Messages</span>

              </a>

          </li>

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
         Inicio
        </li>
      </ol>
      <!-- Icon Cards-->
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-3">
          <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
              <div class="card-body-icon">
                <i class="fa fa-fw fa-list"></i>
              </div>
              <div class="mr-5"><?php echo $counter; ?> Fotos Aprobadas</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="fotos_aprobadas.php">
              <span class="float-left">Ver detalle</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>

          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-warning o-hidden h-100">
                  <div class="card-body">
                      <div class="card-body-icon">
                          <i class="fa fa-fw fa-list"></i>
                      </div>
                      <div class="mr-5"><?php echo $counter2; ?> Fotos sin aprobar</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="usuarios.php">
                      <span class="float-left">Ver detalle</span>
                      <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                  </a>
              </div>
          </div>

          <div class="col-xl-3 col-sm-6 mb-3">
              <div class="card text-white bg-danger o-hidden h-100">
                  <div class="card-body">
                      <div class="card-body-icon">
                          <i class="fa fa-fw fa-list"></i>
                      </div>
                      <div class="mr-5"><?php echo $counter3; ?> Fotos eliminadas</div>
                  </div>
                  <a class="card-footer text-white clearfix small z-1" href="fotos_eliminadas.php">
                      <span class="float-left">Ver detalle</span>
                      <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                  </a>
              </div>
          </div>

      </div>

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar sesión</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">¿Realmente desea cerrar la sesión?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
<?php } else{
    header("Location: login.php");
}?>
