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
        <title>Battimixea</title>
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
        <link rel="stylesheet" href="js/owl/assets/owl.carousel.min.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/normalize.min.css">
        <link rel="stylesheet" type="text/css" href="css/component.min.css" />
        <link rel="stylesheet" href="fonts/styles.min.css">
        <link type="text/css" href="css/OverlayScrollbars.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/main.min.css">
    </head>
    <body class="home">
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
            <div class="sup">
                <div class="row top">
                    <video src="604267342.mp4" autoplay loop id="video"></video>
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content">
                        <div class="info"><div class="bat"><img src="img/bat1.png" alt=""></div></div>
                    </div>
                    <!--<div class="cover"></div>-->
                </div>
                <div class="row middle">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content">
                        <div class="info">
                            <div class="bat">
                                <img src="img/bat2.png" alt="" class="bat_bot">
                            </div>
                            <div class="envase envase1">
                                <div class="position-relative">
                                    <div class="izq"><img src="img/bg-home-prod1-left.png" alt=""></div>
                                    <div class="der"><img src="img/bg-home-prod1-right.png" alt=""></div>
                                    <div class="batt"><img src="img/home-prod1.png" alt=""></div>
                                </div>
                            </div>
                            <div class="envase envase2">
                                <div class="position-relative">
                                    <div class="izq"><img src="img/bg-home-prod2-left.png" alt=""></div>
                                    <div class="der"><img src="img/bg-home-prod2-right.png" alt=""></div>
                                    <div class="batt"><img src="img/home-prod2.png" alt=""></div>
                                </div>
                            </div>
                            <div class="envase envase3">
                                <div class="position-relative">
                                    <div class="izq"><img src="img/bg-home-prod3-left.png" alt=""></div>
                                    <div class="der"><img src="img/bg-home-prod3-right.png" alt=""></div>
                                    <div class="batt"><img src="img/home-prod3.png" alt=""></div>
                                </div>
                            </div>
                            <div class="envase envase4">
                                <div class="position-relative">
                                    <div class="izq"><img src="img/bg-home-prod4-left.png" alt=""></div>
                                    <div class="der"><img src="img/bg-home-prod4-right.png" alt=""></div>
                                    <div class="batt"><img src="img/home-prod4.png" alt=""></div>
                                </div>
                            </div>
                            <div class="text">
                                Diviértete combinando la foto<br>
                                que más te guste y <span class="yellow">gana<br>
                                premios</span> con BattiMix.<br>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="svg-filters">
                                    <defs>
                                        <filter id="filter-goo-1">
                                            <feGaussianBlur in="SourceGraphic" stdDeviation="7" result="blur" />
                                            <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                            <feComposite in="SourceGraphic" in2="goo" />
                                        </filter>
                                    </defs>
                                </svg>
                                <button id="component-1" class="button button--1">
                                    INGRESAR
                                    <span class="button__container">
                                        <span class="circle top-left"></span>
                                        <span class="circle top-left"></span>
                                        <span class="circle top-left"></span>
                                        <span class="button__bg"></span>
                                        <span class="circle bottom-right"></span>
                                        <span class="circle bottom-right"></span>
                                        <span class="circle bottom-right"></span>
                                    </span>
                                </button>
                            </div>
                            <span class="txt-bot">SOLO SIGUE LOS SIGUIENTES PASOS:</span>
                            <div class="arrow"><img src="img/arrow-down.png" alt=""></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bottom">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 content">
                    <div class="row info">
                        <div class="cols">
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col col1">
                                    <div class="lineas"></div>
                                    <div class="triangle"></div>
                                    <div class="circle"><span>1</span></div>
                                    <div class="txt">
                                        <div class="parent cont">
                                            <div class="child">
                                                <div class="row">
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 left"><img src="img/icono1.png" alt="" class="icon"></div>
                                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 right">
                                                        <div class="parent">
                                                            <div class="child">Batimixea<br>tu foto.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col col2">
                                    <div class="lineas"></div>
                                    <div class="triangle"></div>
                                    <div class="circle">2</div>
                                    <div class="txt">
                                        <div class="parent cont">
                                            <div class="child min">
                                                <div class="row">
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 left"><img src="img/icono2.png" alt="" class="icon"></div>
                                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 right">
                                                        <div class="parent">
                                                            <div class="child">Recibirás una notificación de Facebook, correo o revisa la galería de fotos de la página de Batimix.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col col3">
                                    <div class="lineas"></div>
                                    <div class="triangle"></div>
                                    <div class="circle">3</div>
                                    <div class="txt">
                                        <div class="parent cont">
                                            <div class="child">
                                                <div class="row">
                                                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 left"><img src="img/icono3.png" alt="" class="icon"></div>
                                                    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7 right">
                                                        <div class="parent">
                                                            <div class="child">La foto que más votos tenga en la semana será la ganadora.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="copyright">© 2018  / Battimix    -    <a href="#" class="md-trigger" data-modal="modal-1">Términos y Condiciones</a></div>
                </div>
            </div>
        </div>
        <div class="md-modal md-effect-8 terms-content" id="modal-1">
            <div class="md-content">
                <h3>Términos y condiciones</h3>
                <?php include "tyc.php"; ?>
                <a href="#" class="btnclose md-close"></a>
            </div>
        </div>
        <div class="md-overlay"></div>
        <div class="main-mobile">
            <div class="page">
                <div class="producto producto1"><img src="img/mobile/producto1.png" alt=""></div>
                <div class="producto producto2"><img src="img/mobile/producto2.png" alt=""></div>
                <div class="producto producto3"><img src="img/mobile/producto3.png" alt=""></div>
                <div class="producto producto4"><img src="img/mobile/producto4.png" alt=""></div>
                <p>Divierte combinando la foto<br>
                    que más te guste y <span>gana<br>
                    premios</span> con Batti Mix</p>
                <a href="participa" class="btn">INGRESAR</a>
                <p>SOLO SIGUE LOS<br>
                    SIGUIENTES PASOS</p>
                <div class="position-relative">
                    <div class="arrow"><img src="img/arrow-down.png" alt=""></div>
                </div>
                <div class="bottom">
                    <div class="triangle"><img src="img/mobile/triangle.png" alt=""></div>
                    <div class="owl-carousel owl-theme">
                        <div class="item">
                            <div class="lineas">
                                <div class="circle">1</div>
                                <div class="parent">
                                    <div class="child">
                                        <div class="icon"><img src="img/mobile/icon1.png" alt=""></div>
                                        <div class="txt">
                                            <div class="parent">
                                                <div class="child">Batimixea tu foto.</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="lineas">
                                <div class="circle">2</div>
                                <div class="parent">
                                    <div class="child">
                                        <div class="icon"><img src="img/mobile/icon2.png" alt=""></div>
                                        <div class="txt">
                                            <div class="parent">
                                                <div class="child txt2">Recibirás una<br>
                                                    notificación<br>
                                                    de Facebook, correo<br>
                                                    o revisa la galería<br>
                                                    de fotos de la<br>
                                                    página de Batimix.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="lineas">
                                <div class="circle">3</div>
                                <div class="parent">
                                    <div class="child">
                                        <div class="icon"><img src="img/mobile/icon3.png" alt=""></div>
                                        <div class="txt">
                                            <div class="parent">
                                                <div class="child">La foto que más votos tenga en la semana será la ganadora.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="copyright">&copy; 2018 Battimix - <a href="#" class="md-trigger" data-modal="modal-1">Términos y condiciones</a></div>
                </div>
            </div>
        </div>

        <script src="js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="js/TweenMax.min.js"></script>
        <script src="js/owl/owl.carousel.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
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
                $('.owl-carousel').owlCarousel({
                    items: 1,
                    dots: true
                });
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
