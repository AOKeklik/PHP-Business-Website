<?php  session_start();
  include_once('config/baglan.php');
  include_once(KOK."lib/teknikfonksiyon.php");
  $teknik= new teknik;
  $teknik->dilKontrol();
  $teknik->cacheKontrol(md5($_SERVER["REQUEST_URI"]),2);
  ob_start();
  include_once(KOK."lib/fonksiyon.php");
  include_once(KOK."lib/tasarim.php");
  $sinif= new kurumsal;
  $tas= new tasarim;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <title><?php echo  $sinif->normaltitle; ?></title>
  <meta name="title" content="<?php echo  $sinif->metatitle; ?>" />
  <meta name="description" content="<?php echo  $sinif->metadesc; ?>" />
  <meta name="keywords" content="<?php echo  $sinif->metakey; ?>" />
  <meta name="author" content="<?php echo  $sinif->metaout; ?>" />
  <meta name="owner" content="<?php echo  $sinif->metaown; ?>" />
  <meta name="copyright" content="<?php echo  $sinif->metacopy; ?>" />
 <!-- Kütüphaneler -->
  <script src="<?=URL?>lib/jquery/jquery.min.js"></script>
  <script src="<?=URL?>lib/jquery/jquery-migrate.min.js"></script>
  <script src="<?=URL?>lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=URL?>lib/easing/easing.min.js"></script>
  <script src="<?=URL?>lib/superfish/hoverIntent.js"></script>
  <script src="<?=URL?>lib/superfish/superfish.min.js"></script>
  <script src="<?=URL?>lib/wow/wow.min.js"></script>
  <script src="<?=URL?>lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="<?=URL?>lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="<?=URL?>lib/sticky/sticky.js"></script>
  <script src="<?=URL?>js/main.js"></script>
  <script type="text/javascript" src="<?=URL?>js/jquery.js"></script>
  <script type="text/javascript" src="<?=URL?>js/jquery.vticker-min.js"></script>
  <script type="text/javascript">
    $(function(){
      $('#news-container1').vTicker({
        speed: 700,
        pause: 4000,
        animation: 'fade',
        mousePause: false,
        showItems: 1
      });
    });
  </script>
<!-- Fontlar -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  <link rel="shortcut icon" type="image/png" href="<?=IMG?>icon/favicon.png">
<!-- Bootstrap stil dosyası -->
  <link href="<?=URL?>lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- işimize yarayacak diğer kütüphane css dosyalarımız -->
  <link href="<?=URL?>lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?=URL?>lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?=URL?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="<?=URL?>lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?=URL?>lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="<?=URL?>lib/ionicons/css/ionicons.min.css" rel="stylesheet">
<!-- bizim stil dosyamız -->
  <link href="<?=URL?>css/style.css" rel="stylesheet">
  <script>
    $(document).ready(function(e) {
	    $('#bultensonuc').hide();
      
      $("#gonderbtn").click(function(){ 
          var error=false;
          var form=$("#mailform").find('.form-group');
    
          form.children('input').each(function(){ 
              var i=$(this);
              i.css("border-color","");
      
              if (i.val()=="") {
                  i.css("border-color","red");
                  $('#mesajsonuc').text("Lütfen tüm alanları doldurun.");
                  error=true;
              }else{	
                  error=false;
                  $('#mesajsonuc').text("");
              }	
          })
          
          if (form.children('textarea').val()==""){
              form.children('textarea').css("border-color","red");
              $('#mesajsonuc').text("Lütfen tüm alanları doldurun.");
              error=true;
          }else{	
              error=false;
              $('#mesajsonuc').text("");
          }

          if(!error){		
              $.ajax({
                  beforeSend:function(){
                    $('#load').html('<img src="<?=IMG?>mail.gif">')
                  },
                  type:"POST",
                  url:'<?=URL?>lib/mail/gonder.php?islem=arayuz',
                  data:$('#mailform').serialize(),
                  success: function(donen){
                      $('#mailform').trigger("reset")
                      $('#load').html('') 
                      $('#formtutucu').fadeOut(500)
                      $('#mesajsonuc').html(donen)
                  }
		          })
		      }
	    })
   
      $("#bultenbtn").click(function(){ 
          $.ajax({
              type:"POST",
              url:'<?=URL?>lib/islem.php?islem=bultenislem',
              data:$('#bultenform').serialize(),
              success: function(donen){
                  $('#bultenform').trigger("reset"); 
                  $('#bultentutucu').fadeOut();
                  $('#bultensonuc').html(donen).fadeIn();
              }
          })
      })
    })
  </script>
</head>
<body id="body">
<!-- ÜST BAR -->
<section id="topbar" class="d-none d-lg-block">
  <div class="container clearfix">
    <div class="contact-info float-left">
      <i class="fa fa-envelope-o"></i><a href="mailto:<?php echo  $sinif->mailadres; ?>"><?php echo  $sinif->mailadres; ?></a>
      <i class="fa fa-phone"></i><?php echo  $sinif->telno; ?>     
    </div>    
    <div class="social-links float-right">    
      <a href="<?php echo  $sinif->tvit; ?>" class="twitter"><i class="fa fa-twitter"></i></a>
      <a href="<?php echo  $sinif->face; ?>" class="facebook"><i class="fa fa-facebook"></i></a>
      <a href="<?php echo  $sinif->ints; ?>" class="instagram"><i class="fa fa-instagram"></i></a> 
      <a href="tr" class="twitter">TR</a>
      <a href="en" class="twitter">EN</a>
    </div>
  </div>
</section> 
<!-- header -->
<header id="header">
  <div class="container">
    <div id="logo" class="pull-left">
      <h1><a href="#body" class="scrollto"><?php echo  $sinif->logoyazi; ?></h1>
    </div>
    <nav id="nav-menu-container">
      <ul class="nav-menu"> 
        <?php $sinif->linkler(); ?>  
      </ul>
    </nav>
  </div>
</header>
<!-- İNTRO -->
<section id="intro">
  <div class="intro-content">
    <h2><?php echo  $sinif->slogan; ?></h2>
  </div>
  <div id="intro-carousel" class="owl-carousel">
    <?php $sinif->introbak(); ?> 
  </div>
</section>
<!-- MAIN -->
<main id="main">
  <!-- HABERLER -->
	<?php $tas->haberTasarimDuzen(); ?>    
  <!-- HABERLER -->
  <!-- TÜM BÖLÜMLER -->
	<?php $tas->TasarimBolumleri(); ?> 
  <!-- TÜM BÖLÜMLER -->
  <!-- ILETISIM -->
  <section id="iletisim" class="wow fadeInUp">
    <div class="container">
      <div class="section-header">
        <h2><?php echo  $sinif->iletisimUstBaslik; ?> </h2>
        <p><?php echo  $sinif->iletisimbaslik; ?> </p>
   		</div>
      <div class="row contact-info">
        <div class="col-md-4">
          <div class="contact-address">
            <i class="ion-ios-location-outline"></i>
            <h3><?php echo  $sinif->adresBilgi; ?></h3>
            <address><?php echo  $sinif->normaladres; ?></address>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-phone">
            <i class="ion-ios-telephone-outline"></i>
            <h3><?php echo  $sinif->telefonBilgi; ?></h3>
            <p><a href="tel:<?php echo  $sinif->telno; ?>"><?php echo  $sinif->telno; ?></a></p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="contact-email">
            <i class="ion-ios-email-outline"></i>
            <h3>Mail</h3>
            <p><a href="mailto:<?php echo  $sinif->mailadres; ?>"><?php echo  $sinif->mailadres; ?></a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="container mb-4">
      <iframe src="<?php echo  $sinif->haritabilgi; ?>" width="100%" height="380" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
    <div class="container">
      <div class="form">  
        <div id="mesajsonuc"></div>
        <div id="formtutucu">
          <form id="mailform">
            <div class="form-row">
              <div class="form-group col-md-6">
                  <input type="text" name="isim" class="form-control" placeholder="<?php echo  $sinif->adbilgi; ?>" required="required" />
              </div>
              <div class="form-group col-md-6">
                <input type="text" name="mail" class="form-control" placeholder="<?php echo  $sinif->mailBilgi; ?>" required="required" />
              </div>
            </div>
            <div class="form-group">
              <input type="text" name="konu" class="form-control" placeholder="<?php echo  $sinif->konuBilgi; ?>" required="required" />
            </div>
            <div class="form-group">
              <textarea class="form-control" name="mesaj" rows="5"></textarea>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <img src="<?=URL?>captcha.php" /> 
                  </div>
                  <div class="form-group col-md-9">
                    <input type="text" name="guvenlik" class="form-control" placeholder="<?php echo  $sinif->guvenlikBilgi; ?>" required="required" />
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6"><?php 
                if(!isset($_SESSION['token']))://session tanimli degilse sadece birkere tanimlanacak
                  $_SESSION['token'] = md5(mt_rand(0,9999999));
                endif;
                ?><input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>" />
                <input type="button"  value="<?php echo  $sinif->butonBilgi; ?>" id="gonderbtn" class="btn btn-info"/></form>
                <span id='load'></span>
              </div>
            </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- MAIN -->
<!-- FOOTER -->
<footer id="footer">
  <div class="container">
    <div class="row">
      <div class="col-lg-4">
   	    <?php $tas->BultentasarimDuzen(); ?>
      </div>
      <div class="col-lg-4">
        <div class="copyright">
          <?php echo  $sinif->footer; ?>
        </div>
        <div class="credits">
          <?php echo  $sinif->metaown; ?>
        </div>
      </div>
    </div>
  </div>
</footer>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

</body>
</html>

<?php $teknik->cacheOlustur(md5($_SERVER["REQUEST_URI"])); ?>

