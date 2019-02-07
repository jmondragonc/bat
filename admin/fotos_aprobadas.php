<?php
session_start();
require_once("../inc/config.php");
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){

if(isset($_POST['form']) && !empty($_POST['form'])){

    if (is_array($_POST['check'])) {
        foreach($_POST['check'] as $value){

            DB::update('imagen',
                array(
                    'status' => 0
                ), "id=%s", $value);
        }
    }

}

    //Si existe POST Buscar
    if(isset($_POST['buscar']) && $_POST['buscar']!='')
    {
        header("Location: fotos_aprobadas.php?b=".urlencode($_POST['buscar']));
    }

    if(isset($_GET['b']) && $_GET['b']!='')
    {
        $query_string = '';
        $words = explode(" ", ucwords(urldecode($_GET["b"])));
        for ($i=0;$i<count($words);$i++){
            $query_string .=  "LIKE '%".$words[$i]."%' OR u.nombres ";
        }

        $query_string = substr($query_string,0,strlen($query_string)-13);

        $imgs = DB::query("SELECT *, 
            i.id as idimg
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE i.status=%i AND u.nombres ".$query_string, 1);

        $counter = DB::count();
        echo $counter;

        $numrows = $counter;
        $rowsperpage = 9;
        $totalpages = ceil($numrows / $rowsperpage);

        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $currentpage = (int) $_GET['page'];
        } else {
            $currentpage = 1;
        }
        if ($currentpage > $totalpages) {
            $currentpage = $totalpages;
        }
        if ($currentpage < 1) {
            $currentpage = 1;
        }
        $offset = ($currentpage - 1) * $rowsperpage;

        $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
            i.id as idimg 
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE (i.status=%i) AND (u.nombres ".$query_string.") 
            LIMIT $offset, $rowsperpage", 1);

        $counter_res =  DB::count();

    }
    else
    {
        //Si existe GET Ranking
        if(isset($_GET['rnk']) && !empty($_GET['rnk']))
        {
            $imgs = DB::query("SELECT * FROM imagen WHERE status=%i AND ISNULL(yaparticipo)", 1);
            $counter = DB::count();
            $numrows = $counter;
            $rowsperpage = 9;
            $totalpages = ceil($numrows / $rowsperpage);

            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentpage = (int) $_GET['page'];
            } else {
                $currentpage = 1;
            }
            if ($currentpage > $totalpages) {
                $currentpage = $totalpages;
            }
            if ($currentpage < 1) {
                $currentpage = 1;
            }
            $offset = ($currentpage - 1) * $rowsperpage;

            $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
                    i.id as idimg 
                    FROM imagen i
                    INNER JOIN usuario u on u.id = i.userid 
                    WHERE i.status=%i AND ISNULL(i.yaparticipo) AND i.fecha >= DATE('2018-04-29') ORDER BY totalvotos DESC, i.fecha ASC 
                    LIMIT $offset, $rowsperpage", 1);
            $counter_res =  DB::count();

        }
        else
        {
            //Query por defecto
            $imgs = DB::query("SELECT *, i.id AS idimg, i.fecha AS fechaimg FROM imagen i INNER JOIN usuario u ON i.userid = u.id WHERE i.status=%i", 1);
            $counter = DB::count();
            $numrows = $counter;
            $rowsperpage = 20;
            $totalpages = ceil($numrows / $rowsperpage);

            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                $currentpage = (int) $_GET['page'];
            } else {
                $currentpage = 1;
            }
            if ($currentpage > $totalpages) {
                $currentpage = $totalpages;
            }
            if ($currentpage < 1) {
                $currentpage = 1;
            }
            $offset = ($currentpage - 1) * $rowsperpage;

            $results = DB::query("SELECT *, i.id AS idimg, i.fecha AS fechaimg 
              FROM imagen i INNER JOIN usuario u ON i.userid = u.id 
              WHERE i.status=%i ORDER BY fechaimg DESC
              LIMIT $offset, $rowsperpage", 1);
            $counter_res = DB::count();

        }
    }

    $range = 3;
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
          <a href="index.php">Inicio</a>
        </li>
        <li class="breadcrumb-item active">Fotos aprobadas (<?php echo $counter; ?>)</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Fotos aprobadas recientemente</div>
        <div class="card-body">
          <div class="table-responsive">
              <div class="row">
                  <div class="col-md-12 text-right busqueda">
                      <form name="busqueda" id="busqueda" action="fotos_aprobadas.php" method="post">
                          <input type="text" class="search" name="buscar" id="buscar" value="<?php if(isset($_POST['buscar']) && $_POST['buscar']!='' ){ echo $_POST['buscar']; } ?>"><input type="submit" src="img/icosearch.jpg" class="imgsearch" value="Buscar" name="search" width="36" height="36" alt="Buscar">
                      </form>
                  </div>
              </div>
              <form name="fotos" id="fotos" method="post" action="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                    <th class="text-center no-sort"><input type="checkbox"  id="select_all"></th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Fecha Nac.</th>
                    <th>Fecha de registro</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th class="text-center"><input type="checkbox" id="select_all2"></th>
                    <th>Foto</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>Fecha Nac.</th>
                    <th>Fecha de registro</th>
                </tr>
              </tfoot>
              <tbody>
                <?php if($counter_res>0){
                    foreach($results as $img){
                    ?>
                <tr>
                  <td class="text-center"><input type="checkbox" name="check[]" class="checkbox" value="<?php echo $img['idimg']; ?>"></td>
                    <td class="text-center"><a href="detalle.php?id=<?php echo $img['idimg']; ?>"><img src="../<?php echo $img['file']; ?>" alt="" width="120"></a></td>
                  <td><?php echo utf8_encode($img['nombres']); ?></td>
                  <td><?php echo $img['correo']; ?></td>
                  <td><?php echo $img['fechanac']; ?></td>
                  <td><?php echo $img['fechareg']; ?></td>
                </tr>
                <?php } } ?>

              </tbody>
            </table>
                  <div style="height: 30px;"></div>
                  <?php
                  if($counter_res>0){
                      if(isset($_GET['b'])){
                          $bsq = '&b='.$_GET['b'];
                      } else {
                          $bsq='';
                      }
                      ?>
                      <div class="row pagination">
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                              <?php if ($currentpage > 1) {
                                  //echo " <a href='{$_SERVER['PHP_SELF']}?page=1'><<</a> ";
                                  $prevpage = $currentpage - 1;
                                  echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage$bsq' class='pageprev'>< Anterior</a> ";
                              } ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                              <?php
                              for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                  if (($x > 0) && ($x <= $totalpages)) {
                                      if ($x == $currentpage) {
                                          echo $x;
                                      } else {
                                          echo " <a href='{$_SERVER['PHP_SELF']}?page=$x$bsq'>$x</a> ";
                                      }
                                  }
                              }
                              ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-left">
                              <?php
                              if ($currentpage != $totalpages) {
                                  $nextpage = $currentpage + 1;
                                  if($totalpages>1){
                                      echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage$bsq' class='pagenext'>Siguiente ></a> ";
                                      //echo " <a href='{$_SERVER['PHP_SELF']}?page=$totalpages'>>></a> ";
                                  }

                              }
                              ?>
                          </div>
                      </div>
                  <?php } else {
                      echo '<div style="height: 30px;"></div>';
                  }?>
                  <div style="height: 30px;"></div>
                  <div class="card-footer small text-muted text-right"><input type="submit" class="btn btn-primary" value="DESAPROBAR" name="submit"></div>
                  <input type="hidden" name="form" id="form" value="form">
                  <input type="hidden" name="eliminar" id="eliminar" value="">
              </form>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Battimixea 2018</small>
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
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>


  </div>
</body>

</html>
<?php } else{
    header("Location: login.php");
}?>
