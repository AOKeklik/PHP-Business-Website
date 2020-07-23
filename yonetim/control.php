<?php
    include_once('../config/baglan.php');
    include_once(YONETIM.'assets/functions.php');
    $yonetim  = new Yonetim();
    $yonetim -> openfiles(['functions2'=>'Yonetim2','functions3'=>'Yonetim3','yetkicontrol' => 'Yetkicontrol']);

    $yonetim->kontrolet('control');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
    <title>Udemy Nakliyat-Yönetim Paneli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="<?=URL_YONETIM;?>assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/ebe1a92e12.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/themify-icons.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/metisMenu.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/slicknav.min.css">    
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/typography.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/default-css.css">
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/responsive.css">   
    <link rel="stylesheet" href="<?=URL_YONETIM;?>assets/css/styles.css">
    <script src="<?=URL_YONETIM;?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.3.1/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script type="text/javascript">
        function BilgiPenceresi(linkAdres,sonucbaslik,sonucmetin,sonuctur) 
        {
            swal(sonucbaslik, sonucmetin, sonuctur, {
                buttons:{
                    catch:{
                        text: "KAPAT",
                        value: "tamam",
                    }
                },
            })
            .then((value) => {
                if(value=="tamam"){
                    window.location.href =  linkAdres;
                }		
            });
        }
        function silmedenSor(gidilecekLink) 
        {
            swal({
                title: "Silmek istediğine emin misin?",
                text: "Silinen kayıt geri alınamaz.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){
                    window.location.href =  gidilecekLink; 
                }else{
                    swal({title:"Silme işleminden vazgeçtiniz", icon: "warning",});
                }
            });
        }
    </script>
</head>
<body>
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- page container area start -->
<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="sidebar-header">
            <div class="logo">
                <a href="control.html"><img src="<?=IMG_YONETIM;?>logo/logo.png" alt="logo"></a>
            </div>
        </div>
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <?= $yonetim->Yetkicontrol->linkyetkileri(); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- sidebar menu area end -->
    <!-- main content area start -->
    <div class="main-content">
        <!-- header area start -->
        <div class="header-area">
            <div class="row align-items-center">
                <!-- nav and search button -->
                <div class="col-md-6 col-sm-8 clearfix">
                    <div class="nav-btn pull-left">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>  
                </div>
                <!-- profile info & task notification -->
                <div class="col-sm-6 clearfix">
                    <div class="user-profile pull-right">
                        <i class="fa fa-user fa-1x mr-3 font-14"></i>
                        <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?= $yonetim->kuladial();?><i class="fa fa-angle-down"></i></h4>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="control.php?sayfa=ayarlar">Ayarlar</a>
                            <a class="dropdown-item" href="control.php?sayfa=cikis">Çıkış</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header area end -->
        <!-- page title area start -->
        <!-- page title area end -->
        <div class="main-content-inner">
            <!-- sales report area start -->
            <div class="row">
                <div class="col-lg-12 mt-3 bg-white text-center" style="min-height:500px;">
                <?php
                    $bir = 1;
                    echo $yonetim->cookieSifre($bir), '<br>';
                    echo $yonetim->cookieCoz($yonetim->cookieSifre($bir)), '<br>';

                    @$sayfa = $_GET['sayfa'];

                    switch($sayfa):
                        /* ayar */
                        case 'siteayar': $yonetim->Yetkicontrol->bolumkontrol('siteayar'); $yonetim->siteayar(); break;
                        case 'mailayar': $yonetim->Yetkicontrol->bolumkontrol('mailayar'); $yonetim->mailayar(); break;
                        case 'tasarimayar': $yonetim->Yetkicontrol->bolumkontrol('tasarim'); $yonetim->tasarimayar(); break;
                        case 'tasarimbolumguncelle': $yonetim->Yetkicontrol->bolumkontrol('tasarim'); $yonetim->tasarimbolumguncelle(); break;
                        case 'bakimayar': $yonetim->Yetkicontrol->bolumkontrol('bakim'); $yonetim->bakimayar(); break;
                        case 'yedekayar': $yonetim->Yetkicontrol->bolumkontrol('bakim'); $yonetim->yedekayar(); break;
                        /* links */
                        case 'linkayar': $yonetim->Yetkicontrol->bolumkontrol('link'); $yonetim->linkayar(); break;
                        case 'linkekle': $yonetim->Yetkicontrol->bolumkontrol('link'); $yonetim->linkekle(); break;
                        case 'linkguncelle': $yonetim->Yetkicontrol->bolumkontrol('link'); $yonetim->linkguncelle(); break;
                        case 'linksil': $yonetim->Yetkicontrol->bolumkontrol('link'); $yonetim->linksil(); break; 
                        /* bulten */
                        case 'bultenayar': $yonetim->Yetkicontrol->bolumkontrol('bulten'); $yonetim->bultenayar(); break;
                        /* cikis */
                        case 'cikis' : $yonetim->cikis(); break; 
                        /* istatistik */
                        case 'istatistikbar' : $yonetim->Yetkicontrol->bolumkontrol('istatistik'); $yonetim->Yonetim2->istatistikbar(); break;
                        /* haber */
                        case 'haberayar': $yonetim->Yetkicontrol->bolumkontrol('haber'); $yonetim->Yonetim2->haberayar(); break;
                        case 'haberekle': $yonetim->Yetkicontrol->bolumkontrol('haber'); $yonetim->Yonetim2->haberekle(); break;
                        case 'haberguncelle': $yonetim->Yetkicontrol->bolumkontrol('haber'); $yonetim->Yonetim2->haberguncelle(); break;
                        case 'habersil': $yonetim->Yetkicontrol->bolumkontrol('haber'); $yonetim->Yonetim2->habersil(); break; 
                        /* intro */
                        case 'introayar': $yonetim->Yetkicontrol->bolumkontrol('intro'); $yonetim->Yonetim2->introayar(); break;
                        case 'introresimekle': $yonetim->Yetkicontrol->bolumkontrol('intro'); $yonetim->Yonetim2->introresimekle(); break;
                        case 'introresimguncelle': $yonetim->Yetkicontrol->bolumkontrol('intro'); $yonetim->Yonetim2->introresimguncelle(); break;
                        case 'introresimsil': $yonetim->Yetkicontrol->bolumkontrol('intro'); $yonetim->Yonetim2->introresimsil(); break; 
                        /* hakkimizda */
                        case 'hakkimizdaayar': $yonetim->Yetkicontrol->bolumkontrol('hakkimizda'); $yonetim->Yonetim2->hakkimizdaayar(); break;
                        /* hizmetlerimiz */
                        case 'hizmetayar': $yonetim->Yetkicontrol->bolumkontrol('hizmet'); $yonetim->Yonetim2->hizmetayar(); break;
                        case 'hizmetekle': $yonetim->Yetkicontrol->bolumkontrol('hizmet'); $yonetim->Yonetim2->hizmetekle(); break;
                        case 'hizmetguncelle': $yonetim->Yetkicontrol->bolumkontrol('hizmet'); $yonetim->Yonetim2->hizmetguncelle(); break;
                        case 'hizmetsil': $yonetim->Yetkicontrol->bolumkontrol('hizmet'); $yonetim->Yonetim2->hizmetsil(); break; 
                        /* referanslarimiz */
                        case 'referansayar': $yonetim->Yetkicontrol->bolumkontrol('referans'); $yonetim->Yonetim2->referansayar(); break;
                        case 'referansresimekle': $yonetim->Yetkicontrol->bolumkontrol('referans'); $yonetim->Yonetim2->referansresimekle(); break;
                        case 'referansresimguncelle': $yonetim->Yetkicontrol->bolumkontrol('referans'); $yonetim->Yonetim2->referansresimguncelle(); break;
                        case 'referansresimsil': $yonetim->Yetkicontrol->bolumkontrol('referans'); $yonetim->Yonetim2->referansresimsil(); break; 
                        /* filomuz */
                        case 'filoayar': $yonetim->Yetkicontrol->bolumkontrol('filo'); $yonetim->Yonetim2->filoayar(); break;
                        case 'filoresimekle': $yonetim->Yetkicontrol->bolumkontrol('filo'); $yonetim->Yonetim2->filoresimekle(); break;
                        case 'filoresimguncelle': $yonetim->Yetkicontrol->bolumkontrol('filo'); $yonetim->Yonetim2->filoresimguncelle(); break;
                        case 'filoresimsil': $yonetim->Yetkicontrol->bolumkontrol('filo'); $yonetim->Yonetim2->filoresimsil(); break; 
                        /* yorumlarimiz */
                        case 'yorumayar': $yonetim->Yetkicontrol->bolumkontrol('yorum'); $yonetim->Yonetim3->yorumayar(); break;
                        case 'yorumekle': $yonetim->Yetkicontrol->bolumkontrol('yorum'); $yonetim->Yonetim3->yorumekle(); break;
                        case 'yorumguncelle': $yonetim->Yetkicontrol->bolumkontrol('yorum'); $yonetim->Yonetim3->yorumguncelle(); break;
                        case 'yorumsil': $yonetim->Yetkicontrol->bolumkontrol('yorum'); $yonetim->Yonetim3->yorumsil(); break; 
                        /* mailler */
                        case 'gelenmail': $yonetim->Yetkicontrol->bolumkontrol('mesaj'); $yonetim->Yonetim3->gelenmail(); break;
                        case 'mesajoku': $yonetim->Yetkicontrol->bolumkontrol('mesaj'); $yonetim->Yonetim3->mesajoku(); break;
                        case 'mesajarsivle': $yonetim->Yetkicontrol->bolumkontrol('mesaj'); $yonetim->Yonetim3->mesajarsiv(); break;
                        case 'mesajsil': $yonetim->Yetkicontrol->bolumkontrol('mesaj'); $yonetim->Yonetim3->mesajsil(); break;
                        /* kullanici ayarlari */
                        case 'ayarlar': $yonetim->Yonetim3->ayarlar(); break;
                        /* kullanici */
                        case 'kullaniciayar': $yonetim->Yetkicontrol->bolumkontrol('yonetimm'); $yonetim->Yonetim3->kullaniciayar(); break;
                        case 'kullaniciekle': $yonetim->Yetkicontrol->bolumkontrol('yonetimm'); $yonetim->Yonetim3->kullaniciekle(); break;
                        case 'kullaniciguncelle': $yonetim->Yetkicontrol->bolumkontrol('yonetimm'); $yonetim->Yonetim3->kullaniciguncelle(); break;
                        case 'kullanicisil': $yonetim->Yetkicontrol->bolumkontrol('yonetimm'); $yonetim->Yonetim3->kullanicisil(); break;
                        /* video ayarlari */
                        case 'videoayar': $yonetim->Yetkicontrol->bolumkontrol('video'); $yonetim->Yonetim3->videoayar(); break;
                        case 'videoekle': $yonetim->Yetkicontrol->bolumkontrol('video'); $yonetim->Yonetim3->videoekle(); break;
                        case 'videoguncelle': $yonetim->Yetkicontrol->bolumkontrol('video'); $yonetim->Yonetim3->videoguncelle(); break;
                        case 'videosil': $yonetim->Yetkicontrol->bolumkontrol('video'); $yonetim->Yonetim3->videosil(); break; 
                        /* default */
                        default: 
                            if($yonetim->Yetkicontrol->authority == 1):
                                $yonetim->siteayar();
                            elseif($yonetim->Yetkicontrol->authority == 2):
                                $yonetim->tasarimayar();
                            elseif($yonetim->Yetkicontrol->authority == 3):
                                $yonetim->Yonetim3->yorumayar();
                            endif;
                    endswitch;
                ?>
                </div>
            </div>
        </div>
    </div>
    <!-- main content area end -->
</div>
<!-- page container area end -->
<!-- jquery latest version -->
    <script src="<?=URL_YONETIM;?>assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="<?=URL_YONETIM;?>assets/js/popper.min.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/bootstrap.min.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/owl.carousel.min.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/metisMenu.min.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/jquery.slimscroll.min.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/jquery.slicknav.min.js"></script>  
    <!-- others plugins -->
    <script src="<?=URL_YONETIM;?>assets/js/plugins.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/scripts.js"></script>
    <script src="<?=URL_YONETIM;?>assets/js/notify.js"></script>
</body>
</html>