<?php session_start();
require_once('../inc/config.php');
;
if(isset($_POST['form']) && !empty($_POST['form'])){
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $user = DB::queryFirstRow("SELECT * FROM admin WHERE usuario=%s OR clave=%s ", $usuario, $clave);
    $counter = DB::count();

    if($counter>0){
        $_SESSION['admin'] = $user['id'];
        header("Location: index.php");
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Battimixea - Ingreso de usuarios - Administración</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Ingreso de usuarios</div>
      <div class="card-body">
        <form name="login" id="login" method="post" action="">
          <div class="form-group">
            <label for="exampleInputEmail1">Usuario</label>
            <input class="form-control" name="usuario" id="usuario" type="text">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Contraseña</label>
            <input class="form-control" name="clave" id="clave" type="password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Recordar contraseña</label>
            </div>
          </div>
          <input type="submit" class="btn btn-primary btn-block" href="index.php" value="Ingresar">
            <input type="hidden" name="form" id="form" value="form">
        </form>

      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
