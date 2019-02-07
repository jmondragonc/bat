<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
/*use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;*/

require '../vendor/autoload.php';

require_once("../inc/config.php");
/*require '../inc/Exception.php';
require '../inc/PHPMailer.php';
require '../inc/SMTP.php';*/

if(isset($_POST['form']) && !empty($_POST['form'])){
    DB::update('contenido',
        array(
            'contenido' => ($_POST['editor_content']),
        ), "id=%s", 1);
    header("Location: tyc.php?ok");
}

if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){
    $tyc = DB::queryFirstRow("SELECT * FROM contenido WHERE id=%i", 1);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/froala_editor.css">
    <link rel="stylesheet" href="css/froala_style.css">
    <link rel="stylesheet" href="css/plugins/code_view.css">
    <link rel="stylesheet" href="css/plugins/draggable.css">
    <link rel="stylesheet" href="css/plugins/colors.css">
    <link rel="stylesheet" href="css/plugins/emoticons.css">
    <link rel="stylesheet" href="css/plugins/image_manager.css">
    <link rel="stylesheet" href="css/plugins/image.css">
    <link rel="stylesheet" href="css/plugins/line_breaker.css">
    <link rel="stylesheet" href="css/plugins/table.css">
    <link rel="stylesheet" href="css/plugins/char_counter.css">
    <link rel="stylesheet" href="css/plugins/video.css">
    <link rel="stylesheet" href="css/plugins/fullscreen.css">
    <link rel="stylesheet" href="css/plugins/file.css">
    <link rel="stylesheet" href="css/plugins/quick_insert.css">
    <link rel="stylesheet" href="css/plugins/help.css">
    <link rel="stylesheet" href="css/third_party/spell_checker.css">
    <link rel="stylesheet" href="css/plugins/special_characters.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.3.0/codemirror.min.css">

    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <style>
        label{
            width: 200px;
            font-weight: normal;
        }
        .desc{
            padding: 40px!important;
            box-sizing: border-box;
        }
        .desc p{
            font-weight: bold;
        }
        a.btn{
            color: #FFF!important;
        }
        .hecho{
            color: #FFF;
            width: 90%;
            box-sizing: border-box;
            display: block;
            float: left;
            padding: 20px;
        }
        .fila{
            padding: 20px!important;
            margin: 0!important;
        }
        a[href="https://www.froala.com/wysiwyg-editor?k=u"] {
            display: none !important;
            position: absolute;
            top: -99999999px;
        }
    </style>
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
          <li class="breadcrumb-item active">Términos y condiciones</li>
      </ol>
      <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Detalle del contenido</div>
            <div class="card-bod"">
            <?php if(isset($_GET['ok'])){?>
            <div class="row fila">
                <div class="col-lg-12 bg-success hecho">Contenido correctamente editado</div>
            </div>
            <?php } ?>
                <form action="" method="POST">
                    <textarea name="editor_content" id="myEditor"><?php echo utf8_encode($tyc['contenido']); ?></textarea>
                    <input type="submit" name="submit" value="ENVIAR" class="btn btn-primary" style="margin: 10px; float: right;">
                    <input type="hidden" name="form" id="form" value="form">
                </form>

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

      <script type="text/javascript" src="js/codemirror.min.js"></script>
      <script type="text/javascript" src="js/xml.min.js"></script>

      <script type="text/javascript" src="js/froala_editor.min.js" ></script>
      <script type="text/javascript" src="js/plugins/align.min.js"></script>
      <script type="text/javascript" src="js/plugins/char_counter.min.js"></script>
      <script type="text/javascript" src="js/plugins/code_beautifier.min.js"></script>
      <script type="text/javascript" src="js/plugins/code_view.min.js"></script>
      <script type="text/javascript" src="js/plugins/colors.min.js"></script>
      <script type="text/javascript" src="js/plugins/draggable.min.js"></script>
      <script type="text/javascript" src="js/plugins/emoticons.min.js"></script>
      <script type="text/javascript" src="js/plugins/entities.min.js"></script>
      <script type="text/javascript" src="js/plugins/file.min.js"></script>
      <script type="text/javascript" src="js/plugins/font_size.min.js"></script>
      <script type="text/javascript" src="js/plugins/font_family.min.js"></script>
      <script type="text/javascript" src="js/plugins/fullscreen.min.js"></script>
      <script type="text/javascript" src="js/plugins/image.min.js"></script>
      <script type="text/javascript" src="js/plugins/image_manager.min.js"></script>
      <script type="text/javascript" src="js/plugins/line_breaker.min.js"></script>
      <script type="text/javascript" src="js/plugins/inline_style.min.js"></script>
      <script type="text/javascript" src="js/plugins/link.min.js"></script>
      <script type="text/javascript" src="js/plugins/lists.min.js"></script>
      <script type="text/javascript" src="js/plugins/paragraph_format.min.js"></script>
      <script type="text/javascript" src="js/plugins/paragraph_style.min.js"></script>
      <script type="text/javascript" src="js/plugins/quick_insert.min.js"></script>
      <script type="text/javascript" src="js/plugins/quote.min.js"></script>
      <script type="text/javascript" src="js/plugins/table.min.js"></script>
      <script type="text/javascript" src="js/plugins/save.min.js"></script>
      <script type="text/javascript" src="js/plugins/url.min.js"></script>
      <script type="text/javascript" src="js/plugins/video.min.js"></script>
      <script type="text/javascript" src="js/plugins/help.min.js"></script>
      <script type="text/javascript" src="js/plugins/print.min.js"></script>
      <script type="text/javascript" src="js/third_party/spell_checker.min.js"></script>
      <script type="text/javascript" src="js/plugins/special_characters.min.js"></script>
      <script type="text/javascript" src="js/plugins/word_paste.min.js"></script>
      <script>
          $(function() {

              $('#myEditor').froalaEditor({toolbarInline: false,spellcheck: false});

              $('.fr-wrapper div:eq(0)').hide();

              $('.fr-wrapper').mouseup(function () {
                  $('.fr-wrapper div:eq(0)').hide();
              });
              $( ".fr-wrapper" ).keyup(function() {
                  $('.fr-wrapper div:eq(0)').hide();
              });
              setTimeout(function () {
                  $('.fila').fadeOut(350);
              }, 3000);
          });
      </script>
  </div>
</body>

</html>
<?php } else{
    header("Location: login.php");
}?>
