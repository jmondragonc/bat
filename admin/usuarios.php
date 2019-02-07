<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once("../inc/config.php");
require '../inc/Exception.php';
require '../inc/PHPMailer.php';
require '../inc/SMTP.php';

if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])){

if(isset($_POST['form']) && !empty($_POST['form'])){
function Email($nombres, $id, $file){
    $html = '<div style="width: 600px; background-color: #2fbdea; margin: 0 auto;">
                <div style="padding: 0 43px 30px 43px;">
                <img src="https://battimixea.com/mailing/top.png" alt="" width="526" height="77" style="margin: 0 0 20px 0; display: block;">
                <p style="font-family: Arial; color: #FFF; font-weight: bold;">Hola '.$nombres.',</p>
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

if($_POST['del']=='ok'){
    if (is_array($_POST['check'])) {
        foreach($_POST['check'] as $value){
            DB::update('imagen',
                array(
                    'status' => 2
                ), "id=%s", $value);
        }
    }
}
else{

    if (is_array($_POST['check'])) {

        foreach($_POST['check'] as $value){
            DB::update('imagen',
                array(
                    'status' => 1
                ), "id=%s", $value);

            $user = DB::queryFirstRow("SELECT *, i.id AS idimg, i.fecha AS fechaimg FROM imagen i INNER JOIN usuario u ON i.userid = u.id WHERE i.id=%i", $value);
            $id = $value;
            $correo = $user['correo'];
            $nombres = utf8_encode($user['nombres']);
            $file = $user['file'];

            // echo $id.' - '.$correo.' - '.$nombres.' - '.$file;

            if( !empty($correo) ){
                $from = new SendGrid\Email('Battimixea', "hola@battimixea.com");
                $subject = "Nueva combinación - Battimixea.com";
                $to = new SendGrid\Email(null, $correo);
                $content = new SendGrid\Content("text/html", Email($nombres, $id, $file));
                $mail = new SendGrid\Mail($from, $subject, $to, $content);
                $apiKey = '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';
                $sg = new \SendGrid($apiKey);
                $response = $sg->client->mail()->send()->post($mail);

               /* $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
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
                header("Location: usuarios.php?");
            }
        }
    }

}

}
    //Si existe POST Buscar
    if(isset($_POST['buscar']) && $_POST['buscar']!='')
    {
        header("Location: usuarios.php?b=".urlencode($_POST['buscar']));
    }

    if(isset($_GET['b']) && $_GET['b']!='')
    {
        $query_string = '';
        $words = explode(" ", ucwords(urldecode($_GET["b"])));
        for ($i=0;$i<count($words);$i++){
            $query_string .=  "LIKE '%".$words[$i]."%' OR u.nombres ";
        }

        $query_string = substr($query_string,0,strlen($query_string)-13);

        $imgs = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
            i.id as idimg
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE (i.status=%i) AND (u.nombres ".$query_string.")", 0);

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
            WHERE (i.status=%i) AND (u.nombres ".$query_string.") 
            LIMIT $offset, $rowsperpage", 0);

        $counter_res =  DB::count();

    }
    else
    {

            //Query por defecto
            $imgs = DB::query("SELECT *, i.id AS idimg, i.fecha AS fechaimg FROM imagen i INNER JOIN usuario u ON i.userid = u.id WHERE i.status=%i ", 0);
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

            $results = DB::query("SELECT *, i.id AS idimg, i.fecha AS fechaimg 
              FROM imagen i INNER JOIN usuario u ON i.userid = u.id 
              WHERE i.status=%i
              LIMIT $offset, $rowsperpage", 0);
            $counter_res = DB::count();


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
    <style>
        .bottom{
            width: 100%;
            max-width: 100%;
            margin: 30px 0 0 0;
            padding: 0;
            box-sizing: border-box;
            overflow: hidden;
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
        <li class="breadcrumb-item active">Fotos Sin Aprobar (<?php echo $counter; ?>)</li>
      </ol>
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Fotos recientes sin aprobar</div>
        <div class="card-body">
          <div class="table-responsive">
              <form name="fotos" id="fotos" method="post" action="">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                        <th class="text-center no-sort"><input type="checkbox"  id="select_all"></th>
                        <th>Foto</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Fecha Nac.</th>
                        <th>Facebook ID</th>
                        <th>Facebook URL</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th class="text-center"><input type="checkbox" id="select_all2"></th>
                        <th>Foto</th>
                        <th>Nombres</th>
                        <th>Correo</th>
                        <th>Fecha Nac.</th>
                        <th>Facebook ID</th>
                        <th>Facebook URL</th>
                        <th>Fecha de Ingreso</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php if($counter_res>0){
                        foreach($results as $img){
                        ?>
                    <tr>
                      <td class="text-center">
                          <input type="checkbox" name="check[]" class="checkbox" value="<?php echo $img['idimg']; ?>">
                          <input type="hidden" name="nombres[]" value="<?php echo $img['nombres']; ?>">
                          <input type="hidden" name="correo[]" value="<?php echo $img['correo']; ?>">
                          <input type="hidden" name="file[]" value="<?php echo $img['file']; ?>">
                      </td>
                        <td class="text-center"><a href="detalle.php?id=<?php echo $img['idimg']; ?>"><img src="../<?php echo $img['file']; ?>" alt="" width="120"></a></td>
                      <td><?php echo utf8_encode($img['nombres']); ?></td>
                      <td><?php echo $img['correo']; ?></td>
                      <td><?php echo $img['fechanac']; ?></td>
                      <td><?php echo $img['fbid']; ?></td>
                      <td style="max-width: 300px; width: 300px"><a href="<?php echo $img['fburl']; ?>" target="_blank"><?php echo $img['fburl']; ?></a></td>
                      <td><?php echo $img['fechaimg']; ?></td>
                    </tr>
                    <?php } } ?>

                  </tbody>
                </table>
                  <?php
                  if($counter_res>0){?>
                      <div class="row pagination">
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-right">
                              <?php if ($currentpage > 1) {
                                  //echo " <a href='{$_SERVER['PHP_SELF']}?page=1'><<</a> ";
                                  $prevpage = $currentpage - 1;
                                  echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage' class='pageprev'>< Anterior</a> ";
                              } ?>
                          </div>
                          <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 text-center">
                              <?php
                              for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                  if (($x > 0) && ($x <= $totalpages)) {
                                      if ($x == $currentpage) {
                                          echo $x;
                                      } else {
                                          echo " <a href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a> ";
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
                                      echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage' class='pagenext'>Siguiente ></a> ";
                                      //echo " <a href='{$_SERVER['PHP_SELF']}?page=$totalpages'>>></a> ";
                                  }

                              }
                              ?>
                          </div>
                      </div>
                  <?php } else {
                      echo '<div style="height: 30px;"></div>';
                  }?>
                  <div class="row bottom">
                      <div class="col-lg-12 text-right desc">
                          <a href="#" class="btn btn-secondary eliminar">ELIMINAR FOTO</a>
                          <a href="#" class="btn btn-primary aprobar" value="APROBAR">APROBAR</a>
                          <input type="hidden" name="form" id="form" value="form">
                          <input type="hidden" name="del" id="del" value="">
                      </div>
                  </div>

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
      <script>
          jQuery(document).ready(function ($) {
              $('.btn.eliminar').click(function (e) {
                  e.preventDefault();

                  $('#del').val('ok');
                  $(this).closest("form").submit();
              });
              $('.btn.aprobar').click(function (e) {
                  e.preventDefault();
                  $('#del').val('');

                  var $this = $(this);
                  var $form = $this.closest("form");
                  $data = $form.serialize();

                 // $(this).closest("form").submit();

                  $.ajax({
                      url: "/envio_admin.php",
                      type: "POST",
                      data: $data,
                      dataType: 'json',
                      beforeSend: function (xhr, settings) {

                      },
                      success: function (data) {

                          if(data[0].rpta=='ok'){

                              window.location.href='usuarios.php';

                          }else{
                              console.log(data);

                          }
                      },
                      error: function (jqXHR, exception, response) {
                         // alert('Ha ocurrido un error');
                      }
                  });

              });
          });
      </script>
  </div>
</body>

</html>
<?php } else{
    header("Location: login.php");
}?>
