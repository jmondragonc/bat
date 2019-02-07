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

if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){

    if(isset($_POST['form']) && !empty($_POST['form'])){
        function Email($nombres, $id, $file){
            $html = '<div style="width: 600px; background-color: #2fbdea; margin: 0 auto;">
                <div style="padding: 0 43px 30px 43px;">
                <img src="https://battimixea.com/mailing/top.png" alt="" width="526" height="77" style="margin: 0 0 20px 0; display: block;">
                <p style="font-family: Arial; color: #deffed; font-weight: bold;">Hola '.$nombres.',</p>
                <p style="font-family: Arial; color: #FFF;">GRACIAS POR BATTIMIXEAR CON BATIMIX, ESTA FUE TU COMBINACIÓN Y EN BREVE PODRÁS VERLA EN LA GALERÍA DE NUESTRO LANDING ENTRANDO EN ESTA DIRECCIÓN URL:</p>
                <p style="font-family: Arial; color: #FFF; font-weight: bold;"><a href="https://battimixea.com/galeria?id='.$id.'" style="font-family: Arial; color: #FFF; font-weight: bold; text-decoration: none;">https://battimixea.com/galeria?id='.$id.'</a></p>
                <p><img src="https://battimixea.com/'.$file.'" width="516" height="437" style="display: block; border: none;"></p>
                <p style="font-family: Arial; color: #FFF; font-weight: normal; padding: 0; margin: 0; font-weight: bold; text-align: center;">NO TE OLVIDES DE COMPARTIRLA PARA  QUE TUS AMIGOS LA VEAN Y TE APOYEN DÁNDOLE LIKE EN EL LANDING.</p>
                <p style="width: 100%; text-align: center"><a href="https://battimixea.com/galeria?id='.$id.'" style="display: block;"><img src="https://battimixea.com/mailing/btn.png"></a></p>
                </div>
                <div style="width: 600px; margin: 0 auto; background-color: #29a6ce; height: 38px; line-height: 38px; text-align: center; font-family: Arial; font-size: 14px; padding: 0; color: #FFF;">&copy; 2018 / Battimix</div>
            </div>';
            return $html;
        }

        $value = $_GET['id'];
        DB::update('imagen',
            array(
                'status' => 1
            ), "id=%i", $value);

        $user = DB::queryFirstRow("SELECT *, i.id AS idimg FROM imagen i INNER JOIN usuario u ON i.userid = u.id WHERE i.id=%i", $value);
        $id = $value;
        $correo = $user['correo'];
        $nombres = utf8_encode($user['nombres']);
        $file = $user['file'];

        if( !empty($correo) ){

            if( !empty($correo) ){
                $from = new SendGrid\Email('Battimixea', "hola@battimixea.com");
                $subject = "Nueva combinación - Battimixea.com";
                $to = new SendGrid\Email(null, $correo);
                $content = new SendGrid\Content("text/html", Email($nombres, $id, $file));
                $mail = new SendGrid\Mail($from, $subject, $to, $content);
                $apiKey = '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';
                $sg = new \SendGrid($apiKey);
                $response = $sg->client->mail()->send()->post($mail);
                //var_dump($response);
            }

            /*$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.yandex.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'hola@battimixea.com';                 // SMTP username
                $mail->Password = 'Pedrode0sm@!';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('hola@battimixea.com', 'Battimixea');
                $mail->addAddress($correo, $nombres);     // Add a recipient
                $mail->addReplyTo('hola@battimixea.com', 'Battimixea');
//                    $mail->addCC('cc@example.com');
//                    $mail->addBCC('bcc@example.com');

                //Attachments
//                    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//                    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = utf8_decode("Nueva combinación - Battimixea.com");
                $mail->Body    = Email($nombres, $id, $file);
                //$mail->AltBody = 'Mensaje de Battimixea';

                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }*/
        }

        header("Location: usuarios.php");
    }

    $img = DB::queryFirstRow("SELECT * FROM imagen i INNER JOIN usuario u ON i.userid = u.id WHERE i.id=%i", $_GET['id']);
    $counter = DB::count();

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
          <li class="breadcrumb-item active"><a href="usuarios.php">Detalle de la foto</a></li>
          <li class="breadcrumb-item active">Detalle</li>
      </ol>
      <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-area-chart"></i> Detalle de la imagen</div>
            <div class="card-bod text-center">
                <img src="../<?php echo $img['file']; ?>" alt="">
                <div class="row">
                    <div class="col-lg-12 text-left desc">
                        <p><label>Nombres:</label><?php echo utf8_encode($img['nombres']); ?></p>
                        <p><label>Correo:</label><?php echo $img['correo']; ?></p>
                        <p><label>Fecha de Nacimiento:</label><?php echo $img['fechanac']; ?></p>
                        <p><label>Fecha de Registro:</label><?php echo $img['fecha']; ?></p>
                        <p><label>Url de Facebook:</label><?php echo $img['fburl']; ?></p>
                        <p><label>ID de Facebook:</label><?php echo $img['fbid']; ?></p>
                    </div>
                </div>
                <form name="actualizar" id="actualizar" method="post" action="">
                <div class="row">
                    <div class="col-lg-12 text-right desc">
                        <a class="btn btn-secondary" onclick="location.href='eliminar.php?id=<?php echo $_GET['id']?>&form=form'">ELIMINAR FOTO</a>
                        <input type="submit" name="submit" value="APROBAR" class="btn btn-primary">
                        <input type="hidden" name="form" id="form" value="form">
                    </div>
                </div>
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
  </div>
</body>

</html>
<?php } else{
    header("Location: login.php");
}?>
