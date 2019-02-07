jQuery(document).ready(function($){

    var vWidth, vHeight;
    var cuarto = false;
    var isSafari = /constructor/i.test(window.HTMLElement);
    var isFF = !!navigator.userAgent.match(/firefox/i);

    if (isSafari) {
        document.getElementsByTagName('html')[0].classList.add('safari');
    }

    Array.prototype.slice.call(document.querySelectorAll('.button'), 0).forEach(function(bt) {
        bt.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });

    if($('body').hasClass('home')) {
        initBt1();
    }
    function initBt1() {
        var bt1 = document.querySelectorAll('#component-1')[0];
        var bt1c = document.querySelector('.button__container');
        var $circlesTopLeft = bt1.querySelectorAll('.circle.top-left');
        var $circlesBottomRight = bt1.querySelectorAll('.circle.bottom-right');

        var filter = document.querySelectorAll('#filter-goo-1 feGaussianBlur')[0];

        var tl = new TimelineLite();
        var tl2 = new TimelineLite();

        var btTl = new TimelineLite({
            paused: true,
            onUpdate: function() {
                filter.setAttribute('x', 0);
            },
            onComplete: function() {
                bt1c.style.filter = 'none';
            }
        });

        tl.to($circlesTopLeft, 1.2, { x: -25, y: -25, scaleY: 2, ease: SlowMo.ease.config(0.1, 0.7, false) });
        tl.to($circlesTopLeft[0], 0.1, { scale: 0.2, x: '+=6', y: '-=2' });
        tl.to($circlesTopLeft[1], 0.1, { scaleX: 1, scaleY: 0.8, x: '-=10', y: '-=7' }, '-=0.1');
        tl.to($circlesTopLeft[2], 0.1, { scale: 0.2, x: '-=15', y: '+=6' }, '-=0.1');
        tl.to($circlesTopLeft[0], 1, { scale: 0, x: '-=5', y: '-=15', opacity: 0 });
        tl.to($circlesTopLeft[1], 1, { scaleX: 0.4, scaleY: 0.4, x: '-=10', y: '-=10', opacity: 0 }, '-=1');
        tl.to($circlesTopLeft[2], 1, { scale: 0, x: '-=15', y: '+=5', opacity: 0 }, '-=1');

        var tlBt1 = new TimelineLite();
        var tlBt2 = new TimelineLite();

        tlBt1.set($circlesTopLeft, { x: 0, y: 0, rotation: -45 });
        tlBt1.add(tl);

        tl2.to($circlesBottomRight, 1.2, { x: 25, y: 25, scaleY: 2, ease: SlowMo.ease.config(0.1, 0.7, false) });
        tl2.to($circlesBottomRight[0], 0.1, { scale: 0.2, x: '-=6', y: '+=3' });
        tl2.to($circlesBottomRight[1], 0.1, { scale: 0.8, x: '+=7', y: '+=3' }, '-=0.1');
        tl2.to($circlesBottomRight[2], 0.1, { scale: 0.2, x: '+=15', y: '-=6' }, '-=0.1');
        tl2.to($circlesBottomRight[0], 1, { scale: 0, x: '+=5', y: '+=15', opacity: 0 });
        tl2.to($circlesBottomRight[1], 1, { scale: 0.4, x: '+=7', y: '+=7', opacity: 0 }, '-=1');
        tl2.to($circlesBottomRight[2], 1, { scale: 0, x: '+=15', y: '-=5', opacity: 0 }, '-=1');

        tlBt2.set($circlesBottomRight, { x: 0, y: 0, rotation: -45 });
        tlBt2.add(tl2);

        btTl.add(tlBt1);
        btTl.to(bt1.parentNode.querySelectorAll('.button__bg'), 0.8, { scaleY: 1.1 }, 0.1);
        btTl.add(tlBt2, 0.2);
        btTl.to(bt1.parentNode.querySelectorAll('.button__bg'), 1.8, { scale: 1, ease: Elastic.easeOut.config(1.2, 0.4) }, 1.2);

        btTl.timeScale(2.6);

        bt1.addEventListener('click', function() {
            bt1c.style.filter = 'url(#filter-goo-1)';
            btTl.restart();

            ga('send', 'event', 'botón ingresar Home', 'click', 'Home - Ingresar');

            var t = setTimeout(function(){
                location.href = 'participa';
            }, 750);


        });
    }

    var $info = $('.info'),
        $envase = $('.info .envase'),
        $izq = $('.izq'),
        $der = $('.der');
        $batt = $('.batt');

    function initTilt(contenedor, rYLeft, rXLeft, rYRight, rXRight, rYBatt, rXBatt) {
        TweenMax.set([$izq, $der, $batt], { transformStyle: "preserve-3d" });

        contenedor.mousemove(function(e) {
            var sxPos = e.pageX / $envase.width() * 100 - 100;
            var syPos = e.pageY / $envase.height() * 100 - 100;

            TweenMax.to($izq, 2, {
                rotationY: rYLeft * sxPos,
                rotationX: rXLeft * syPos,
                transformPerspective: 0,
                transformOrigin: "center top -400",
                ease: Expo.easeOut
            });
            TweenMax.to($der, 2, {
                rotationY: rYRight * sxPos,
                rotationX: rXRight * syPos,
                transformPerspective: 0,
                transformOrigin: "center top -400",
                ease: Expo.easeOut
            });
            TweenMax.to($batt, 2, {
                rotationY: rYBatt * sxPos,
                rotationX: rXBatt * syPos,
                transformPerspective: 0,
                transformOrigin: "center top -400",
                ease: Expo.easeOut
            });
        });

    };

    var logobn = new TimelineLite({
        paused: true,
    });

    logobn.fromTo($('#preloader .loader'), .5, { scaleX: 1, scaleY: 1, yoyo: true, repeat: -1 }, { scaleX: 1.1, scaleY: 1.1, yoyo: true, repeat: -1 });
    logobn.play();

    var tlbat1 = new TimelineLite({ paused: true });
    var tlbat2 = new TimelineLite({ paused: true });
    var tlhome = new TimelineLite({ paused: true });
    var tlenv = new TimelineLite({ paused: true });
    var tlprod1 = new TimelineLite({ paused: true });
    var tlprod2 = new TimelineLite({ paused: true });
    var tlprod3 = new TimelineLite({ paused: true });
    var tlprod4 = new TimelineLite({ paused: true });
    var tltxt1 = new TimelineLite({ paused: true });
    var tltxt2 = new TimelineLite({ paused: true });
    var tltxt3 = new TimelineLite({ paused: true });
    var tltxt4 = new TimelineLite({ paused: true });
    var tlsup = new TimelineLite({ paused: true });
    var tlbot = new TimelineLite({ paused: true });
    var tlh1 = new TimelineLite({ paused: true });
    var tlbg1 = new TimelineLite({ paused: true });
    var tlbg2 = new TimelineLite({ paused: true });
    var tlbg3 = new TimelineLite({ paused: true });
    var tlbg4 = new TimelineLite({ paused: true });
    var tlfooter = new TimelineLite({ paused: true });
    var tlprem1 = new TimelineLite({ paused: true });
    var tlprem2 = new TimelineLite({ paused: true });
    var tlprem3 = new TimelineLite({ paused: true });
    var tlmec = new TimelineLite({ paused: true });
    var tlpart = new TimelineLite({ paused: true });
    var tlgal = new TimelineLite({ paused: true });
    var tlgan = new TimelineLite({ paused: true });

    tlenv.to($('.middle .envase1'), .35, { opacity: 1, ease:Power0.easeOut })
        .to($('.middle .envase1'), .35, { delay: 5, opacity: 0, ease:Power0.easeOut })
        .fromTo($('.middle .envase2'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut })
        .to($('.middle .envase2'), .35, { delay: 5, opacity: 0, ease:Power0.easeOut })
        .fromTo($('.middle .envase3'), .35, { opacity: 0, ease:Power0.easeOut}, { opacity: 1, ease:Power0.easeOut})
        .to($('.middle .envase3'), .35, { delay: 5, opacity: 0, ease:Power0.easeOut })
        .fromTo($('.middle .envase4'), .35, { opacity: 0, ease:Power0.easeOut}, { opacity: 1, ease:Power0.easeOut})
        .to($('.middle .envase4'), .35, { delay: 5, opacity: 0, ease:Power0.easeOut })
        .to($('.middle .envase1'), .45, { opacity: 1, ease:Power0.easeOut, onComplete: function(){
                fEnvases();
            } });

    tlprod1
        .to($('.content .bg1'), .15, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.producto .envase1'), .75, { scaleX:0, scaleY:0, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) }, { scaleX: 1, scaleY: 1, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) })
        .to($('.dots1'), .35, { opacity: 1, ease:Power0.easeOut })
        .to($('.info .texto .btnplay'), .35, { opacity: 1, ease:Power0.easeOut });

    tlprod2
        .to($('.content .bg2'), .15, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.producto .envase2'), .75, { scaleX:0, scaleY:0, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) }, { scaleX: 1, scaleY: 1, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) })
        .to($('.dots2'), .35, { opacity: 1, ease:Power0.easeOut })
        .to($('.info .texto .btnplay'), .35, { opacity: 1, ease:Power0.easeOut });

    tlprod3
        .to($('.content .bg3'), .15, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.producto .envase3'), .75, { scaleX:0, scaleY:0, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) }, { scaleX: 1, scaleY: 1, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) })
        .to($('.dots3'), .35, { opacity: 1, ease:Power0.easeOut })
        .to($('.info .texto .btnplay'), .35, { opacity: 1, ease:Power0.easeOut });

    tlprod4
        .to($('.content .bg4'), .15, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.producto .envase4'), .75, { scaleX:0, scaleY:0, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) }, { scaleX: 1, scaleY: 1, opacity: 1, ease: Elastic.easeOut.config(0.6, 0.3) })
        .to($('.dots4'), .35, { opacity: 1, ease:Power0.easeOut })
        .to($('.info .texto .btnplay'), .35, { opacity: 1, ease:Power0.easeOut });

    tltxt1.to($('.info .texto1 .title, .info .texto1 .infoad'), .35, { delay: .35,  opacity: 1, ease:Power0.easeOut })
    tltxt2.to($('.info .texto2 .title, .info .texto2 .infoad'), .35, { delay: .35,  opacity: 1, ease:Power0.easeOut })
    tltxt3.to($('.info .texto3 .title, .info .texto3 .infoad'), .35, { delay: .35,  opacity: 1, ease:Power0.easeOut })
    tltxt4.to($('.info .texto4 .title, .info .texto4 .infoad'), .35, { delay: .35,  opacity: 1, ease:Power0.easeOut })

    tlsup.fromTo($('.info .texto .sup'), 1, { left: 150, opacity: 0 }, { left: 0, delay: .7, opacity: 1, ease: Elastic.easeOut.config(1.2, 0.4) });

    tlbot.fromTo($('.info .texto .inf'), 1, {left: -150, opacity: 0 }, { left: 0,  delay: .7, opacity: 1, ease: Elastic.easeOut.config(1.2, 0.4) });

    tlh1.to($('.info .texto h1'), .35, { delay: .85,  opacity: 1, ease:Power0.easeOut });

    tlbg1.fromTo($('.producto .info .anim1'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 733, ease:Power0.easeOut });
    tlbg2.fromTo($('.producto .info .anim2'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 733, ease:Power0.easeOut });
    tlbg3.fromTo($('.producto .info .anim3'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 733, ease:Power0.easeOut });
    tlbg4.fromTo($('.producto .info .anim4'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 733, ease:Power0.easeOut });

    tlbat1.fromTo($('.top .info .bat'), 1, { left: 300, opacity: 0 }, { left: 0, opacity: 1, ease: Elastic.easeOut.config(1.2, 0.4) });
    tlbat2.fromTo($('.middle .info .bat'), 1, { left: -300, opacity: 0 }, { left: 0, opacity: 1, ease: Elastic.easeOut.config(1.2, 0.4) })

    tlhome.to($('.middle .info .text'), .35, { delay: .35, opacity: 1 })
        .fromTo($('.middle .info .envase1'), 1, { opacity: 0, scaleX: 1.6, scaleY: 1.6 }, {  opacity: 1, scaleX: 1, scaleY: 1,  ease: Elastic.easeOut.config(0.6, 0.3), onComplete:function(){
            fEnvases();
            } })
        .to($('.middle .info .txt-bot'), .35, { opacity: 1 })
        .to($('.middle .arrow'), .35, { opacity: 1 })
        .to($('.bottom .info .cols .col1'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col1 .lineas, .bottom .info .cols .col1 .triangle, .bottom .info .cols .col1 .circle'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col1 .txt'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col1 .left'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col1 .right'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col2'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col2 .lineas, .bottom .info .cols .col2 .triangle, .bottom .info .cols .col2 .circle'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col2 .txt'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col2 .left'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col2 .right'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col3'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col3 .lineas, .bottom .info .cols .col3 .triangle, .bottom .info .cols .col3 .circle'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col3 .txt'), .25, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col3 .left'), .15, { opacity: 1, ease:Power0.easeOut })
        .to($('.bottom .info .cols .col3 .right'), .15, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });

    tlprem1.fromTo($('.premio .block0 .anim1'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 800, ease:Power0.easeOut });
    /*tlprem1.fromTo($('.premio .block1 .anim2'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 707, ease:Power0.easeOut });
    tlprem1.fromTo($('.premio .block1 .anim3'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 748, ease:Power0.easeOut });
    tlprem1.fromTo($('.premio .block1 .anim1'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 1030, ease:Power0.easeOut });
    tlprem3.fromTo($('.premio .block1 .txt'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });
    tlprem3.fromTo($('.premio .block1 .img'), .35, { opacity: 0, ease:Power0.easeOut }, { delay: .35, opacity: 1, ease:Power0.easeOut });*/

    tlmec.fromTo($('.mec .anim1'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 561, ease:Power0.easeOut })
    .fromTo($('.mec .img'), .35, {opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut })
    .fromTo($('.mec .txt'), .35, {opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut })
    .fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });

    tlpart.fromTo($('.part .anim1'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 406, ease:Power0.easeOut })
        .fromTo($('.part .anim2'), .35, { left: 0, width: 0, ease:Power0.easeOut }, { left: 0, width: 406, ease:Power0.easeOut })
        .fromTo($('.part h1, .part .prelog, .part .par, .part .form'), .35, { opacity: 0, ease:Power0.easeOut }, { delay: .35, opacity: 1, ease:Power0.easeOut })
        .fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });

    tlgal.fromTo($('.gal .info'), .35, {opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });

    tlgan.fromTo($('.gan .info'), .35, {opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut })
        .fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, { opacity: 1, ease:Power0.easeOut });

    tlfooter.fromTo($('.main .footer'), .35, { opacity: 0, ease:Power0.easeOut }, {opacity: 1, ease:Power0.easeOut });

    var perc = false;
    var t;
    var fullp = false;

    function fPreloader()
    {

        var iLoader = -1;
        var arrayImg = ['img/logo_bn.png', 'img/mix.png', 'img/logo_color.png', 'img/bat1.png', 'img/bat2.png', 'img/battimix.png', 'img/bgbox.png', 'img/bottom.jpg', 'img/circle.png', 'img/middle.jpg', 'img/tapa.png', 'img/top_1.jpg', 'img/top.jpg', 'img/boxlineas.png', 'img/hojuelas1_bot.png', 'img/hojuelas2_bot.png', 'img/triangle.png'];

        $.each(arrayImg, function(img) {
            var imageloaded = new Image();
            $(imageloaded).on('load', function () {

                iLoader ++;
                var numberLoader = (iLoader + 1) * (100 / arrayImg.length);
                var txtLoader = numberLoader;

                $('#preloader .color').animate({width: txtLoader*(245/100)}, 10);

                if(txtLoader==100 && !perc){

                    var body = $('body');
                    TweenMax.staggerFromTo($(".scroll-points > span"),1,{autoAlpha:1},{autoAlpha:0,repeat:-1},.1)

                        $('#preloader').fadeOut(350, function () {
                            $('.scrollto._bottom_center, .circle-nav').delay(350).fadeIn(350);
                            if(body.hasClass('home')) {
                                logobn.pause();
                                $('#video').fadeIn(350);
                                tlbat1.play();
                                tlbat2.play();
                                tlhome.play();
                                initTilt($('.info'), 0.05, 0, 0.045, 0, 0.015, -0.0045);
                            }
                            if(body.hasClass('productos')) {
                                if($(window).width()>767){
                                    $('#fullpage').fullpage({
                                        sectionSelector: '.slide',
                                        scrollBar: true,
                                        anchors: ['hojuelas-azucaradas', 'bolitas-cubiertas-de-chocolate', 'mini-picaras', "m&m'\s"],
                                        afterLoad: function(anchorLink, index){
                                            fullp = true;

                                            initTilt($('.info'), 0.05, -0.0035, 0.065, -0.006, 0.015, -0.0045);

                                            if(index==1){
                                                location.hash = anchorLink;
                                                $('.producto .content, body').removeClass('prod4').removeClass('prod3').removeClass('prod2').addClass('prod1');
                                                tlbg2.pause(0);
                                                tlbg3.pause(0);
                                                tlbg4.pause(0);
                                                $('.texto2').fadeOut(500, function () {
                                                    $('.texto1').show();
                                                    $('.texto2, .texto3, .texto4').hide();
                                                    tlprod1.restart();
                                                    tlprod2.pause(0);
                                                    tlprod3.pause(0);
                                                    tlprod4.pause(0);
                                                    tltxt1.restart();
                                                    tlsup.restart();
                                                    tlbot.restart();
                                                    tlh1.restart();
                                                    setTimeout(function () {
                                                        tlbg1.play();
                                                    }, 150);
                                                });
                                                cuarto = false;
                                                $('.scroll-points').removeClass('orange').addClass('white');
                                                $('.scrollto .label').removeClass('orange');
                                                $('.menuB').removeClass('active');
                                                $('.menu1').addClass('active');
                                                ga('send', 'event', 'Productos', 'Visita', 'Producto Hojuelas');
                                            }

                                            if(index==2){
                                                $('.producto .content, body').removeClass('prod4').removeClass('prod3').removeClass('prod1').addClass('prod2');
                                                tlbg1.pause(0);
                                                tlbg3.pause(0);
                                                tlbg4.pause(0);
                                                $('.texto1').fadeOut(500, function () {
                                                    $('.texto2').show();
                                                    $('.texto1, .texto3, .texto4').hide();
                                                    tlprod1.pause(0);
                                                    tlprod2.restart();
                                                    tlprod3.pause(0);
                                                    tlprod4.pause(0);
                                                    tltxt2.restart();
                                                    tlsup.restart();
                                                    tlbot.restart();
                                                    tlh1.restart();
                                                    setTimeout(function () {
                                                        tlbg2.play();
                                                    }, 150);
                                                });
                                                cuarto = false;
                                                $('.scroll-points').removeClass('orange').addClass('white');
                                                $('.scrollto .label').removeClass('orange');
                                                $('.menuB').removeClass('active');
                                                $('.menu2').addClass('active');
                                                ga('send', 'event', 'Productos', 'Visita', 'Producto Bolitas de Chocolate');
                                            }

                                            if(index==3){
                                                $('.producto .content, body').removeClass('prod4').removeClass('prod2').removeClass('prod1').addClass('prod3');
                                                tlbg1.pause(0);
                                                tlbg2.pause(0);
                                                tlbg4.pause(0);
                                                $('.texto1').fadeOut(500, function () {
                                                    $('.texto3').show();
                                                    $('.texto2, .texto1, .texto4').hide();
                                                    tlprod1.pause(0);
                                                    tlprod2.pause(0);
                                                    tlprod3.restart();
                                                    tlprod4.pause(0);
                                                    tltxt3.restart();
                                                    tlsup.restart();
                                                    tlbot.restart();
                                                    tlh1.restart();
                                                    setTimeout(function () {
                                                        tlbg3.play();
                                                    }, 150);
                                                });
                                                cuarto = false;
                                                $('.scroll-points').removeClass('white').addClass('orange');
                                                $('.scrollto .label').addClass('orange');
                                                $('.menuB').removeClass('active');
                                                $('.menu3').addClass('active');
                                                ga('send', 'event', 'Productos', 'Visita', 'Producto Mini Pícaras');
                                            }

                                            if(index==4){
                                                $('.producto .content, body').removeClass('prod3').removeClass('prod2').removeClass('prod1').addClass('prod4');
                                                tlbg1.pause(0);
                                                tlbg2.pause(0);
                                                tlbg3.pause(0);
                                                $('.texto1').fadeOut(500, function () {
                                                    $('.texto4').show();
                                                    $('.texto1, .texto2, .texto3').hide();
                                                    tlprod1.pause(0);
                                                    tlprod2.pause(0);
                                                    tlprod3.pause(0);
                                                    tlprod4.restart();
                                                    tltxt4.restart();
                                                    tlsup.restart();
                                                    tlbot.restart();
                                                    tlh1.restart();
                                                    setTimeout(function () {
                                                        tlbg4.play();
                                                    }, 150);

                                                });
                                                cuarto = true;
                                                $('.menuB').removeClass('active');
                                                $('.menu4').addClass('active');
                                                ga('send', 'event', 'Productos', 'Visita', 'Producto M&Ms');
                                            }

                                            tlfooter.play();
                                        },
                                        onLeave: function(index, nextIndex, direction){
                                            //$('.scrollto').fadeOut(350);

                                        }

                                    });
                                } else {
                                    tlfooter.play();
                                }
                            }
                            if(body.hasClass('premios')) {
                                tlprem1.play();
                                tlprem2.play();
                                tlprem3.play();
                                tlfooter.play();
                            }
                            if(body.hasClass('mecanica')){
                                tlmec.play();
                            }
                            if(body.hasClass('participa')){
                                tlpart.play();
                                $('#fechanac').mask('00/00/0000');
                                $('#fechanac_user').mask('00/00/0000');
                            }
                            if(body.hasClass('galeria')){
                                tlgal.play();
                            }
                            if(body.hasClass('ganadores')){
                                tlgan.play();
                            }
                        });

                    perc = true;
                    clearTimeout(t);

                }//end if
            }).attr('src', arrayImg[img]);
        });
        t = setTimeout(fPreloader, 1000);

    }

    fPreloader();
    
    var full = false;

    function fResize() {
        vWidth = $(window).width();
        vHeight = $(window).height();
        $('.main .producto .content').css('height', vHeight-86+'px');

        if(vHeight>703){
            $('.main .producto .content .info').css('margin-top', parseInt( ( (vHeight-86-49)-$('.main .producto .content .info').height() )*.5 )+'px')
        } else {
            $('.main .producto .content .info').css('margin-top', 0);
        }
        if($(window).width()>767) {
             if($('body').hasClass('participa')){
                 if(vHeight>$('.main .page').height()){
                     $('.main .page').css('height', vHeight+'px');
                 } else {
                     $('.main').css('height', ($('.main .page .part').height()+86+80)+'px');
                 }
             }
            if($('body').hasClass('part')){
                if(vHeight>710){
                    $('.page').css('height', vHeight+'px');
                    $('.page .premio').css('height', vHeight-86+'px');
                } else {
                    $('.page').css('height', '710px');
                    $('.page .premio').css('height', '710px');
                }
            }
            if($('body').hasClass('premios')){
                if(vHeight>$('.main .page').height()){
                    $('.main .page .premio').css('height', vHeight-86+'px');
                } else {
                    $('.page').css('height', $('.page .premio').height()+'px');
                }
            }
            if($('body').hasClass('galeria')){
                if(vHeight>$('.main .page').height()){
                    $('.main').css('height', vHeight+'px');
                } else {
                    $('.main').css('height', $('.main .page').height());
                }
            }
            if($('body').hasClass('mecanica')){
                if(vHeight>710){
                    $('.page').css('height', vHeight+'px');
                    $('.page .mec').css('height', vHeight-86+'px');
                } else {
                    $('.page').css('height', '710px');
                    $('.page .mec').css('height', '710px');
                }
            }
            if(full){
                full = false;
                if($('body').hasClass('productos')) {
                    $('#fullpage').fullpage({
                        sectionSelector: '.slide',
                        scrollBar: true,
                        anchors: ['hojuelas-azucaradas', 'bolitas-cubiertas-de-chocolate', 'mini-picaras', "m&m'\s"],
                        afterLoad: function (anchorLink, index) {

                            initTilt($('.info'), 0.05, -0.0035, 0.065, -0.006, 0.015, -0.0045);

                            if (index == 1) {
                                location.hash = anchorLink;
                                $('.producto .content, body').removeClass('prod4').removeClass('prod3').removeClass('prod2').addClass('prod1');
                                tlbg2.pause(0);
                                tlbg3.pause(0);
                                tlbg4.pause(0);
                                $('.texto2').fadeOut(500, function () {
                                    $('.texto1').show();
                                    $('.texto2, .texto3, .texto4').hide();
                                    tlprod1.restart();
                                    tlprod2.pause(0);
                                    tlprod3.pause(0);
                                    tlprod4.pause(0);
                                    tltxt1.restart();
                                    tlsup.restart();
                                    tlbot.restart();
                                    tlh1.restart();
                                    setTimeout(function () {
                                        tlbg1.play();
                                    }, 150);
                                });
                                cuarto = false;
                                $('.scroll-points').removeClass('orange').addClass('white');
                                $('.scrollto .label').removeClass('orange');
                                $('.menuB').removeClass('active');
                                $('.menu1').addClass('active');
                                ga('send', 'event', 'Productos', 'Visita', 'Producto Hojuelas');
                            }

                            if (index == 2) {
                                $('.producto .content, body').removeClass('prod4').removeClass('prod3').removeClass('prod1').addClass('prod2');
                                tlbg1.pause(0);
                                tlbg3.pause(0);
                                tlbg4.pause(0);
                                $('.texto1').fadeOut(500, function () {
                                    $('.texto2').show();
                                    $('.texto1, .texto3, .texto4').hide();
                                    tlprod1.pause(0);
                                    tlprod2.restart();
                                    tlprod3.pause(0);
                                    tlprod4.pause(0);
                                    tltxt2.restart();
                                    tlsup.restart();
                                    tlbot.restart();
                                    tlh1.restart();
                                    setTimeout(function () {
                                        tlbg2.play();
                                    }, 150);
                                });
                                cuarto = false;
                                $('.scroll-points').removeClass('orange').addClass('white');
                                $('.scrollto .label').removeClass('orange');
                                $('.menuB').removeClass('active');
                                $('.menu2').addClass('active');
                                ga('send', 'event', 'Productos', 'Visita', 'Producto Bolitas de Chocolate');
                            }

                            if (index == 3) {
                                $('.producto .content, body').removeClass('prod4').removeClass('prod2').removeClass('prod1').addClass('prod3');
                                tlbg1.pause(0);
                                tlbg2.pause(0);
                                tlbg4.pause(0);
                                $('.texto1').fadeOut(500, function () {
                                    $('.texto3').show();
                                    $('.texto2, .texto1, .texto4').hide();
                                    tlprod1.pause(0);
                                    tlprod2.pause(0);
                                    tlprod3.restart();
                                    tlprod4.pause(0);
                                    tltxt3.restart();
                                    tlsup.restart();
                                    tlbot.restart();
                                    tlh1.restart();
                                    setTimeout(function () {
                                        tlbg3.play();
                                    }, 150);
                                });
                                cuarto = false;
                                $('.scroll-points').removeClass('white').addClass('orange');
                                $('.scrollto .label').addClass('orange');
                                $('.menuB').removeClass('active');
                                $('.menu3').addClass('active');
                                ga('send', 'event', 'Productos', 'Visita', 'Producto Mini Pícaras');
                            }

                            if (index == 4) {
                                $('.producto .content, body').removeClass('prod3').removeClass('prod2').removeClass('prod1').addClass('prod4');
                                tlbg1.pause(0);
                                tlbg2.pause(0);
                                tlbg3.pause(0);
                                $('.texto1').fadeOut(500, function () {
                                    $('.texto4').show();
                                    $('.texto1, .texto2, .texto3').hide();
                                    tlprod1.pause(0);
                                    tlprod2.pause(0);
                                    tlprod3.pause(0);
                                    tlprod4.restart();
                                    tltxt4.restart();
                                    tlsup.restart();
                                    tlbot.restart();
                                    tlh1.restart();
                                    setTimeout(function () {
                                        tlbg4.play();
                                    }, 150);

                                });
                                cuarto = true;
                                $('.menuB').removeClass('active');
                                $('.menu4').addClass('active');
                                ga('send', 'event', 'Productos', 'Visita', 'Producto M&Ms');
                            }

                            tlfooter.play();
                        },
                        onLeave: function (index, nextIndex, direction) {
                            //$('.scrollto').fadeOut(350);

                        }

                    });
                }
            }

            if($('body').hasClass('ganadores')){

                 console.log($('.gana .block').height()+86, vHeight);

                if(vHeight>$('.gana .block').height()+286){
                    $('.page .gana').css('height', vHeight-86+'px');


                } else {
                    $('.page .gana').css('height', 882+'px');
                }
            }


        } else {
            full = true;
                if(fullp){
                    $.fn.fullpage.destroy('all');
                }

        }
        if($('body').hasClass('productos')) {
            $('.video-content .md-content iframe').css('height', parseInt(9 * ($('.video-content .md-content iframe').width() / 16)) + 'px');
        }

    }

    fResize();

    $(window).on('resize',function () {
        fResize();
    });

    function fEnvases(){
        tlenv.restart();
    }
    var j=false;
    function scrolled() {

        $('.scrollto').fadeOut(350);

        if(!j){
            j=true;
            setTimeout(function(){
                if(!cuarto) {
                    $('.scrollto').fadeIn(350, function () {
                        j=false;
                    });
                }
                //$(this).on('scroll', scrolled);
            }, 5000);
        }
    }

    $(window).on('scroll',function () {
        scrolled();
    });

    $('.infoad').click(function (e) {
        e.preventDefault();
        ga('send', 'event', 'Productos', 'click', 'Ver información Adicional');
    });

    $('.btnclose, .md-overlay').click(function (e) {
        e.preventDefault();
        $('.comercial').attr('src', '');
        $('.md-modal').removeClass('md-show');
    });

    $('.btnplay1').click(function (e) {
        e.preventDefault();
        $('#comercial1').attr('src', 'https://www.youtube.com/embed/7HQV1ghAafc?autoplay=1&rel=0&vq=hd1080');
        ga('send', 'event', 'Video', 'click', 'Video Producto - Hojuelas');
        $('.video-content .md-content iframe').css('height', parseInt(9 * ($('.video-content .md-content iframe').width() / 16)) + 'px');
    });
    $('.btnplay2').click(function (e) {
        e.preventDefault();
        ga('send', 'event', 'Video', 'click', 'Video Producto - Bolitas de Chocolate');
        $('#comercial1').attr('src', 'https://www.youtube.com/embed/hanfaEAvAAQ?autoplay=1&rel=0&vq=hd1080');
        $('.video-content .md-content iframe').css('height', parseInt(9 * ($('.video-content .md-content iframe').width() / 16)) + 'px');

    });
    $('.btnplay3').click(function (e) {
        e.preventDefault();
        ga('send', 'event', 'Video', 'click', 'Video Producto - Mini Pícaras');
        $('#comercial1').attr('src', 'https://www.youtube.com/embed/5XKJIo5DjCE?autoplay=1&rel=0&vq=hd1080');
        $('.video-content .md-content iframe').css('height', parseInt(9 * ($('.video-content .md-content iframe').width() / 16)) + 'px');

    });
    $('.btnplay4').click(function (e) {
        e.preventDefault();
        ga('send', 'event', 'Video', 'click', 'Video Producto - M&Ms');
        $('#comercial1').attr('src', 'https://www.youtube.com/embed/D6gOqDbrakY?autoplay=1&rel=0&vq=hd1080');
        $('.video-content .md-content iframe').css('height', parseInt(9 * ($('.video-content .md-content iframe').width() / 16)) + 'px');

    });

    $('.menuB').each(function (index) {
        $(this).click(function (e) {
            e.preventDefault();
            $.fn.fullpage.moveTo(index+1);
        });
    });

    $('.formulario .form .btn').click(function (e) {
        e.preventDefault();

        var $this = $(this);
        var $form = $this.closest("form");

        $data = $form.serialize();
        $form.validate();

        $('.form .btn').addClass('disabled').html('ENVIANDO...');

        if($('#password').val()!=$('re#password').val()){

        }

        if ($form.validate() && $('#password').val()==$('re#password').val()) {

            $('p.mensaje').fadeOut(350);

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
                        ga('send', 'event', 'Participa', 'Respuesta', 'Usuario registrado correctamente');
                        $('.form .btn').removeClass('disabled').html('Enviar');

                        window.location.href='participa?userid='+data[0].id;

                    }else{

                        ga('send', 'event', 'Participa', 'Respuesta', 'Usuario ya registrado');

                        $('.form .btn').removeClass('disabled').html('Enviar');
                        $('.formulario p.mensaje').html('El correo ya ha sido registrado').fadeIn(350, function () {
                        });
                    }
                },
                error: function (jqXHR, exception, response) {
                    $('.form .btn').removeClass('disabled').html('Enviar');
                }
            });

        }
        else {
            $form.validate();
            $('.form .btn').removeClass('disabled').html('Enviar');
            ga('send', 'event', 'Participa', 'Registro', 'Fallo en el registro');
        }

    });

    $('.foto_share .right .btn').click(function (e) {
        e.preventDefault();
        $('.md-modal').removeClass('md-show');
        location.reload();
        ga('send', 'event', 'Participa', 'Compartir', 'Facebook');
    });

    $('.user .login').click(function (e) {
        e.preventDefault();
        $('#modal-2').addClass('md-show');
        ga('send', 'event', 'Participa', 'Login', 'Abrir formulario');
    });

    $('.login-content .form1 .btn').click(function (e) {
        e.preventDefault();

        var $this = $(this);
        var $form = $this.closest("form");

        $data = $form.serialize();
        $form.validate();

        if ($form.validate()) {
            $(this).addClass('disabled').html('ENVIANDO...');
            $.ajax("login.php", {
                method: "POST",
                data: $data,
                dataType: 'json',
                success: function (data) {
                    if(data[0].rpta=='ok') {
                        $('.login-content p.mensaje').hide();
                        $('#userid').val(data[0].id);
                        $('.login-content .btn').removeClass('disabled').html('Enviar');
                        $('#modal-2').removeClass('md-show');
                        $('.formulario').fadeOut(350, function () {
                            ga('send', 'event', 'Participa', 'Login', 'Login exitoso');
                            window.location.href='participa?userid='+data[0].id;
                        });
                    } else {
                        $('.login-content p.mensaje').fadeIn(350, function () {
                            ga('send', 'event', 'Participa', 'Respuesta', 'Fallo en el login');
                            $('.login-content .btn').removeClass('disabled').html('Enviar');
                        });
                    }
                },
                error: function () {
                }
            });

        }
    });

    function FBLogin() {
        function statusChangeCallback(response) {

            if (response.status === 'connected') {
                var fbuid = response.authResponse.userID;

                FB.api('/me', { locale: 'en_US', fields: 'name, email, link' },
                    function(response) {

                        $.ajax("registro.php", {
                            method: "POST",
                            data: 'fb=ok&nombres='+response.name+'&correo='+response.email+'&fbuid='+fbuid+'&link='+response.link,
                            dataType: 'json',
                            success: function (data) {
                                $('#userid').val(data[0].id);
                                ga('send', 'event', 'Participa', 'Respuesta', 'Login exitoso');
                                window.location.href='participa?fbid='+fbuid+'&userid='+data[0].id;
                            },
                            error: function () {

                            }
                        });

                    }
                );

            } else {
                console.log('please log')
            }
        }

        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId      : '160121611358960',
                cookie     : true,
                xfbml      : true,
                version    : 'v2.8'
            });


            FB.login(function(response) {
                if (response.status === 'connected') {
                    statusChangeCallback(response);
                } else {

                }
            }, {scope: 'public_profile,email'});

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

    }

    $('.formulario .btnfb, .login-content .btnfb').click(function (e) {
        e.preventDefault();
        FBLogin();
    });

    $('.login-content .link').click(function (e) {
        e.preventDefault();
        $('.login-content .form1').fadeOut(350, function () {
            $('.login-content .recuperar, .login-content .recuperar .form').fadeIn(350);
            ga('send', 'event', 'Participa', 'Recuperar Contraseña', 'Ver Formulario');
        })
    });

    $('.recuperar .btn').click(function (e) {
        e.preventDefault();
        var $this = $(this);
        var $form = $this.closest("form");

        $data = $form.serialize();
        $form.validate();

        $(this).addClass('disabled').html('ENVIANDO...');

        if ($form.validate()) {

            $.ajax("recuperar.php", {
                method: "POST",
                data: $data,
                dataType: 'json',
                success: function (data) {
                    if(data[0].rpta=='ok') {
                        $('.login-content p.mensaje').hide();
                        $('.login-content .btn').removeClass('disabled').html('Enviar');
                        $('.login-content p.mensaje').html('Tu clave ha sido enviada a tu correo de registro').fadeIn(350);
                        ga('send', 'event', 'Participa', 'Recuperar contraseña', 'recuperación de contraseña exitosa');
                        $('.login-content .recuperar').delay(3000).fadeOut(350, function () {
                            $('.login-content p.mensaje').hide().html('El correo no existe en el sistema');
                            $('.login-content .form1').fadeIn(350);
                        });
                    } else {
                        ga('send', 'event', 'Participa', 'Recuperar contraseña', 'Fallo en la recuperación de la contraseña');
                        $('.login-content p.mensaje').fadeIn(350, function () {
                            $('.login-content .btn').removeClass('disabled').html('Enviar');
                        });
                    }
                },
                error: function () {

                }
            });

        }
    });

    $('.recuperar .back').click(function (e) {
        e.preventDefault();
        $('.recuperar').fadeOut(350, function () {
           $('.login-content .form1').fadeIn(350);
        });
        ga('send', 'event', 'Participa', 'Recuperar contraseña', 'Regresar');
    });

    $("#buscar").keyup(function(event) {
        if (event.keyCode === 13) {
            $('#busqueda').submit();
        }
    });

    $('.tab').click(function (e) {
        e.preventDefault();
        $('.tab').removeClass('active');
        $(this).addClass('active');
        if( $(this).hasClass('tab1') ){
            $('.sidebar2').css({opacity: 0, visibility: 'hidden', zIndex: 1});
            $('.sidebar1').css({opacity: 1, visibility: 'visible', zIndex: 2});
            ga('send', 'event', 'Participa', 'Ver Galería', 'Superior');
        }else{
            $('.sidebar1').css({opacity: 0, visibility: 'hidden', zIndex: 1});
            $('.sidebar2').css({opacity: 1, visibility: 'visible', zIndex: 2});
            ga('send', 'event', 'Participa', 'Ver Galería', 'Inferior');
        }
    });

    //Mobile
    function HomeMobile() {
        $('.main-mobile .producto1').delay(3000).fadeOut(350, function () {
            $('.main-mobile .producto2').fadeIn(350, function () {
                $('.main-mobile .producto2').delay(3000).fadeOut(350, function () {
                    $('.main-mobile .producto3').fadeIn(350, function () {
                        $('.main-mobile .producto3').delay(3000).fadeOut(350, function () {
                            $('.main-mobile .producto4').fadeIn(350, function () {
                                $('.main-mobile .producto4').delay(3000).fadeOut(350, function () {
                                    $('.main-mobile .producto1').fadeIn(350, function () {
                                        HomeMobile();
                                    });
                                });
                            });
                        })
                    });
                })
            });
        });
    }

    HomeMobile();
    var menu = false;
    $('.burger').click(function (e) {
        e.preventDefault();
        if(!menu){
            $('.main .page .menu').fadeIn(350);
            menu = true;
        }else{
            $('.main .page .menu').fadeOut(350);
            menu = false;
        }

    });

    $('#orden').change(function () {
        var value = $(this).val();
        if(value!='-'){
            if(value==0){
                ga('send', 'event', 'Galería', 'Listado de fotos', 'Por orden de llegada');
                location.href = 'galeria';
            }
            if(value==1){
                ga('send', 'event', 'Galería', 'Listado de fotos', 'Por ranking');
                location.href = 'galeria?rnk=ok';
            }
        }
    })

});


