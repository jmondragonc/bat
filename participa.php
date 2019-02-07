<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once "inc/config.php";
header("X-XSS-Protection: 0");
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

if(isset($_GET['userid']) && !empty($_GET['userid'])) {
    if(isset($_GET['fbid']) && !empty($_GET['fbid'])){
        $_SESSION['fbid'] = $_GET['fbid'];
    }
    $_SESSION['userid'] = $_GET['userid'];
    header("Location: participa");
}
if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
    $user = DB::queryFirstRow("SELECT * FROM usuario WHERE id=%s", $_SESSION['userid']);
    $counter = DB::count();
}


?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Battimixea - Participa</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <meta property="og:url"                content="https://battimixea.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="Battimixea con Battimix" />
        <meta property="og:description"        content="Diviértete combinando la foto que más te guste y gana premios con BattiMix" />
        <meta property="og:image"              content="https://battimixea.com/fb.png" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="css/component.min.css" />
        <link href="css/cropper.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="js/fullpage/jquery.fullpage.min.css" />
        <link rel="stylesheet" href="fonts/styles.min.css">
        <link type="text/css" href="css/OverlayScrollbars.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.min.css">
    </head>
    <body class="participa">
    <div id=“fb-root”></div>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div id="preloader">
            <div class="imgs">
                <div class="pre">
                    <div class="loader">
                        <div class="bn"></div>
                        <div class="color"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="main">
            <div class="page">
                <div class="header">
                    <div class="info">
                        <a href="./" class="logo"><img src="img/logo.png" alt=""></a>
                        <a href="#" class="burger"></a>
                        <div class="menu">
                            <ul>
                                <li><a href="./">inicio</a></li>
                                <li><a href="participa" class="active">participa</a></li>
                                <li><a href="premios">premios</a></li>
                                <li><a href="productos">productos</a></li>
                                <li><a href="galeria">galería</a></li>
                                <li><a href="mecanica">mecánica</a></li>
                                <li><a href="ganadores">ganadores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="part">
                    <div class="bg">
                        <div class="position-relative">
                            <div class="bg1">
                                <div class="anim anim1"><img src="img/participa-light1.png" alt=""></div>
                            </div>
                            <div class="bg2">
                                <div class="anim anim2"><img src="img/participa-light2.png" alt=""></div>
                            </div>
                            <div class="dots"><img src="img/participa-dots.png" alt=""></div>
                        </div>
                    </div>
                    <div class="info">
                        <div class="formulario">
                            <h1>Regístrate</h1>
                            <div class="prelog row">
                                <div class="col-xs-7 col-sm-7 col-md-9 col-lg-9 txt">Si ya estás registrado ingresa aquí:</div>
                                <div class="col-xs-5 col-sm-5 col-md-3 col-lg-3 user"><a href="#" class="login">LOGIN</a></div>
                            </div>
                            <p class="par">Si aún no Battimixeas con nosotros, ingresa tus datos completos
                                en los siguientes campos.</p>
                            <form name="registro" id="registro" action="" method="post">
                            <div class="form row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="text" class="input shadow" placeholder="NOMBRES Y APELLIDOS" name="nombres" data-valid="required"></div>
                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"><input type="text" class="input-nac shadow" placeholder="FECHA NAC. (dd/mm/aaaa)" name="fechanac" id="fechanac" data-valid="required"></div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><input type="text" class="input-dni shadow" placeholder="DNI" name="dni" id="dni" data-valid="dni"></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="text" class="input shadow" placeholder="CORREO ELECTRÓNICO" name="correo" data-valid="email" ></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="password" class="input shadow" placeholder="CONTRASEÑA" name="password" data-valid="required" ></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="password" class="input shadow" placeholder="REPETIR CONTRASEÑA" name="repassword" data-valid="required" ></div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="#" class="btn">ENVIAR</a></div>
                                <p class="mensaje">El correo ya ha sido registrado</p>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="#" class="btnfb">REGÍSTRATE CON FACEBOOK</a></div>
                                <input type="hidden" name="userid" id="userid">
                            </div>
                            </form>
                        </div>
                        <div class="editarinfo">
                            <h1>Completa tus datos</h1>
                            <p class="par">Ingresa tus datos completos
                                en los siguientes campos.</p>
                            <form name="editar" id="editar" action="" method="post">
                                <div class="form row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><input type="text" class="input shadow" placeholder="NOMBRES Y APELLIDOS" name="nombres_user" data-valid="required" value="<?php echo utf8_encode($user['nombres']); ?>"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"><input type="text" class="input-nac shadow" placeholder="FECHA NAC. (dd/mm/aaaa)" name="fechanac_user" id="fechanac_user" data-valid="required"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"><input type="text" class="input-dni shadow" placeholder="DNI" name="dni_user" id="dni_user" data-valid="dni"></div>
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><a href="#" class="btn">ENVIAR</a></div>
                                    <input type="hidden" name="update" id="update" value="update">
                                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $user['id']; ?>">
                                </div>
                            </form>
                        </div>
                        <div class="paso paso1">
                            <div class="tabs">
                                <div class="tab tab1 active">
                                    <div class="position-relative">
                                        <span>galería superior</span>
                                        <div class="arrow"></div>
                                    </div>
                                </div>
                                <div class="tab tab2">
                                    <div class="position-relative">
                                        <span>galería inferior</span>
                                        <div class="arrow"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="sidebars opacity">
                                <div class="sidebar sidebar1">
                                    <div class="carousel">
                                        <ul>
                                            <li><a href="#"><img src="img/thumb/02_01.jpg" alt="" data-img="02_01.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_02.jpg" alt="" data-img="02_02.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_03.jpg" alt="" data-img="02_03.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_04.jpg" alt="" data-img="02_04.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_05.jpg" alt="" data-img="02_05.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_06.jpg" alt="" data-img="02_06.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_07.jpg" alt="" data-img="02_07.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_08.jpg" alt="" data-img="02_08.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_09.jpg" alt="" data-img="02_09.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_10.jpg" alt="" data-img="02_10.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_11.jpg" alt="" data-img="02_11.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_12.jpg" alt="" data-img="02_12.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_13.jpg" alt="" data-img="02_13.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_14.jpg" alt="" data-img="02_14.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_15.jpg" alt="" data-img="02_15.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_16.jpg" alt="" data-img="02_16.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_18.jpg" alt="" data-img="02_18.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_19.jpg" alt="" data-img="02_19.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_21.jpg" alt="" data-img="02_21.jpg"><span class="over"></span></a></li>
                                            <li><a href="#"><img src="img/thumb/02_22.jpg" alt="" data-img="02_22.jpg"><span class="over"></span></a></li>
                                        </ul>
                                    </div>
                                    <a href="#" class="prev"></a>
                                    <a href="#" class="next"></a>
                                </div>
                                <div class="sidebar sidebar2">
                                <div class="carousel">
                                    <ul>
                                        <li><a href="#">
                                                <img src="img/thumb/thumb_01.jpg" alt="" data-img="01.jpg">
                                                <span class="over"></span>
                                            </a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_02.jpg" alt="" data-img="02.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_03.jpg" alt="" data-img="03.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_04.jpg" alt="" data-img="04.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_05.jpg" alt="" data-img="05.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_06.jpg" alt="" data-img="06.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_07.jpg" alt="" data-img="07.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_08.jpg" alt="" data-img="08.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_09.jpg" alt="" data-img="09.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_10.jpg" alt="" data-img="10.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_11.jpg" alt="" data-img="11.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_12.jpg" alt="" data-img="12.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_13.jpg" alt="" data-img="13.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_14.jpg" alt="" data-img="14.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_15.jpg" alt="" data-img="15.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_16.jpg" alt="" data-img="16.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_17.jpg" alt="" data-img="17.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/thumb_18.jpg" alt="" data-img="18.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/02_17_1.jpg" alt="" data-img="02_17_1.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/02_20_2.jpg" alt="" data-img="02_20_2.jpg"><span class="over"></span></a></li>
                                        <li><a href="#"><img src="img/thumb/02_23_2.jpg" alt="" data-img="02_23_2.jpg"><span class="over"></span></a></li>
                                    </ul>
                                </div>
                                <a href="#" class="prev"></a>
                                <a href="#" class="next"></a>
                            </div>
                            </div>

                            <div class="sidebar-mobile">
                                <div class="content">
                                    <div class="sidebar1">
                                        <div class="carousel">
                                            <ul>
                                                <li><a href="#"><img src="img/thumb/02_01.jpg" alt="" data-img="02_01.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_02.jpg" alt="" data-img="02_02.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_03.jpg" alt="" data-img="02_03.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_04.jpg" alt="" data-img="02_04.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_05.jpg" alt="" data-img="02_05.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_06.jpg" alt="" data-img="02_06.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_07.jpg" alt="" data-img="02_07.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_08.jpg" alt="" data-img="02_08.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_09.jpg" alt="" data-img="02_09.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_10.jpg" alt="" data-img="02_10.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_11.jpg" alt="" data-img="02_11.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_12.jpg" alt="" data-img="02_12.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_13.jpg" alt="" data-img="02_13.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_14.jpg" alt="" data-img="02_14.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_15.jpg" alt="" data-img="02_15.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_16.jpg" alt="" data-img="02_16.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_18.jpg" alt="" data-img="02_18.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_19.jpg" alt="" data-img="02_19.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_21.jpg" alt="" data-img="02_21.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_22.jpg" alt="" data-img="02_22.jpg"><span class="over"></span></a></li>
                                            </ul>
                                        </div>
                                        <a href="#" class="prev"></a>
                                        <a href="#" class="next"></a>
                                    </div>
                                    <div class="sidebar2">
                                        <div class="carousel">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <img src="img/thumb/thumb_01.jpg" alt="" data-img="01.jpg">
                                                        <span class="over"></span>
                                                    </a>
                                                </li>
                                                <li><a href="#"><img src="img/thumb/thumb_02.jpg" alt="" data-img="02.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_03.jpg" alt="" data-img="03.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_04.jpg" alt="" data-img="04.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_05.jpg" alt="" data-img="05.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_06.jpg" alt="" data-img="06.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_07.jpg" alt="" data-img="07.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_08.jpg" alt="" data-img="08.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_09.jpg" alt="" data-img="09.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_10.jpg" alt="" data-img="10.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_11.jpg" alt="" data-img="11.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_12.jpg" alt="" data-img="12.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_13.jpg" alt="" data-img="13.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_14.jpg" alt="" data-img="14.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_15.jpg" alt="" data-img="15.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_16.jpg" alt="" data-img="16.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_17.jpg" alt="" data-img="17.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/thumb_18.jpg" alt="" data-img="18.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_17_1.jpg" alt="" data-img="02_17_1.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_20_2.jpg" alt="" data-img="02_20_2.jpg"><span class="over"></span></a></li>
                                                <li><a href="#"><img src="img/thumb/02_23_2.jpg" alt="" data-img="02_23_2.jpg"><span class="over"></span></a></li>
                                            </ul>
                                        </div>
                                        <a href="#" class="prev"></a>
                                        <a href="#" class="next"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="central">
                                <div class="sup">
                                    <div class="position-relative">
                                        <span class="txt">Haz click en el signo [+] para subir una foto<br>o elige una foto de la galería superior<br>y comienza a battimixear.</span>
                                        <a href="#" class="plus">
                                            <label class="btn-upload" for="inputImage1" title="Subir Imagen">
                                                <input type="file" class="sr-only" id="inputImage1" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                <img src="img/plus.png" alt="Acercar">
                                            </label>
                                        </a>
                                        <div class="img"><img src="" id="pic_top" width="656" height="278"></div>
                                        <div class="tools">
                                            <ul>
                                                <li><a href="#" class="tool upload">
                                                    <label class="btn-upload" for="inputImage1" title="Subir Imagen">
                                                        <input type="file" class="sr-only" id="inputImage1_1" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                        <img src="img/tool5.png?id=<?php echo rand(1, 10); ?>" alt="Acercar">
                                                    </label>
                                                    </a>
                                                </li>
                                                <li class="desktop">Subir</li>
                                                <li class="desktop"><a href="#" class="tool acercar"><img src="img/tool1.png?id=<?php echo rand(1, 10); ?>" alt="Acercar"></a></li>
                                                <li class="desktop"><a href="#" class="tool alejar"><img src="img/tool2.png?id=<?php echo rand(1, 10); ?>" alt="Alejar"></a></li>
                                                <li class="desktop">Ajustar</li>
                                                <li><a href="#" class="tool horario"><img src="img/tool3.png?id=<?php echo rand(1, 10); ?>" alt="Rotar en sentido horario"></a></li>
                                                <li><a href="#" class="tool anti-horario"><img src="img/tool4.png?id=<?php echo rand(1, 10); ?>" alt="Rotar en sentido anti-horario"></a></li>
                                                <li class="desktop">Rotar</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottom">
                                    <div class="position-relative">
                                        <span class="txt">Haz click en el signo [+] para subir una foto<br>o elige una foto de la galería inferior<br>y comienza a battimixear.</span>
                                        <a href="#" class="plus">
                                            <label class="btn-upload" for="inputImage2" title="Subir Imagen">
                                                <input type="file" class="sr-only" id="inputImage2" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                <img src="img/plus.png" alt="Acercar">
                                            </label>
                                        </a>
                                        <div class="img"><img src="" id="pic_bottom" width="656" height="278"></div>
                                    </div>
                                    <div class="tools">
                                        <ul>
                                            <li><a href="#" class="tool upload">
                                                    <label class="btn-upload" for="inputImage2" title="Subir Imagen">
                                                        <input type="file" class="sr-only" id="inputImage2_1" name="file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
                                                        <img src="img/tool5.png?id=<?php echo rand(1, 10); ?>" alt="Acercar">
                                                    </label>
                                                </a>
                                            </li>
                                            <li class="desktop">Subir</li>
                                            <li class="desktop"><a href="#" class="tool acercar"><img src="img/tool1.png?id=<?php echo rand(1, 10); ?>" alt="Acercar"></a></li>
                                            <li class="desktop"><a href="#" class="tool alejar"><img src="img/tool2.png?id=<?php echo rand(1, 10); ?>" alt="Alejar"></a></li>
                                            <li class="desktop">Ajustar</li>
                                            <li><a href="#" class="tool horario"><img src="img/tool3.png?id=<?php echo rand(1, 10); ?>" alt="Rotar en sentido horario"></a></li>
                                            <li><a href="#" class="tool anti-horario"><img src="img/tool4.png?id=<?php echo rand(1, 10); ?>" alt="Rotar en sentido anti-horario"></a></li>
                                            <li class="desktop">Rotar</li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="#" class="crop"><img src="img/crop.png" alt=""></a>
                            </div>

                        </div>
                        <div class="paso paso2"></div>
                    </div>
                </div>

                <div class="footer">
                    <div class="copyright">© 2018  / Battimix    -    <a href="#" class="md-trigger infoad" data-modal="modal-3">Términos y Condiciones</a></div>
                </div>
            </div>
            <div class="md-modal md-effect-8 share-content" id="modal-1">
                <div class="md-content foto_share">
                    <a href="#" class="btnclose md-close"></a>
                    <div class="info">
                        <div class="left"></div>
                        <div class="right">
                            <p>ASÍ QUEDÓ TU COMBINACIÓN,<br><span>¡AHORA SÍ! YA ESTÁS LISTO PARA CONCURSAR</span>.</p>
                            <p>Tu foto está siendo evaluada. Te llegará una notificación vía correo, o revisa la galería para que puedas compartirla.</p>
                            <!--<p class="chk"><label for="terms"><input id="terms" type="checkbox" value="1"> Acepto <a href="#">términos y condiciones</a></label></p>
                            <a href="#" class="btnfb compartir disabled">Compartir en Facebook</a>-->
                            <a href="#" class="btn">SIGUIENTE</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-modal md-effect-8 terms-content" id="modal-3">
                <div class="md-content">
                    <h3>Términos y condiciones</h3>
                    <?php include "tyc.php"; ?>
                    <a href="#" class="btnclose md-close"></a>
                </div>
            </div>
            <div class="md-modal md-effect-8 login-form" id="modal-2">
                <div class="md-content login-content">
                    <a href="#" class="btnclose md-close"></a>
                    <div class="form form1">
                        <h3>Ingreso de usuarios</h3>
                        <form name="login" id="login" action="" method="post">
                            <div class="form">
                                <p><input type="text" class="input shadow" placeholder="CORREO ELECTRÓNICO" name="correo" data-valid="email" ></p>
                                <p><input type="password" class="input shadow" placeholder="CONTRASEÑA" name="password" data-valid="required" ></p>
                                <p><a href="#" class="btn">ENVIAR</a></p>
                                <p class="mensaje">El correo/clave son incorrectos</p>
                                <p><a href="#" class="link">¿Olvidaste tu contraseña?</a></p>
                                <p><a href="#" class="btnfb">INGRESA CON FACEBOOK</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="recuperar">
                        <h3>Recuperar contraseña</h3>
                        <p class="txt">Escribe tu correo electrónico con el cual te registraste:</p>
                        <form name="recuperar" id="recuperar" action="" method="post">
                            <div class="form">
                                <p><input type="text" class="input shadow" placeholder="CORREO ELECTRÓNICO" name="correo" data-valid="email" ></p>
                                <p><a href="#" class="btn">ENVIAR</a></p>
                                <p class="mensaje">El correo no existe en el sistema</p>
                                <p><a href="#" class="back">&laquo; Regresar</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="md-overlay"></div>

        </div>

        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/TweenMax.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollify.js"></script>
        <script type="text/javascript" src="js/fullpage/jquery.fullpage.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/ios-orientationchange-fix.js"></script>
        <script src="js/jquery.jcarousellite.min.js"></script>
        <script src="js/jquery.velocity.min.js"></script>
        <script src="js/jquery.mask.min.js" async></script>
        <script src="js/cropper.js"></script>
        <script type="text/javascript" src="js/OverlayScrollbars.js"></script>
        <script src="js/main.min.js" async></script>
        <script src="js/classie.js"></script>
        <script src="js/modalEffects.js"></script>
        <script>
            // this is important for IEs
            var polyfilter_scriptpath = '/js/';
        </script>
        <script src="js/cssParser.js"></script>
        <script src="js/css-filters-polyfill.js"></script>
        <script>
            jQuery(document).ready(function ($) {
                var image1 = $('#pic_top')[0];
                var image2 = $('#pic_bottom')[0];
                var cropper, cropper2;
                var URL = window.URL || window.webkitURL;
                var $inputImage1 = $('#inputImage1');
                var $inputImage2 = $('#inputImage2');
                var uploadedImageName = 'cropped.jpg';
                var uploadedImageName2 = 'cropped2.jpg';
                var uploadedImageType = 'image/jpeg';
                var uploadedImageURL;
                var uploadedImageURL2;

                function Resize(){

                    if( $('body').hasClass('participa') ){
                        var options = {
                            dragMode: 'move',
                            viewMode: 0,
                            minCropBoxWidth: 656,
                            minCropBoxHeight: 278,
                            minContainerWidth: 656,
                            minContainerHeight: 278,
                            responsive: true,
                            ready: function () {
                                $('#pic_top').css('opacity', 1);
                               //$('#pic_bottom').css('opacity', 1);
                                //this.cropper.move(0, -278).zoom(2);
                            }
                        };

                        var options2 = {
                            dragMode: 'move',
                            viewMode: 0,
                            minCropBoxWidth: 308,
                            minCropBoxHeight: 131,
                            minContainerWidth: 308,
                            minContainerHeight: 131,
                            responsive: true,
                            ready: function () {
                                $('#pic_top').css('opacity', 1);
                                //$('#pic_bottom').css('opacity', 1);
                                //this.cropper.move(0, 0);
                            }
                        };

                        if(cropper){
                            cropper.destroy();
                        }
                        if(cropper2){
                            cropper2.destroy();
                        }

                        if($(window).width()>767){
                            $('#pic_top').attr('width', 656);
                            $('#pic_top').attr('height', 278);
                            $('#pic_bottom').attr('width', 656);
                            $('#pic_bottom').attr('height', 278);

                            cropper = new Cropper($('#pic_top')[0],
                                options
                            );
                            cropper2 = new Cropper($('#pic_bottom')[0],
                                options
                            );
                        }else{
                            $('#pic_top').attr('width', 308);
                            $('#pic_top').attr('height', 131);
                            $('#pic_bottom').attr('width', 308);
                            $('#pic_bottom').attr('height', 131);

                            cropper = new Cropper($('#pic_top')[0],
                                options2
                            );
                            cropper2 = new Cropper($('#pic_bottom')[0],
                                options2
                            );
                        }
                    }
                }

                $(window).on('resize', function () {
                    Resize();
                });

                function paso2(){
                    $('.part .formulario').fadeOut(350, function () {
                        $('.part .paso1').fadeIn(350, function () {

                            $('.sidebar div.carousel').jCarouselLite({
                                btnNext: '.next',
                                btnPrev: '.prev',
                                vertical: true,
                                visible: 4,
                                speed: 300,
                                circular: true
                            });

                            $('.sidebar-mobile div.carousel').jCarouselLite({
                                btnNext: '.next',
                                btnPrev: '.prev',
                                vertical: false,
                                visible: 3,
                                speed: 300,
                                circular: true,
                                responsive: true
                            });

                            $('.part .sidebar-mobile .content').css('opacity', 1);

                            $('.sidebar1 .carousel ul li a').click(function (e) {
                                e.preventDefault();

                                $('.sidebar1 .carousel ul li a').removeClass('active');
                                $(this).addClass('active');

                                var img = $(this).find('img').attr('data-img');
                                $('.central .sup .txt, .central .sup .plus').hide();

                                if($(window).width()>767){
                                    $('.central .sup .img').html('').html('<img src="img/big/'+img+'" id="pic_top" width="656" height="278">');
                                    $('.central .sup .img').show();

                                    cropper = new Cropper($('#pic_top')[0], {
                                        dragMode: 'move',
                                        viewMode: 0,
                                        minCropBoxWidth: 656,
                                        minCropBoxHeight: 278,
                                        minContainerWidth: 656,
                                        minContainerHeight: 278,
                                        ready: function () {
                                            $('#pic_top').css('opacity', 1);
                                            this.cropper.move(0, 0).zoom(2);

                                        }
                                    });
                                }else{
                                    $('.central .sup .img').html('').html('<img src="img/big/'+img+'" id="pic_top" width="308" height="131">');
                                    $('.central .sup .img').show();

                                    cropper = new Cropper($('#pic_top')[0], {
                                        dragMode: 'move',
                                        viewMode: 0,
                                        minCropBoxWidth: 308,
                                        minCropBoxHeight: 131,
                                        minContainerWidth: 308,
                                        minContainerHeight: 131,
                                        ready: function () {
                                            $('#pic_top').css('opacity', 1);
                                            this.cropper.move(0, -131).zoom(2);
                                        }
                                    });
                                }
                            });

                            $('.sidebar2 .carousel ul li a').click(function (e) {
                                e.preventDefault();

                                $('.sidebar2 .carousel ul li a').removeClass('active');
                                $(this).addClass('active');

                                var img = $(this).find('img').attr('data-img');
                                $('.central .bottom .txt, .central .bottom .plus').hide();

                                if($(window).width()>767){

                                $('.central .bottom .img').html('').html('<img src="img/big/'+img+'" id="pic_bottom" width="656" height="278">');
                                $('.central .bottom .img').show();

                                cropper2 = new Cropper($('#pic_bottom')[0], {
                                    dragMode: 'move',
                                    viewMode: 0,
                                    minCropBoxWidth: 656,
                                    minCropBoxHeight: 278,
                                    minContainerWidth: 656,
                                    minContainerHeight: 278,
                                    ready: function () {
                                        $('#pic_bottom').css('opacity', 1);
                                        this.cropper.move(0, 0).zoom(2);
                                    }
                                });
                                }else{
                                    $('.central .bottom .img').html('').html('<img src="img/big/'+img+'" id="pic_bottom" width="308" height="131">');
                                    $('.central .bottom .img').show();
                                    cropper2 = new Cropper($('#pic_bottom')[0], {
                                        dragMode: 'move',
                                        viewMode: 0,
                                        minCropBoxWidth: 308,
                                        minCropBoxHeight: 131,
                                        minContainerWidth: 308,
                                        minContainerHeight: 131,
                                        ready: function () {
                                            $('#pic_bottom').css('opacity', 1);
                                            this.cropper.move(0, -131).zoom(2);

                                        }
                                    });

                                }
                            });

                            $('.central .bottom .acercar').click(function (e) {
                                e.preventDefault();
                                cropper2.zoom(0.1);
                            });
                            $('.central .bottom .alejar').click(function (e) {
                                e.preventDefault();
                                cropper2.zoom(-0.1);
                            });
                            $('.central .bottom .horario').click(function (e) {
                                e.preventDefault();
                                cropper2.rotate(-15);
                            });
                            $('.central .bottom .anti-horario').click(function (e) {
                                e.preventDefault();
                                cropper2.rotate(15);
                            });
                            $('.central .sup .acercar').click(function (e) {
                                e.preventDefault();
                                cropper.zoom(0.1);
                            });
                            $('.central .sup .alejar').click(function (e) {
                                e.preventDefault();
                                cropper.zoom(-0.1);
                            });
                            $('.central .sup .horario').click(function (e) {
                                e.preventDefault();
                                cropper.rotate(-15);
                            });
                            $('.central .sup .anti-horario').click(function (e) {
                                e.preventDefault();
                                cropper.rotate(15);
                            });

                            $('.crop').on('click', function (e) {
                                e.preventDefault();

                                cropper.getCroppedCanvas({ width: 656, height: 278 }).toBlob(function (blob) {

                                    var formData = new FormData();
                                    formData.append('croppedImage', blob);

                                    cropper2.getCroppedCanvas({ width: 656, height: 278 }).toBlob(function (blob) {

                                        formData.append('croppedImage2', blob);
                                        formData.append('userid', $('#userid').val());
                                        var rnd = Math.floor((Math.random() * 1000) + 1);

                                        $.ajax("upload.php?id="+rnd, {
                                            method: "POST",
                                            data: formData,
                                            processData: false,
                                            contentType: false,
                                            success: function (data) {
                                                var file = data.split('|')[0];
                                                var id = data.split('|')[1];

                                                $('#modal-1').addClass('md-show');
                                                $('.foto_share .info .left').html('').html('<img src="img/files/'+file+'" id="foto_'+id+'">');
                                                $('.foto_share .compartir').attr('href', id);
                                                ga('send', 'event', 'Participa', 'Generar Foto', 'Creación exitosa');
                                            },
                                            error: function () {
                                                //alert('Upload error');
                                            }
                                        });
                                    });

                                });
                            });

                            if (URL) {
                                $inputImage1.change(function () {

                                    $('.central .sup .txt, .central .sup .plus').hide();
                                    var files = this.files;
                                    var file;

                                    if (files && files.length) {
                                        file = files[0];

                                        if (/^image\/\w+$/.test(file.type)) {
                                            uploadedImageName = file.name;
                                            uploadedImageType = file.type;

                                            if (uploadedImageURL) {
                                                URL.revokeObjectURL(uploadedImageURL);
                                            }

                                            uploadedImageURL = URL.createObjectURL(file);
                                            if(cropper && cropper!=null){
                                                cropper.destroy();
                                            }

                                            $('#pic_top').attr('src', uploadedImageURL);

                                            if($(window).width()>767){

                                                $('#pic_top').attr('width', 656);
                                                $('#pic_top').attr('height', 278);
                                                cropper = new Cropper( $('#pic_top')[0],
                                                    {
                                                        dragMode: 'move',
                                                        viewMode: 0,
                                                        minCropBoxWidth: 656,
                                                        minCropBoxHeight: 278,
                                                        minContainerWidth: 656,
                                                        minContainerHeight: 278,
                                                        ready: function(event) {
                                                            $('#pic_top').css('opacity', 1);
                                                            //this.cropper.move(0, 0).zoom(1);
                                                        }
                                                    }
                                                );

                                            }else{

                                                $('#pic_top').attr('width', 308);
                                                $('#pic_top').attr('height', 131);
                                                cropper = new Cropper( $('#pic_top')[0],
                                                    {
                                                        dragMode: 'move',
                                                        viewMode: 0,
                                                        minCropBoxWidth: 398,
                                                        minCropBoxHeight: 131,
                                                        minContainerWidth: 308,
                                                        minContainerHeight: 131,
                                                        ready: function(event) {
                                                            $('#pic_top').css('opacity', 1);
                                                            //this.cropper.move(0, 0).zoom(1);
                                                        }
                                                    }
                                                );
                                            }

                                            $inputImage1.val('');

                                            $('.central .sup .img').show();
                                        } else {
                                            //window.alert('Please choose an image file.');
                                        }
                                    }
                                });

                                $inputImage2.change(function () {
                                    $('.central .bottom .txt, .central .bottom .plus').hide();
                                    var files = this.files;
                                    var file;


                                    if (files && files.length) {
                                        file = files[0];

                                        if (/^image\/\w+$/.test(file.type)) {
                                            uploadedImageName2 = file.name;
                                            uploadedImageType = file.type;

                                            if (uploadedImageURL2) {
                                                URL.revokeObjectURL(uploadedImageURL2);
                                            }

                                            uploadedImageURL2 = URL.createObjectURL(file);
                                            if(cropper2 && cropper2!=null){
                                                cropper2.destroy();
                                            }

                                            $('#pic_bottom').attr('src', uploadedImageURL2);

                                            if($(window).width()>767){

                                                $('#pic_bottom').attr('width', 656);
                                                $('#pic_bottom').attr('height', 278);
                                                cropper2 = new Cropper( $('#pic_bottom')[0],
                                                    {
                                                        dragMode: 'move',
                                                        viewMode: 0,
                                                        minCropBoxWidth: 656,
                                                        minCropBoxHeight: 278,
                                                        minContainerWidth: 656,
                                                        minContainerHeight: 278,
                                                        ready: function(event) {
                                                            $('#pic_bottom').css('opacity', 1);
                                                            //this.cropper.move(0, 0).zoom(1);
                                                        }
                                                    }
                                                );

                                            }else{

                                                $('#pic_bottom').attr('width', 308);
                                                $('#pic_bottom').attr('height', 131);
                                                cropper2 = new Cropper( $('#pic_bottom')[0],
                                                    {
                                                        dragMode: 'move',
                                                        viewMode: 0,
                                                        minCropBoxWidth: 398,
                                                        minCropBoxHeight: 131,
                                                        minContainerWidth: 308,
                                                        minContainerHeight: 131,
                                                        ready: function(event) {
                                                            $('#pic_bottom').css('opacity', 1);
                                                            //this.cropper.move(0, 0).zoom(1);
                                                        }
                                                    }
                                                );
                                            }


                                            $inputImage2.val('');

                                            $('.central .bottom .img').show();
                                        } else {
                                            //window.alert('Please choose an image file.');
                                        }
                                    }
                                });
                            } else {
                                $inputImage1.prop('disabled', true).parent().addClass('disabled');
                                $inputImage2.prop('disabled', true).parent().addClass('disabled');
                            }

                        });
                    });
                }
                
                function editInfo() {
                    $('.part .formulario').hide();
                    $('.part .editarinfo').show();

                    $('.editarinfo .form .btn').click(function (e) {
                        e.preventDefault();

                        var $this = $(this);
                        var $form = $this.closest("form");

                        $data = $form.serialize();
                        $form.validate();

                        $('.editarinfo .form .btn').addClass('disabled').html('ENVIANDO...');

                        if ($form.validate()) {

                            $.ajax({
                                url: "registro.php",
                                type: "POST",
                                data: $data,
                                dataType: 'json',
                                beforeSend: function (xhr, settings) {

                                },
                                success: function (data) {

                                    if(data[0].rpta=='ok'){
                                        $('#userid').val(data[0].id);
                                        ga('send', 'event', 'Participa', 'Respuesta', 'Actualización de datos');
                                        $('.editarinfo .form .btn').removeClass('disabled').html('Enviar');
                                        $('.editarinfo').fadeOut(350);
                                        paso2();
                                    }
                                },
                                error: function (jqXHR, exception, response) {
                                    $('.form .btn').removeClass('disabled').html('Enviar');
                                }
                            });

                        }

                    });
                }
                //paso2();
                <?php if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){?>
                $(window).on('load', function () {
                    $('#userid').val('<?php echo $_SESSION['userid']; ?>');
                    <?php if($user['dni']==''){ ?>
                    editInfo();
                    <?php } else {?>
                    paso2();
                    <?php } ?>
                    fbShare();
                });
                <?php } ?>

                function fbShare() {

                    function statusChangeCallback(response) {

                        if (response.status === 'connected') {


                        } else {
                            var fbuid = response.authResponse.userID;

                            FB.api('/me', {locale: 'es_ES', fields: 'name, email, link'},
                                function (response) {
                                    $.ajax("registro.php", {
                                        method: "POST",
                                        data: 'fb=ok&nombres=' + response.name + '&correo=' + response.email + '&fbuid=' + fbuid+'&link='+link,
                                        dataType: 'json',
                                        success: function (data) {
                                            ga('send', 'event', 'Participa', 'Inicio de sesión', 'Facebook');
                                            $('#userid').val(data[0].id);
                                        },
                                        error: function () {

                                        }
                                    });
                                }
                            );
                        }
                    }

                    window.fbAsyncInit = function () {
                        FB.init({
                            appId: '160121611358960',
                            cookie: true,
                            xfbml: true,
                            version: 'v2.8'
                        });

                        FB.getLoginStatus(function (response) {
                            statusChangeCallback(response);
                        });

                        $('.compartir').click(function (e) {
                            e.preventDefault();
                            var id = $(this).attr('href');
                            var file = $('#foto_' + id).attr('src').split('img/files/')[1];
                            var title = 'Battimixea con Battimix';
                            var desc = 'DIVIERTE COMBINANDO LA FOTO QUE MÁS TE GUSTE Y GANA PREMIOS CON BATTIMIX.';
                            var link = 'https://battimixea.com/galeria?id=' + id;
                            FB.ui({
                                    method: 'share_open_graph',
                                    action_type: 'og.shares',
                                    action_properties: JSON.stringify({
                                        object: {
                                            'og:url': link,
                                            'og:title': title,
                                            'og:description': desc,
                                            'og:image': "http://battimixea.com/img/files/" + file
                                        }
                                    })
                                },
                                function (response) {
                                    if (response && !response.error_message) {
                                        ga('send', 'event', 'Participa', 'Compartir Foto', 'Facebook');

                                    } else {

                                    }
                                }
                            );

                        });

                    };

                    (function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "https://connect.facebook.net/en_US/sdk.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));

                }

                $('#terms').change(function () {
                    var ischecked= $(this).is(':checked');
                    if(!ischecked){
                        $(this).val(0);
                        $('.compartir').addClass('disabled');
                    }else{
                        $(this).val(1);
                        $('.compartir').removeClass('disabled');
                    }

                });
                $('#terms').overlayScrollbars({
                    overflowBehavior : {
                        x : "hidden",
                        y : "scroll"
                    },
                });

    });
        </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-115989753-1"></script>
    <script>
        window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
        ga('create','UA-115989753-1','auto');ga('send','pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <script>
        jQuery(document).ready(function ($) {
            $('.participa #modal-1 .btnclose').click(function (e) {
                e.preventDefault();
                location.reload();
            });
        })
    </script>
    </body>

</html>
