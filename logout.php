<?php session_start();
/**
 * Created by PhpStorm.
 * User: mondr
 * Date: 17/03/2018
 * Time: 14:40
 */
unset($_SESSION['userid']);
unset($_SESSION['fbid']);
session_destroy();
header("Location: index");