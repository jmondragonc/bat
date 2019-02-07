<?php session_start();
header("X-XSS-Protection: 0");
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');

require_once "inc/config.php";

if(isset($_GET['fbid']) && !empty($_GET['fbid']) && isset($_GET['userid']) && !empty($_GET['userid'])){
    $_SESSION['fbid'] = $_GET['fbid'];
    $_SESSION['userid'] = $_GET['userid'];
    if(isset($_GET['page']) && !empty($_GET['page'])){
        header("Location: participantes?page=".$_GET['page']);
    }else{
        header("Location: participantes");
    }

}
if(isset($_GET['id']) && !empty($_GET['id'])){
    if(isset($_SESSION['userid'])){
        $compartir = DB::queryFirstRow("SELECT *, (select count(*) FROM voto v WHERE v.imgid=i.id) AS totalvotos, 
        (select count(*) from voto v WHERE v.imgid=i.id AND v.userid=" . $_SESSION['userid'] . ") as yavoto,
        i.id as idimg 
        FROM imagen i 
        INNER JOIN usuario u on u.id = i.userid 
        WHERE i.status=1 AND i.id=%i ", $_GET['id']);
    }else{
        $compartir = DB::queryFirstRow("SELECT *, (select count(*) FROM voto v WHERE v.imgid=i.id) AS totalvotos, 
        i.id as idimg 
        FROM imagen i 
        INNER JOIN usuario u on u.id = i.userid 
        WHERE i.status=1 AND i.id=%i ", $_GET['id']);
    }

}

$imgs = DB::query("SELECT * FROM imagen WHERE status=%i AND ISNULL(yaparticipo)", 1);
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

if(isset($_SESSION['userid'])){
    if(!isset($_POST['buscar'])){
        if(isset($_GET['rnk']) && !empty($_GET['rnk'])){
            $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
                (select count(*) from voto v WHERE v.imgid=i.id AND v.userid=" . $_SESSION['userid'] . ") as yavoto,
                i.id as idimg 
                FROM imagen i
                INNER JOIN usuario u on u.id = i.userid 
                WHERE i.status=%i ORDER BY totalvotos DESC, i.fecha ASC 
                LIMIT $offset, $rowsperpage", 1);
            $counter_res =  DB::count();
        } else {
            $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
                (select count(*) from voto v WHERE v.imgid=i.id AND v.userid=" . $_SESSION['userid'] . ") as yavoto,
                i.id as idimg 
                FROM imagen i
                INNER JOIN usuario u on u.id = i.userid 
                WHERE i.status=%i 
                LIMIT $offset, $rowsperpage", 1);
            $counter_res =  DB::count();
        }
        $user = DB::queryFirstRow("SELECT * FROM usuario WHERE id=%s", $_SESSION['userid']);
    }else{
        $query_string = '';
        $words = explode(" ", $_POST["buscar"]);
        for ($i=0;$i<count($words);$i++){
            $query_string .=  "LIKE '%".$words[$i]."%' OR u.correo LIKE '%".$words[$i]."%' OR u.nombres ";
        }

        $query_string = substr($query_string,0,strlen($query_string)-13);

        $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
            (select count(*) from voto v WHERE v.imgid=i.id AND v.userid=" . $_SESSION['userid'] . ") as yavoto,
            i.id as idimg 
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE i.status=%i AND u.nombres ".$query_string."
            LIMIT $offset, $rowsperpage", 1);
        $counter_res =  DB::count();
        $user = DB::queryFirstRow("SELECT * FROM usuario WHERE id=%s", $_SESSION['userid']);
    }
}else{
    if(isset($_GET['rnk']) && !empty($_GET['rnk'])){
        $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
            i.id as idimg 
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE i.status=%i ORDER BY totalvotos DESC, i.fecha ASC 
            LIMIT $offset, $rowsperpage", 1);
        $counter_res =  DB::count();
    } else {
        if(isset($_POST['buscar'])) {
            $query_string = '';
            $words = explode(" ", ucwords($_POST["buscar"]));
            for ($i=0;$i<count($words);$i++){
                $query_string .=  "LIKE '%".$words[$i]."%' OR u.correo LIKE '%".$words[$i]."%' OR u.nombres ";
            }

            $query_string = substr($query_string,0,strlen($query_string)-13);

            $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
            i.id as idimg 
            FROM imagen i
            INNER JOIN usuario u on u.id = i.userid 
            WHERE i.status=%i AND u.nombres ".$query_string."
            LIMIT $offset, $rowsperpage", 1);
            $counter_res =  DB::count();
            $user = DB::queryFirstRow("SELECT * FROM usuario WHERE id=%s", $_SESSION['userid']);
        } else {
            $results = DB::query("SELECT *, (select count(*) from voto v WHERE v.imgid=i.id) AS totalvotos, 
                i.id as idimg 
                FROM imagen i
                INNER JOIN usuario u on u.id = i.userid 
                WHERE i.status=%i 
                LIMIT $offset, $rowsperpage", 1);
            $counter_res =  DB::count();
        }
    }
}
$range = 3;
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Battimixea - Galería</title>
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
        <link rel="stylesheet" type="text/css" href="js/fullpage/jquery.fullpage.min.css" />
        <link rel="stylesheet" href="fonts/styles.min.css">
        <link type="text/css" href="css/OverlayScrollbars.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.min.css">
    </head>
    <body class="galeria">
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
                                <li><a href="participa">participa</a></li>
                                <li><a href="premios">premios</a></li>
                                <li><a href="productos">productos</a></li>
                                <li><a href="galeria" class="active">galería</a></li>
                                <li><a href="mecanica">mecánica</a></li>
                                <li><a href="ganadores">ganadores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="gal">
                    <div class="info">
                        <h1>Ellos ya Battimixearon con Battimix</h1>
                        <div class="row head">
                            <div class="col-xs-5 col-sm-5 mobile">
                                <select name="orden" id="orden">
                                    <option value="-">Ordenar por</option>
                                    <option value="0" <?php if( !isset($_GET['rnk']) ){ echo 'SELECTED'; } ?>>Por orden de Ingreso</option>
                                    <option value="1" <?php if( isset($_GET['rnk']) && $_GET['rnk']=='ok' ){ echo 'SELECTED'; } ?>>Top ranking</option>
                                </select>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 desktop"><a href="participantes" class="ltop<?php if( !isset($_GET['rnk']) ){ echo ' active'; } ?>">ORDEN DE INGRESO</a></div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 desktop"><a href="participantes?rnk=ok" class="ltop<?php if( isset($_GET['rnk']) && $_GET['rnk']=='ok' ){ echo ' active'; } ?>">TOP RANKING</a></div>
                            <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 desktop"><!--<a href="#" class="btn">ver GANADORES</a>--></div>
                            <div class="col-xs-7 col-sm-7 col-md-3 col-lg-3"><form name="busqueda" id="busqueda" action="galeria" method="post"><input type="text" class="search" name="buscar" id="buscar" value="<?php if(isset($_POST['buscar']) && $_POST['buscar']!='' ){ echo $_POST['buscar']; } ?>"><input type="image" src="img/icosearch.jpg" class="imgsearch" name="search" width="36" height="36" alt="Buscar">
                                </form></div>
                        </div>
                        <div class="row items">

                            <?php
                                if($counter_res>0){
                                    foreach($results as $img){
                            ?>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="item" id="item_<?php echo $img['idimg']; ?>">
                                    <div class="img"><a href="<?php echo $img['idimg']; ?>"><img src="<?php echo $img['file']; ?>" alt="" width="350" height="297"></a></div>
                                    <div class="desc"><span class="nombre"><?php echo utf8_encode(ucwords(strtolower($img['nombres']))); ?></span>
                                        <?php if( isset($_SESSION['userid']) ){
                                            if($img['yavoto']>0){?>
                                                <div class="voto session yavoto"><span class="nro-votos"><?php echo $img['totalvotos'];?></span></div>
                                            <?php } else {?>
                                                <a href="<?php echo $img['idimg']; ?>" class="voto session novoto"><span class="nro-votos"><?php echo $img['totalvotos'];?></span></a>
                                            <?php }
                                        } else {?>
                                        <a href="<?php echo $img['idimg']; ?>" class="voto nologin"><span class="nro-votos"><?php echo $img['totalvotos'];?></span></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                    }
                                } else { echo '<p class="noresults">No se encontraron resultados.</p>'; }
                            ?>
                        </div>
                        <div class="row pagination">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <?php if ($currentpage > 1) {
                                        //echo " <a href='{$_SERVER['PHP_SELF']}?page=1'><<</a> ";
                                        $prevpage = $currentpage - 1;
                                        echo " <a href='{$_SERVER['PHP_SELF']}?page=$prevpage' class='pageprev'></a> ";
                                    } ?>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <?php
                                    for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
                                        if (($x > 0) && ($x <= $totalpages)) {
                                            if ($x == $currentpage) {
                                                echo " <span class='curpage'><sup>$x</sup> / <sub>$totalpages</sub></span>";
                                            } else {
                                                //echo " <a href='{$_SERVER['PHP_SELF']}?page=$x'>$x</a> ";
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                    <?php
                                    if ($currentpage != $totalpages) {
                                        $nextpage = $currentpage + 1;
                                        if($totalpages>1){
                                            echo " <a href='{$_SERVER['PHP_SELF']}?page=$nextpage' class='pagenext'></a> ";
                                            //echo " <a href='{$_SERVER['PHP_SELF']}?page=$totalpages'>>></a> ";
                                        }

                                    }
                                    ?>
                                </div>

                        </div>
                    </div>
                    <div class="footer">
                        <div class="copyright">© 2018  / Battimix    -    <a href="#" class="md-trigger infoad" data-modal="modal-2">Términos y Condiciones</a></div>
                    </div>

                </div>


            </div>

            <div class="md-modal md-effect-3 compartir-content" id="modal-1">
                <div class="md-content">
                    <a href="#" class="btnclose md-close"></a>
                    <div class="info">
                        <img src="" id="compartir_foto" width="656" height="556">
                        <div class="desc row">
                            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 nombre"><?php echo utf8_encode($compartir['nombres']);?></div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 votos">
                                <?php if( isset($_SESSION['userid']) ){
                                    if($compartir['yavoto']>0){?>
                                        <div class="voto"><span class="nro-votos"><?php echo $compartir['totalvotos'];?></span></div>
                                    <?php } else {?>
                                        <a href="<?php echo $compartir['idimg']; ?>" class="voto"><span class="nro-votos"><?php echo $compartir['totalvotos'];?></span></a>
                                    <?php }
                                } else {?>
                                    <a href="<?php echo $compartir['idimg']; ?>" class="voto"><span class="nro-votos"><?php echo $compartir['totalvotos'];?></span></a>
                                <?php } ?>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 btn"><a href="#" class="btnfb btnfb1">compartir en facebook</a><a href="#" class="btnfb btnfb2">compartir en facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md-modal md-effect-8 terms-content" id="modal-2">
                <div class="md-content">
                    <h3>Términos y condiciones</h3>
                    <?php include "tyc.php"; ?>
                    <a href="#" class="btnclose md-close"></a>
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
        <script type="text/javascript" src="js/OverlayScrollbars.js"></script>
        <script src="js/main.js" async></script>
        <script src="js/classie.js"></script>
        <script src="js/modalEffects.js"></script>
        <script>
            var polyfilter_scriptpath = '/js/';

            jQuery(document).ready(function ($) {

                //Votos sin Login
                window.fbAsyncInit = function() {
                    FB.init({
                        appId      : '160121611358960',
                        cookie     : true,
                        xfbml      : true,
                        version    : 'v2.8'
                    });

                    function  FBLogin(id) {
                        FB.login(function(response) {
                            var fbuid = response.authResponse.userID;
                            if (response.status === 'connected') {
                                FB.api('/me', { locale: 'es_ES', fields: 'name, email, link' },
                                    function(response) {
                                        <?php
                                        $page = '';
                                        if(isset($_GET['page']) && !isset($_SESSION['userid'])){
                                            $page = '?page='.$_GET['page'].'&';
                                        } else {
                                            $page = '?';
                                        }
                                        ?>

                                        //var page = '<?php echo $page; ?>';
                                        $.ajax("registro.php", {
                                            method: "POST",
                                            data: 'vote=ok&nombres='+response.name+'&correo='+response.email+'&fbuid='+fbuid+'&imgid='+id+'&link='+response.link,
                                            dataType: 'json',
                                            success: function (data) {
                                                var id = data[0].id;
                                                var votos = data[0].votos;
                                                if(data[0].rpta=='ok'){
                                                    $('.compartir-content .desc .votos').html('<div class="voto"><span class="nro-votos">'+votos+'</span></div>');
                                                }
                                                setTimeout(function(){location.reload();}, 1000);
                                                //window.location.href = '/galeria'+page+'fbid='+fbuid+'&userid='+id;
                                            },
                                            error: function () {

                                            }
                                        });

                                    }
                                );
                            } else {

                            }
                        }, {scope: 'public_profile,email'});
                    }

                    function  FBLoginID(img) {
                        FB.login(function(response) {
                            var fbuid = response.authResponse.userID;
                            if (response.status === 'connected') {
                                FB.api('/me', { locale: 'es_ES', fields: 'name, email, link' },
                                    function(response) {
                                        <?php
                                        $id = '';
                                        if(isset($_GET['id']) && !isset($_SESSION['userid'])){
                                            $id = '?id='.$_GET['id'].'&';
                                        } else {
                                            $id = '?';
                                        }
                                        ?>
                                        var id = '<?php echo $id; ?>';
                                        $.ajax("registro.php", {
                                            method: "POST",
                                            data: 'vote=ok&nombres='+response.name+'&correo='+response.email+'&fbuid='+fbuid+'&imgid='+img+'&link='+response.link,
                                            dataType: 'json',
                                            success: function (data) {
                                                var id = data[0].id;
                                                var votos = data[0].votos;
                                                if(data[0].rpta=='ok'){
                                                    $('.compartir-content .desc .votos').html('<div class="voto"><span class="nro-votos">'+votos+'</span></div>');
                                                }
                                                setTimeout(function(){location.reload();}, 1000);
                                                //window.location.href = '/galeria'+page+'fbid='+fbuid+'&userid='+id;
                                            },
                                            error: function () {

                                            }
                                        });

                                    }
                                );
                            } else {

                            }
                        }, {scope: 'public_profile,email'});
                    }

                    function fVote(id){
                        FB.login(function(response) {
                            var fbuid = response.authResponse.userID;
                            if (response.status === 'connected') {
                                FB.api('/me', { locale: 'es_ES', fields: 'name, email, link' },
                                    function(response) {
                                        <?php
                                        $page = '';
                                        if(isset($_GET['page']) && !isset($_SESSION['userid'])){
                                            $page = '?page='.$_GET['page'].'&';
                                        } else {
                                            $page = '?';
                                        }
                                        ?>

                                        var page = '<?php echo $page; ?>';
                                        $.ajax("registro.php", {
                                            method: "POST",
                                            data: 'vote=ok&nombres='+response.name+'&correo='+response.email+'&fbuid='+fbuid+'&imgid='+id+'&link='+response.link,
                                            dataType: 'json',
                                            success: function (data) {
                                                var id = data[0].id;
                                                var votos = data[0].votos;
                                                if(data[0].rpta=='ok'){
                                                    $('#item_'+id+' .desc .voto').remove();
                                                    $('#item_'+id+' .desc').append('<div class="voto"><span class="nro-votos">'+votos+'</span></div>');
                                                }
                                                //setTimeout(function(){location.reload();}, 1000);
                                                window.location.href = '/galeria'+page+'fbid='+fbuid+'&userid='+id;
                                            },
                                            error: function () {

                                            }
                                        });

                                    }
                                );
                            } else {

                            }
                        }, {scope: 'public_profile,email'});
                    }

                    $('.item .voto').click(function (e) {
                        e.preventDefault();
                        var id = $(this).attr('href');
                        <?php if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){?>
                        fVoteUser(id);
                        <?php } else {?>
                        fVote(id);
                        <?php } ?>
                    });

                    $('.item .img a').click(function (e) {
                        e.preventDefault();
                        var id = $(this).attr('href');
                        var file = $(this).find('img').attr('src');
                        var nombres = $('#item_'+id).find('.nombre').text();
                        var nro_votos = $('#item_'+id).find('.nro-votos').text();
                        if($('#item_'+id).find('.voto').hasClass('nologin')){
                            $('.compartir-content .desc .votos').html('<a href="'+id+'" class="voto"><span class="nro-votos">'+nro_votos+'</span></a>');
                        }
                        if($('#item_'+id).find('.voto').hasClass('yavoto')){
                            $('.compartir-content .desc .votos').html('<div class="voto"><span class="nro-votos">'+nro_votos+'</span></div>');
                        }
                        if($('#item_'+id).find('.voto').hasClass('novoto')){
                            $('.compartir-content .desc .votos').html('<a href="'+id+'" class="voto"><span class="nro-votos">'+nro_votos+'</span></a>');
                        }

                        $('#compartir_foto').attr('src', file);
                        $('.compartir-content .desc .nombre').html(nombres);
                        $('.compartir-content .desc .nro-votos').html(nro_votos);
                        $('.compartir-content .desc .btnfb2').hide();
                        $('.compartir-content .desc .btnfb1').show();
                        $('#modal-1').addClass('md-show');


                        $('.compartir-content .desc a.voto').click(function (e) {
                            e.preventDefault();
                            var id = $(this).attr('href');
                            FBLogin(id);
                        });

                        $('.compartir-content .desc .btnfb1').click(function (e) {
                            e.preventDefault();
                            var img = file;
                            var id = id;
                            var file2 = img.split('img/files/')[1];
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
                                            'og:image': "http://battimixea.com/img/files/" + file2
                                        }
                                    })
                                },
                                function (response) {
                                    if (response && !response.error_message) {


                                    } else {

                                    }
                                }
                            );
                        });

                    });

                    //Con ID
                    <?php if(isset($_GET['id']) && !empty($_GET['id'])){?>
                    $('#modal-1').addClass('md-show');
                    var imgshare = '<?php echo $compartir['file']; ?>';
                    $('#compartir_foto').attr('src', imgshare);
                    $('.compartir-content .desc a.voto').click(function (e) {
                        e.preventDefault();
                        FBLoginID(<?php echo $_GET['id']; ?>);
                    });
                    $('.compartir-content .desc .btnfb1').hide();
                    $('.compartir-content .desc .btnfb2').css('display', 'block').click(function (e) {
                        e.preventDefault();
                        var img = imgshare;
                        var id = id;
                        var file2 = img.split('img/files/')[1];
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
                                        'og:image': "http://battimixea.com/img/files/" + file2
                                    }
                                })
                            },
                            function (response) {
                                if (response && !response.error_message) {


                                } else {

                                }
                            }
                        );
                    });
                    <?php } ?>
                    //Fin con ID

                };

                (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
                    js.src = "https://connect.facebook.net/en_US/sdk.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
                //Fin Votos sin login

                <?php if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])){?>
                function fVoteUser(img){
                    $.ajax("registro.php", {
                        method: "POST",
                        data: 'vote=ok&nombres=<?php echo $user['nombres']; ?>&correo=<?php echo $user['correo']; ?>&fbuid=<?php echo $_SESSION['fbid']; ?>&imgid='+img,
                        dataType: 'json',
                        success: function (data) {

                            if(data[0].rpta=='ok'){
                                $('#item_'+img+' .desc .voto').remove();
                                $('#item_'+img+' .desc').append('<div class="voto"><span class="nro-votos">'+data[0].votos+'</span></div>');
                            }
                        },
                        error: function () {

                        }
                    });
                }
                <?php } ?>

                $('#terms').overlayScrollbars({
                    overflowBehavior : {
                        x : "hidden",
                        y : "scroll"
                    },
                });
            });

        </script>
        <script src="js/cssParser.js"></script>
        <script src="js/css-filters-polyfill.js"></script>

        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-115989753-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    </body>

</html>
