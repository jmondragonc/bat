<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "inc/config.php";
// If you are using Composer (recommended)
require 'vendor/autoload.php';

$correo = $_POST['correo'];

function Email($nombres, $correo, $clave){
    $html = '<div style="width: 600px; background-color: #2fbdea; margin: 0 auto;">
        <div style="padding: 42px 43px 30px 43px;">
        <img src="https://battimixea.com/mailing/logo_battimixea.png" alt="" width="208" height="27" style="margin: 0 0 32px 0;">
        <p style="font-family: Arial; color: #FFF; font-weight: bold;">Hola '.$nombres.',</p>
        <p style="font-family: Arial; color: #FFF; font-weight: normal;">Hemos recibido un pedido de recuperación de contraseña de tu cuenta (<a href="mailto:' . $correo . '" style="color: #FFF;">'.$correo.'</a>) en <a href="https://battimixea.com/participa" style="color: #FFF; font-weight: bold; text-decoration: none;">battimixea.com/participa</a>,<br><br>Tu contraseña con la que te registraste en nuestra web es:</p>
        <p style="font-family: Arial; color: #deffed; font-size: 18px; font-weight: bold; width: 100%; text-align: center; border-top: solid 1px #FFF; padding: 10px 0; border-bottom: solid 1px #FFF;">'.$clave.'</p>
        <p style="font-family: Arial; color: #FFF; font-weight: normal; padding: 0; margin: 0;">Con esta misma, ya puedes ingresar a la web <span style="font-weight: bold;">¡y seguir Battimixeando!</span></p>
        </div>
        <div style="width: 600px; margin: 0 auto; background-color: #29a6ce; height: 38px; line-height: 38px; text-align: center; font-family: Arial; font-size: 14px; padding: 0; color: #FFF;">&copy; 2018 / Battimix</div>
    </div>';
    return $html;
}

if(isset($_POST['correo']) && !empty($_POST['correo']) ){

    $user = DB::queryFirstRow("SELECT id, correo, nombres, clave FROM usuario WHERE correo=%s", $correo);

    $counter = DB::count();

    if($counter>0){
        $nombres = utf8_encode($user['nombres']);
        $id = $user['id'];
        $clave = $user['clave'];
        $data = array();

        $from = new SendGrid\Email('Battimixea', "hola@battimixea.com");
        $subject = "Recuperar contraseña - Battimixea.com";
        $to = new SendGrid\Email(null, $correo);
        $content = new SendGrid\Content("text/html", Email($nombres, $correo, $clave));
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = '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';
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);

        $data[] = array('rpta'=> 'ok', 'id'=> $id);
        echo json_encode($data);
    }else{
        $data[] = array('rpta'=> 'no');
        echo json_encode($data);
    }

}

