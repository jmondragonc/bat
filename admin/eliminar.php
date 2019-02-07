<?php
session_start();
require_once("../inc/config.php");
if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {

    if (isset($_GET['form']) && !empty($_GET['form'])) {
        $value = $_GET['id'];
        DB::update('imagen',
            array(
                'status' => 2
            ), "id=%i", $value);

       header("Location: usuarios.php");
    }

}
?>