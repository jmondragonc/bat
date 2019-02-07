<?php session_start();
header("X-XSS-Protection: 0");
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Battimixea - Productos</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:url"                content="https://battimixea.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="Battimixea con Battimix" />
        <meta property="og:description"        content="Diviértete combinando la foto que más te guste y gana premios con BattiMix" />
        <meta property="og:image"              content="https://battimixea.com/fb.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#da532c">
        <meta name="theme-color" content="#ffffff">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" href="js/owl/assets/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="css/component.min.css" />
        <link rel="stylesheet" type="text/css" href="js/fullpage/jquery.fullpage.min.css" />
        <link rel="stylesheet" href="fonts/styles.min.css">
        <link type="text/css" href="css/OverlayScrollbars.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.min.css">
    </head>
    <body class="productos">
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

        <div id="preloader">
            <div class="imgs">
                <div class="pre">
                    <div class="loader">
                        <div class="bn"></div>
                        <div class="color"></div>
                        <progress id="loader" max="19" value="0" style="display: none;"></progress>
                    </div>

                </div>
            </div>
        </div>

        <div class="main">
            <div class="producto desktop">
                <div class="header">
                    <div class="info">
                        <a href="./" class="logo"><img src="img/logo.png" alt=""></a>
                        <a href="#" class="burger"></a>
                        <div class="menu">
                            <ul>
                                <li><a href="./">inicio</a></li>
                                <li><a href="participa">participa</a></li>
                                <li><a href="premios">premios</a></li>
                                <li><a href="productos" class="active">productos</a></li>
                                <li><a href="galeria">galería</a></li>
                                <li><a href="mecanica">mecánica</a></li>
                                <li><a href="ganadores">ganadores</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="content prod1">
                    <div class="bg bg1"></div>
                    <div class="bg bg2"></div>
                    <div class="bg bg3"></div>
                    <div class="bg bg4"></div>
                    <div class="info">
                        <div class="light light1">
                            <div class="anim anim1"><img src="img/light_1-1.png" alt=""></div>
                        </div>
                        <div class="light light2">
                            <div class="anim anim2"><img src="img/light_1-1.png" alt=""></div>
                        </div>
                        <div class="light light3">
                            <div class="anim anim3"><img src="img/light_3-1.png" alt=""></div>
                        </div>
                        <div class="light light4">
                            <div class="anim anim4"><img src="img/light_4-1.png" alt=""></div>
                        </div>
                        <div class="dots dots1"></div>
                        <div class="dots dots2"></div>
                        <div class="dots dots3"></div>
                        <div class="dots dots4"></div>
                        <div class="imagen envase envase1">
                            <div class="position-relative">
                                <div class="izq"><img src="img/bg-prod-battimix1-1.png" alt=""></div>
                                <div class="der"><img src="img/bg-prod-battimix1-2.png" alt=""></div>
                                <div class="batt"><img src="img/prod-battimix1.png" alt=""></div>
                            </div>
                        </div>
                        <div class="imagen envase envase2">
                            <div class="position-relative">
                                <div class="izq"><img src="img/bg-prod-battimix2-1.png" alt=""></div>
                                <div class="der"><img src="img/bg-prod-battimix2-2.png" alt=""></div>
                                <div class="batt"><img src="img/prod-battimix2.png" alt=""></div>
                            </div>
                        </div>
                        <div class="imagen envase envase3">
                            <div class="position-relative">
                                <div class="izq"><img src="img/bg-prod-battimix3-1.png" alt=""></div>
                                <div class="der"><img src="img/bg-prod-battimix3-2.png" alt=""></div>
                                <div class="batt"><img src="img/prod-battimix3.png" alt=""></div>
                            </div>
                        </div>
                        <div class="imagen envase envase4">
                            <div class="position-relative">
                                <div class="izq"><img src="img/bg-prod-battimix4-1.png" alt=""></div>
                                <div class="der"><img src="img/bg-prod-battimix4-2.png" alt=""></div>
                                <div class="batt"><img src="img/prod-battimix4.png" alt=""></div>
                            </div>
                        </div>

                        <div class="texto texto1">
                            <span class="title">yogurt batido sabor<br>
                            natural con hojuelas<br>
                            azucaradas.</span>
                            <a href="#" class="md-trigger infoad" data-modal="modal-1">información nutricional</a>
                            <div class="frame">
                                <div class="sup"></div>
                                <div class="inf"></div>
                                <div class="parent txt">
                                    <div class="child">
                                        <h1>Hojuelas azucaradas</h1>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="md-trigger btnplay btnplay1" data-modal="modal-2"><span>VER COMERCIAL</span></a>
                        </div>
                        <div class="texto texto2">
                            <span class="title">yogurt batido sabor<br>
                            natural con bolitas<br>
                            cubiertas de chocolate.</span>
                            <a href="#" class="md-trigger infoad" data-modal="modal-1">información nutricional</a>
                            <div class="frame">
                                <div class="sup"></div>
                                <div class="inf"></div>
                                <div class="parent txt">
                                    <div class="child">
                                        <h1 class="large">BOLITAS<br>CUBIERTAS<br>DE CHOCOLATE</h1>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="md-trigger btnplay btnplay2" data-modal="modal-2"><span>VER COMERCIAL</span></a>
                        </div>
                        <div class="texto texto3">
                            <span class="title">yogurt batido sabor<br>
                                natural con mini picaras.</span>
                            <a href="#" class="md-trigger infoad" data-modal="modal-1">información nutricional</a>
                            <div class="frame">
                                <div class="sup"></div>
                                <div class="inf"></div>
                                <div class="parent txt">
                                    <div class="child">
                                        <h1>MINI<br>P&Iacute;CARAS</h1>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="md-trigger btnplay btnplay3" data-modal="modal-2"><span>VER COMERCIAL</span></a>
                        </div>
                        <div class="texto texto4">
                            <span class="title">yogurt batido sabor<br>
                            natural con bolitas<br>
                            cubiertas de chocolate.</span>
                            <a href="#" class="md-trigger infoad" data-modal="modal-1">información nutricional</a>
                            <div class="frame">
                                <div class="sup"></div>
                                <div class="inf"></div>
                                <div class="parent txt">
                                    <div class="child">
                                        <h1>M&M's</h1>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="md-trigger btnplay btnplay4" data-modal="modal-2"><span>VER COMERCIAL</span></a>
                        </div>

                        <ul class="circle-nav">
                            <li><a href="#" class="menuB menu1 active"><span></span></a></li>
                            <li><a href="#" class="menuB menu2"><span></span></a></li>
                            <li><a href="#" class="menuB menu3"><span></span></a></li>
                            <li><a href="#" class="menuB menu4"><span></span></a></li>
                        </ul>

                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="scrollto _bottom_center">
                    <div class="scroll-points white">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="clr"></div>
                    <span class="label">Scroll</span>
                </div>
                <div class="footer">
                    <div class="copyright">© 2018  / Battimix    -    <a href="#" class="md-trigger" data-modal="modal-3">Términos y Condiciones</a></div>
                </div>

            </div>

            <div class="page mobile">
                <div class="header">
                    <div class="info">
                        <a href="./" class="logo"><img src="img/logo.png" alt=""></a>
                        <a href="#" class="burger"></a>
                        <div class="menu">
                            <ul>
                                <li><a href="./">inicio</a></li>
                                <li><a href="participa">participa</a></li>
                                <li><a href="premios">premios</a></li>
                                <li><a href="productos" class="active">productos</a></li>
                                <li><a href="galeria">galería</a></li>
                                <li><a href="mecanica">mecánica</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="part">
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="img"><img src="img/mobile/prod1.png" alt=""></div>
                            <div class="row desc">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left">
                                    <p>yogurt batido sabor<br>
                                        natural con hojuelas<br>
                                        azucaradas.
                                    </p>
                                    <a href="#" class="md-trigger info" data-modal="modal-1">INFORMACIÓN ADICIONAL</a>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                                    <a href="#" class="md-trigger btnplay btnplay1" data-modal="modal-2">VER COMERCIAL</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="img/mobile/prod2.png" alt=""></div>
                            <div class="row desc">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left">
                                    <p>yogurt batido sabor<br>
                                        natural con bolitas<br>
                                        cubiertas de chocolate.
                                    </p>
                                    <a href="#" class="md-trigger info" data-modal="modal-1">INFORMACIÓN ADICIONAL</a>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                                    <a href="#" class="md-trigger btnplay btnplay2" data-modal="modal-2">VER COMERCIAL</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="img/mobile/prod3.png" alt=""></div>
                            <div class="row desc">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left">
                                    <p>yogurt batido sabor<br>
                                        natural con mini picaras.
                                    </p>
                                    <a href="#" class="md-trigger info" data-modal="modal-1">INFORMACIÓN ADICIONAL</a>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                                    <a href="#" class="md-trigger btnplay btnplay3" data-modal="modal-2">VER COMERCIAL</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="img"><img src="img/mobile/prod4.png" alt=""></div>
                            <div class="row desc">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left">
                                    <p>yogurt batido sabor<br>
                                        natural con bolitas<br>
                                        cubiertas de chocolate.
                                    </p>
                                    <a href="#" class="md-trigger info" data-modal="modal-1">INFORMACIÓN ADICIONAL</a>

                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                                    <a href="#" class="md-trigger btnplay btnplay4" data-modal="modal-2">VER COMERCIAL</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="copyright">© 2018  / Battimix    -    <a href="#" class="md-trigger" data-modal="modal-3">Términos y Condiciones</a></div>
                </div>
            </div>

            <div id="fullpage" class="desktop">
                <div class="slide slide1"></div>
                <div class="slide slide2"></div>
                <div class="slide slide3"></div>
                <div class="slide slide4"></div>
            </div>

            <div class="md-modal md-effect-8 stats-prod1" id="modal-1">
                <div class="md-content">
                    <h3>INFORMACIÓN NUTRICIONAL DEL YOGURT**</h3>
                    <div class="info">
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Porciones por envase: 1</div>
                            <div class="col-xs-4 col-sm-5 col-md-5 col-lg-5 border-both">Tamaño de porción:</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">125g</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Cantidades por porción</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">100g</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">100g</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">100g</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Energía (Kcal)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">97</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">22</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">6</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Grasa (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">2.9</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">3.6</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">6</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Grasa saturada (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">1.7</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">2.1</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">11</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Grasas trans (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">0</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">0</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Colesterol (mg)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">8</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">10</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">3</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Sodio (mg)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">50</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">63</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">3</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Carbohidratos (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">14.1</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">17.6</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">6</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Fibra dietaria</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">0</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">0</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Azúcares (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">14.1</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">17.6</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right"></div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Proteínas (g)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">3.7</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">4.6</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">9</div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Calcio (mg)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">130</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">163</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">20</div>
                        </div><div class="row">
                            <div class="col-xs-6 col-sm-5 col-md-5 col-lg-5">Fósforo (mg)</div>
                            <div class="col-xs-2 col-sm-3 col-md-3 col-lg-3 border-left">110</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 border-right">130</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 right">17</div>
                        </div>
                    </div>
                    <p>(*) Aporte de nutrientes expresado como % del Requerimiento Diario<br>
                        (RD) - CODEX/FDA<br>
                        Valores del% diario basados en una dieta de 2000 kcal.<br>
                        (**) La información  nutricional está condicionada  sólo al yogurt.</p>
                    <a href="#" class="btnclose md-close"></a>
                </div>
            </div>

            <div class="md-modal md-effect-8 video-content" id="modal-2">
                <div class="md-content">
                    <iframe id="comercial1" class="comercial"  src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <a href="#" class="md-close btnclose"></a>
                </div>
            </div>

            <div class="md-modal md-effect-8 terms-content" id="modal-3">
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
        <script type="text/javascript" src="js/fullpage/jquery.fullpage.min.js"></script>
        <script src="js/plugins.js"></script>
        <script type="text/javascript" src="js/OverlayScrollbars.js"></script>
        <script src="js/owl/owl.carousel.min.js"></script>
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
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    dots: true,
                    onTranslate: callback
                });

                function callback(event) {
                    var element   = event.target;         // DOM element, in this example .owl-carousel
                    var name      = event.type;           // Name of the event, in this example dragged
                    var namespace = event.namespace;      // Namespace of the event, in this example owl.carousel
                    var items     = event.item.count;     // Number of items
                    var item      = event.item.index;     // Position of the current item
                    // Provided by the navigation plugin
                    var pages     = event.page.count;     // Number of pages
                    var page      = event.page.index;     // Position of the current page
                    var size      = event.page.size;      // Number of items per page

                    if(event.page.index==0){
                        $('.page').removeClass('bg-green').removeClass('bg-yellow').removeClass('bg-pink').addClass('bg-blue');
                    }
                    if(event.page.index==1){
                        $('.page').removeClass('bg-blue').removeClass('bg-yellow').removeClass('bg-pink').addClass('bg-green');
                    }
                    if(event.page.index==2){
                        $('.page').removeClass('bg-green').removeClass('bg-blue').removeClass('bg-pink').addClass('bg-yellow');
                    }
                    if(event.page.index==3){
                        $('.page').removeClass('bg-green').removeClass('bg-yellow').removeClass('bg-blue').addClass('bg-pink');
                    }
                }

                $('#terms').overlayScrollbars({
                    overflowBehavior : {
                        x : "hidden",
                        y : "scroll"
                    },
                });
            });
        </script>

        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-115989753-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>

    </body>

</html>
