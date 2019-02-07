<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once "inc/config.php";
// If you are using Composer (recommended)
require 'vendor/autoload.php';

$correo = $_POST['correo'];
$id = $_POST['id'];
$nombres = $_POST['nombres'];
$file = $_POST['file'];

function Email($nombres, $id, $file){
    $html = '<div style="width: 600px; background-color: #2fbdea; margin: 0 auto;">
        <div style="padding: 0 43px 30px 43px;">
        <img src="https://battimixea.com/mailing/top.png" alt="" width="526" height="77" style="margin: 0 0 20px 0; display: block;">
        <p style="font-family: Arial; color: #FFF; font-weight: bold;">Hola '.$nombres.',</p>
		<p style="font-family: Arial; color: #FFF;">GRACIAS POR BATTIMIXEAR CON BATIMIX, ESTA FUE TU COMBINACIÓN Y EN BREVE PODRÁS VERLA EN LA GALERÍA DE NUESTRO LANDING ENTRANDO EN ESTA DIRECCIÓN URL:</p>
		<p style="font-family: Arial; color: #FFF; font-weight: bold;"><a href="https://battimixea.com/galeria?id='.$id.'" style="font-family: Arial; color: #FFF; font-weight: bold; text-decoration: none;">https://battimixea.com/galeria?id='.$id.'</a></p>
		<p><img src="https://battimixea.com/img/files/'.$file.'" width="516" height="437" style="display: block; border: none;"></p>
        <p style="font-family: Arial; color: #FFF; font-weight: normal; padding: 0; margin: 0; font-weight: bold; text-align: center;">NO TE OLVIDES DE COMPARTIRLA PARA  QUE TUS AMIGOS LA VEAN Y TE APOYEN DÁNDOLE LIKE EN EL LANDING.</p>
		<p style="width: 100%; text-align: center"><a href="https://battimixea.com/galeria?id='.$id.'" style="display: block;"><img src="https://battimixea.com/mailing/btn.png"></a></p>
        </div>
        <div style="width: 600px; margin: 0 auto; background-color: #29a6ce; height: 38px; line-height: 38px; text-align: center; font-family: Arial; font-size: 14px; padding: 0; color: #FFF;">&copy; 2018 / Battimix</div>
    </div>';
    return $html;
}

if(isset($_POST['correo']) && !empty($_POST['correo']) ){

        $data = array();

        $from = new SendGrid\Email('Battimixea', "hola@battimixea.com");
        $subject = "Nueva combinación - Battimixea.com";
        $to = new SendGrid\Email(null, $correo);
        $content = new SendGrid\Content("text/html", Email($nombres, $id, $file));
        $mail = new SendGrid\Mail($from, $subject, $to, $content);

        $apiKey = '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';
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($mail);

        $data[] = array('rpta'=> 'ok', 'correo'=> $correo, 'id'=>$id, 'file'=>$file);
        echo json_encode($data);


}

