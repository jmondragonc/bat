<?php

require_once "inc/config.php";

if(!isset($_POST['fb']) && !isset($_POST['vote']) && !isset($_POST['update'])){
    $nombres = (utf8_decode($_POST['nombres']));
    $password = ($_POST['password']);
    $dni = ($_POST['dni']);
    $fechanac = explode('/', $_POST['fechanac']);
    $fecha_nac = $fechanac[2].'-'.$fechanac[1].'-'.$fechanac[0];
    $correo = ($_POST['correo']);
    if(isset($_POST['nombres']) && !empty($_POST['nombres']) && isset($_POST['correo']) && !empty($_POST['correo']) && isset($_POST['fechanac']) && !empty($_POST['fechanac']) && isset($_POST['password']) && !empty($_POST['password'])){

        $user = DB::queryFirstRow("SELECT id, correo FROM usuario WHERE correo=%s", $correo);

        $counter = DB::count();

        if($counter==0){
            DB::insert('usuario', array(
                'nombres' => $nombres,
                'fechanac' => $fecha_nac,
                'dni' => $dni,
                'correo' => $correo,
                'clave' => $password,
                'fechareg' => DB::sqleval("NOW()")
            ));

            $id = DB::insertId();
            $data = array();
            $data[] = array('rpta'=> 'ok', 'id'=> $id);
            echo json_encode($data);
        }else{
            $data = array();
            $data[] = array('rpta'=> 'ya', 'id'=> $user['id']);
            echo json_encode($data);
        }

    }
}

if( !isset($_POST['update']) && isset($_POST['fb']) && $_POST['fb']=='ok' && isset($_POST['nombres']) && !empty($_POST['nombres']) && isset($_POST['correo']) && !empty($_POST['correo'])  && isset($_POST['fbuid']) && !empty($_POST['fbuid']) ){
    $nombres = utf8_decode($_POST['nombres']);
    $correo = $_POST['correo'];
    $fbid = $_POST['fbuid'];
    $link = $_POST['link'];

    $user = DB::queryFirstRow("SELECT id, fbid, correo FROM usuario WHERE correo=%s OR fbid=%s ", $correo, $fbid);

    $counter = DB::count();

    if($counter==0){
        DB::insert('usuario', array(
            'nombres' => $nombres,
            'correo' => $correo,
            'fbid' => $fbid,
            'fburl' => $link,
            'fechareg' => DB::sqleval("NOW()")
        ));

        $id = DB::insertId();
        $data = array();
        $data[] = array('rpta'=> 'ok', 'id'=> $id);
        echo json_encode($data);
    }else{
        $id = $user['id'];
        DB::update('usuario',
            array(
            'fbid' => $fbid,
            'fburl' => $link,
            ), "id=%s", $id);
        $data = array();
        $data[] = array('rpta'=> 'ok', 'id'=> $id);
        echo json_encode($data);
    }

}

if( isset($_POST['vote']) && $_POST['vote']=='ok' && isset($_POST['imgid']) && !empty($_POST['imgid']) && isset($_POST['fbuid']) && !empty($_POST['fbuid']) && !isset($_POST['update'])){
    $nombres = utf8_decode($_POST['nombres']);
    $correo = $_POST['correo'];
    $fbid = $_POST['fbuid'];
    $link = $_POST['link'];
    $imgid = $_POST['imgid'];

    $user = DB::queryFirstRow("SELECT id, fbid, correo FROM usuario WHERE correo=%s OR fbid=%s ", $correo, $fbid);
    $counter = DB::count();
    $id='';

    if($counter==0){
        DB::insert('usuario', array(
            'nombres' => $nombres,
            'correo' => $correo,
            'fbid' => $fbid,
            'fburl' => $link,
            'fechareg' => DB::sqleval("NOW()")
        ));
        $id = DB::insertId();
    }else{
        $id = $user['id'];
        DB::update('usuario',
            array(
                'fbid' => $fbid,
                'fburl' => $link
            ), "id=%s", $id);
    }

    DB::queryFirstRow("SELECT id, imgid FROM voto WHERE imgid=%s AND userid=%s", $imgid, $id);
    $counterimg = DB::count();

    if($counterimg==0){
        DB::insert('voto', array(
            'userid' => $id,
            'imgid' => $imgid,
            'fecha' => DB::sqleval("NOW()")
        ));
    }

    DB::query("SELECT id, imgid FROM voto WHERE imgid=%s", $imgid);
    $counterv = DB::count();

    DB::update('imagen',
        array(
            'votos' => $counterv
        ), "id=%s", $imgid);

    $data = array();
    $data[] = array('rpta'=> 'ok', 'votos'=>$counterv, 'id'=>$id);
    echo json_encode($data);
}

if(isset($_POST['update']) && $_POST['update']=='update'){
    $nombres = $_POST['nombres_user'];
    $id = $_POST['id_user'];
    $dni = $_POST['dni_user'];
    $fechanac = explode('/', $_POST['fechanac_user']);
    $fecha_nac = $fechanac[2].'-'.$fechanac[1].'-'.$fechanac[0];

    DB::update('usuario',
        array(
            'nombres' => $nombres,
            'fechanac' => $fecha_nac,
            'dni' => $dni
        ), "id=%s", $id);

    $data = array();
    $data[] = array('rpta'=> 'ok', 'id'=>$id);
    echo json_encode($data);
}