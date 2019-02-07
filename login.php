<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "inc/config.php";


$password = $_POST['password'];
$correo = $_POST['correo'];

if(isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['password']) && !empty($_POST['password'])){

    $user = DB::queryFirstRow("SELECT id, correo, clave FROM usuario WHERE correo=%s AND clave=%s", $correo, $password);

    $counter = DB::count();

    if($counter>0){
        $id = $user['id'];
        $data = array();
        $data[] = array('rpta'=> 'ok', 'id'=> $id);
        echo json_encode($data);
    }else{
        $data[] = array('rpta'=> 'no');
        echo json_encode($data);
    }

}

